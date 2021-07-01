<?php

namespace App\Controllers;

use App\Models\JabatanModel;
use App\Models\UserModel;

use App\Models\UserDelete;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends BaseController
{
    protected $UserModel;
    protected $UserDelete;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->UserDelete = new UserDelete();
        $this->JabatanModel = new JabatanModel();
        $this->builder   = \Config\Database::connect()->table('master_data_admin');
    }

    public function index()
    {
        $User = $this->UserDelete->findAll();
        // $User = $this->UserDelete->getUser();
        $Jabatan = $this->JabatanModel->findAll();

        $data = [
            'User' => $User,
            'Jabatan' => $Jabatan
        ];


        return view('Pengaturan/User', $data);
    }

    public function save()
    {
        $this->UserModel->save([
            'NIK' => $this->request->getVar('NIK'),
            'Nama' => $this->request->getVar('Nama'),
            'Password' => password_hash($this->request->getVar('Password'), PASSWORD_BCRYPT),
            'Status' => $this->request->getVar('Status'),
            'Foto' => $this->request->getVar('Foto'),
            'Jabatan' => $this->request->getVar('Jabatan'),
            'Email' => $this->request->getVar('Email'),
            'Expiredate' => $this->request->getVar('Expiredate'),
            'Keterangan' => $this->request->getVar('Keterangan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/User');
    }

    public function delete($Nama)
    {
        $this->UserDelete->delete($Nama);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/User');
    }

    public function edit($NIK)
    {
        $NIK = $this->request->getVar('NIK');
        $Nama = $this->request->getVar('Nama');
        $Jabatan = $this->request->getVar('Jabatan');
        $Email = $this->request->getVar('Email');
        $Password = password_hash($this->request->getVar('Password'), PASSWORD_BCRYPT);
        $Foto = $this->request->getVar('Foto');
        $Expiredate = $this->request->getVar('Expiredate');
        $Status = $this->request->getVar('Status');
        $Keterangan = $this->request->getVar('Keterangan');

        $data = [
            'NIK' => $NIK,
            'Nama' => $Nama,
            'Jabatan' => $Jabatan,
            'Email' => $Email,
            'Jabatan' => $Jabatan,
            'Password' => $Password,
            'Foto' => $Foto,
            'Expiredate' => $Expiredate,
            'Status' => $Status,
            'Keterangan' => $Keterangan
        ];

        $this->builder->where('NIK', $NIK);
        $this->builder->update($data);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/User');
    }
    public function reportpdf()
    {
        $User = $this->UserModel->findAll();
        // var_dump($User);
        // die;
        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/User_pdf', [
            'User' => $User
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
    // export excel
    public function export()
    {

        $User = $this->UserModel->findAll();
        // dd($User);

        $spreadsheet = new Spreadsheet;


        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'NIK')
            ->setCellValue('D1', 'Jabatan')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'Foto')
            ->setCellValue('G1', 'Status')
            ->setCellValue('H1', 'Keterangan');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($User as $U) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $U['Nama'])
                ->setCellValue('C' . $kolom, $U['NIK'])
                ->setCellValue('D' . $kolom, $U['Jabatan'])
                ->setCellValue('E' . $kolom, $U['Email'])
                ->setCellValue('F' . $kolom, $U['Foto'])
                ->setCellValue('G' . $kolom, $U['Status'])
                ->setCellValue('H' . $kolom, $U['Keterangan']);

            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="rekap.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }



    //import excel
    public function import()
    {

        $validation = \Config\Services::validation();
        $valid = $this->validate(
            [
                'fileimport' => [
                    'label' => 'inputan file',
                    'rules' => 'uploaded[fileimport]|ext_in[fileimport,xls,xlsx]',
                    'errors' => [
                        'uploaded' => '{field} wajib diisi',
                        'ext_in' => '{field} harus ekstensi xls & xlsx'
                    ]
                ]
            ]
        );

        if (!$valid) {

            $this->session->setFlashdata('pesan', $validation->getError('fileimport'));
            return redirect()->to('/User');
        } else {
            $file_excel = $this->request->getFile('fileimport');

            $ext = $file_excel->getClientExtension();
            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $render->load($file_excel);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $pesan_error = [];
            $jumlaherror = 0;
            $jumlahsukses = 0;

            foreach ($data as $x => $row) {
                if ($x == 0) {
                    continue;
                }

                $Nama = $row[1];
                $NIK = $row[2];
                $Jabatan = $row[3];
                $Email = $row[4];
                $Foto = $row[5];
                $Status = $row[6];
                $Keterangan = $row[7];



                $this->builder->where(['NIK' => $NIK]);
                $cekdata = $this->builder->get();

                // $cekNama_area =  $db->table('data_area')->getWhere(['Nama_area' => $Nama_area])->getResult();
                if (count($cekdata->getResult()) > 0) {
                    $jumlaherror++;
                    // // $pesan_error[] = "Jabatan : $Jabatan, dan Nama Area $Nama_area, sudah ada<br>";
                    // $pesan_error = [
                    //     'Jabatan' => $Jabatan,
                    //     'Nama_area' => $Nama_area
                    // ];
                } else {
                    $datasimpan = [
                        'Nama' => $Nama,
                        'NIK' => $NIK,
                        'Email' => $Email,
                        'Jabatan' => $Jabatan,
                        'Status' => $Status,
                        'Keterangan ' => $Keterangan,
                        'Foto ' => $Foto,
                    ];
                    $this->builder->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            // foreach ($pesan_error as $error) {
            //     echo $error;
            // }

            $this->session->setFlashdata('pesan', "$jumlaherror Data tidak diimport karna memiliki kesamaan pada data yang sudah ada <br> $jumlahsukses Data berhasil di import");
            return redirect()->to('/User');
        }
    }
}
