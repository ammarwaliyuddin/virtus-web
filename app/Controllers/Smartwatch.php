<?php

namespace App\Controllers;

use App\Models\SmartwatchModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Smartwatch extends BaseController
{
    protected $JabatanModel;
    public $builder;
    public function __construct()
    {
        $this->SmartwatchModel = new SmartwatchModel();
        $this->builder   = \Config\Database::connect()->table('data_jam');
    }

    public function index()
    {
        if ($_SESSION['role'] == 'user') {
            session()->setFlashdata('pesan', 'tidak ada akses');
            return redirect()->to('/Dashboard');
        } else {

            $Smartwatch = $this->SmartwatchModel->findAll();

            $data = [
                'Smartwatch' => $Smartwatch
            ];
            return view('Pengaturan/Smartwatch', $data);
        }
    }

    public function save()
    {
        $this->SmartwatchModel->save([
            'merek' => $this->request->getVar('merek'),
            'longitude' => $this->request->getVar('longitude'),
            'latitude' => $this->request->getVar('latitude')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Smartwatch');
    }

    public function delete($ID_jam)
    {
        $this->SmartwatchModel->delete($ID_jam);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Smartwatch');
    }

    public function edit($ID_jam)
    {

        $merek = $this->request->getVar('merek');
        $latitude = $this->request->getVar('latitude');
        $longitude = $this->request->getVar('longitude');
        $lokasi = $this->request->getVar('lokasi');

        $data = [
            'ID_jam' => $ID_jam,
            'merek' => $merek,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'lokasi' => $lokasi
        ];

        // dd($data);

        $this->builder->where('ID_jam', $ID_jam);
        $this->builder->update($data);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Smartwatch');
    }
    public function reportpdf()
    {
        $Smartwatch = $this->SmartwatchModel->findAll();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/Smartwatch_pdf', [
            'Smartwatch' => $Smartwatch
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
    // export excel
    public function export()
    {

        //  $semua_pengguna = $this->export_model->getAll()->result();
        $Smartwatch = $this->SmartwatchModel->findAll();

        $spreadsheet = new Spreadsheet;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'merek')
            ->setCellValue('C1', 'latitude')
            ->setCellValue('D1', 'longitude')
            ->setCellValue('E1', 'lokasi');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($Smartwatch as $S) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $S['merek'])
                ->setCellValue('C' . $kolom, $S['latitude'])
                ->setCellValue('D' . $kolom, $S['longitude'])
                ->setCellValue('E' . $kolom, $S['lokasi']);

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
            return redirect()->to('/Smartwatch/index');
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

                $merek = $row[1];
                $latitude = $row[2];
                $longitude = $row[3];
                $lokasi = $row[4];


                $this->builder->where(['merek' => $merek]);
                $this->builder->where(['lokasi' => $lokasi]);
                $this->builder->where(['latitude' => $latitude]);
                $this->builder->where(['longitude' => $longitude]);
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
                        'merek' => $merek,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'lokasi' => $lokasi,
                    ];
                    $this->builder->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            // foreach ($pesan_error as $error) {
            //     echo $error;
            // }

            $this->session->setFlashdata('pesan', "$jumlaherror Data tidak diimport karna memiliki kesamaan pada data yang sudah ada <br> $jumlahsukses Data berhasil di import");
            return redirect()->to('/Smartwatch');
        }
    }
}
