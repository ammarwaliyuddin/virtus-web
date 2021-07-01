<?php

namespace App\Controllers;

use App\Models\LokasiModel;

use App\Models\PersonilModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Security extends BaseController
{
    protected $PersonilModel;
    protected $LokasiModel;
    protected $builder;
    public function __construct()
    {
        $this->LokasiModel = new LokasiModel();
        $this->PersonilModel = new PersonilModel();
        $this->builder      = \Config\Database::connect()->table('master_data_personil');
    }

    public function index()
    {
        // $Lokasi = $this->LokasiModel->findAll();
        // $Personil = $this->PersonilModel->findAll();

        // dd($personil_lokasi);
        $keyword = $this->request->getVar('keyword');


        if ($keyword) {
            $personil_lokasi = $this->PersonilModel->searchPersonil($keyword);
        } else {
            $personil_lokasi = $this->PersonilModel->getPersonil();
        }
        // dd($personil_lokasi = $this->PersonilModel->getPersonil());
        $data = [
            // 'Lokasi' => $Lokasi,
            // 'Personil' => $Personil
            'Personil_lokasi' => $personil_lokasi
        ];

        // dd($data);
        return view('Security/Security', $data);
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
            return redirect()->to('/Security/setting_personil');
        } else {

            $avatar = $this->request->getFile('Foto');
            $avatar->move(ROOTPATH . 'public/img');

            $data = [
                'Nama' => $this->request->getVar('Nama'),
                'Umur' => $this->request->getVar('Umur'),
                'Nomor_HP' => $this->request->getVar('Nomor_HP'),
                'Email' => $this->request->getVar('Email'),
                'NIK' => $this->request->getVar('NIK'),
                'Foto' =>  $avatar->getName(),
                'PIN' => $this->request->getVar('PIN'),
                'Status' => '0'
            ];



            $this->builder->insert($data);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to('/Security/setting_personil');
        }
    }

    public function detail_personil($detail)
    {
        $detail = $this->PersonilModel->detailPersonil($detail);
        // dd($detail);
        // dd($detail);
        // $data = [
        //     // 'Lokasi' => $Lokasi,
        //     // 'Personil' => $Personil
        //     'detail' => $detail
        // ];

        $data = ['detail' => $detail[0]];
        // dd($data);
        // dd($data);
        return view('Security/Detail_Personil', $data);
    }
    public function setting_personil()
    {
        if ($_SESSION['role'] == 'user') {
            session()->setFlashdata('pesan', 'tidak ada akses');
            return redirect()->to('/Dashboard');
        } else {

            // $personilAll = $this->PersonilModel->getPersonil();
            $personilAll = $this->PersonilModel->findAll();
            // $Area = $this->LokasiModel->findAll();
            $data = [
                'personilAll' => $personilAll
                // 'Area' => $Area
            ];

            return view('Pengaturan/Personil', $data);
        }
    }
    public function delete($NIK)
    {
        $this->PersonilModel->delete($NIK);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Security/setting_personil');
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
            return redirect()->to('/Security/setting_personil');
        } else {

            $avatar = $this->request->getFile('Foto');
            $avatar->move(ROOTPATH . 'public/img');

            $data = [
                'Nama' => $this->request->getVar('Nama'),
                'Umur' => $this->request->getVar('Umur'),
                'Nomor_HP' => $this->request->getVar('Nomor_HP'),
                'Email' => $this->request->getVar('Email'),
                'NIK' => $this->request->getVar('NIK'),
                'Foto' =>  $avatar->getName(),
                'PIN' => $this->request->getVar('PIN'),
                'Status' => $this->request->getVar('Status'),
            ];

            $this->builder->where('NIK', $NIK);
            $this->builder->update($data);
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to('/Security/setting_personil');
        }
        // dd($data);

    }
    // export pdf
    public function reportpdf()
    {
        $personilAll = $this->PersonilModel->findAll();
        // dd($role);
        // die;

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/personil_pdf', [
            'personilAll' => $personilAll
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
    // export excel
    public function export()
    {

        $personilAll = $this->PersonilModel->findAll();

        $spreadsheet = new Spreadsheet;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Umur')
            ->setCellValue('D1', 'Nomor_HP')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'NIK');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($personilAll as $P) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $P['Nama'])
                ->setCellValue('C' . $kolom, $P['Umur'])
                ->setCellValue('D' . $kolom, $P['Nomor_HP'])
                ->setCellValue('E' . $kolom, $P['Email'])
                ->setCellValue('F' . $kolom, $P['NIK']);

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
            return redirect()->to('/Security/setting_personil');
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
                $Umur = $row[2];
                $Nomor_HP = $row[3];
                $Email = $row[4];
                $NIK = $row[5];


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
                        'Umur' => $Umur,
                        'Nomor_HP' => $Nomor_HP,
                        'Email' => $Email,
                        'NIK' => $NIK,
                    ];
                    $this->builder->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            // foreach ($pesan_error as $error) {
            //     echo $error;
            // }

            $this->session->setFlashdata('pesan', "$jumlaherror Data tidak diimport karna memiliki kesamaan pada data yang sudah ada <br> $jumlahsukses Data berhasil di import");
            return redirect()->to('/Security/setting_personil');
        }
    }
}
