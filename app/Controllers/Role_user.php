<?php

namespace App\Controllers;

use App\Models\RoleUserModel;
use App\Models\JabatanModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Role_user extends BaseController
{
    protected $RoleUserModel;
    protected $JabatanModel;
    public $builder;
    public function __construct()
    {
        $this->RoleUserModel = new RoleUserModel();
        $this->JabatanModel = new JabatanModel();
        $this->builder   = \Config\Database::connect()->table('master_data_admin');
    }


    public function index()
    {
        $RoleUser = $this->RoleUserModel->findAll();
        $Jabatan = $this->JabatanModel->findAll();

        $data = [
            'RoleUser' => $RoleUser,
            'Jabatan' => $Jabatan
        ];

        return view('Pengaturan/Role_user', $data);
    }

    public function save()
    {
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'Foto' => [
                'label' => 'inputan file',
                'rules' => 'uploaded[Foto]|mime_in[Foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[Foto,4096]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi',
                    'mime_in' => '{field} harus ekstensi jpg/png/jpeg',
                    'max_size' => '{field} terlalu besar'
                ]
            ]
        ]);

        if ($valid == FALSE) {

            session()->setFlashdata('pesan', $validation->getError('Foto'));
            return redirect()->to('/Role_user');
        } else {

            $avatar = $this->request->getFile('Foto');
            $avatar->move(ROOTPATH . 'public/img');

            $data = [
                'Nama' => $this->request->getVar('Nama'),
                'NIK' => $this->request->getVar('NIK'),
                'Password' => $this->request->getVar('Password'),
                'Jabatan' => $this->request->getVar('Jabatan'),
                'Email' => $this->request->getVar('Email'),
                'Keterangan' => $this->request->getVar('Keterangan'),
                'Foto' =>  $avatar->getName(),
                'Role' => $this->request->getVar('Role')
            ];
            $this->RoleUserModel->simpan($data);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to('/Role_user');
        }
    }

    public function delete($NIK)
    {
        $this->RoleUserModel->delete($NIK);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Role_user');
    }

    public function edit($NIK)
    {
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'Foto' => [
                'label' => 'inputan file',
                'rules' => 'uploaded[Foto]|mime_in[Foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[Foto,4096]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi',
                    'mime_in' => '{field} harus ekstensi jpg/png/jpeg',
                    'max_size' => '{field} terlalu besar'
                ]
            ]
        ]);

        if ($valid == FALSE) {

            session()->setFlashdata('pesan', $validation->getError('Foto'));
            return redirect()->to('/Role_user');
        } else {

            $avatar = $this->request->getFile('Foto');
            $avatar->move(ROOTPATH . 'public/img');

            $data = [
                'Nama' => $this->request->getVar('Nama'),
                'NIK' => $this->request->getVar('NIK'),
                'Password' => $this->request->getVar('Password'),
                'Jabatan' => $this->request->getVar('Jabatan'),
                'Email' => $this->request->getVar('Email'),
                'Keterangan' => $this->request->getVar('Keterangan'),
                'Foto' =>  $avatar->getName(),
                'Status' => $this->request->getVar('status'),
                'role' => $this->request->getVar('role')
            ];
            // dd($data);
            $this->RoleUserModel->edit($NIK, $data);

            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to('/Role_user');
        }
    }

    // export pdf
    public function reportpdf()
    {
        $role = $this->RoleUserModel->findAll();
        // dd($role);
        // die;

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/role_pdf', [
            'role' => $role
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }

    // export excel
    public function export_excel()
    {

        $Role = $this->RoleUserModel->findAll();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'NIK')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', 'Jabatan')
            ->setCellValue('F1', 'role')
            ->setCellValue('G1', 'Status')
            ->setCellValue('H1', 'Keterangan')
            ->setCellValue('I1', 'Foto');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($Role as $R) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $R['Nama'])
                ->setCellValue('C' . $kolom, $R['NIK'])
                ->setCellValue('D' . $kolom, $R['Email'])
                ->setCellValue('E' . $kolom, $R['Jabatan'])
                ->setCellValue('F' . $kolom, $R['role'])
                ->setCellValue('G' . $kolom, $R['Status'])
                ->setCellValue('H' . $kolom, $R['Keterangan'])
                ->setCellValue('I' . $kolom, $R['Foto']);

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
            return redirect()->to('/Role_user');
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
                $Email = $row[3];
                $Jabatan = $row[4];
                $role = $row[5];
                $Status = $row[6];
                $Keterangan = $row[7];
                $Foto = $row[8];



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
                        'role' => $role,
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
            return redirect()->to('/Role_user');
        }
    }
}
