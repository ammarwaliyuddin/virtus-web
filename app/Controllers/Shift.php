<?php

namespace App\Controllers;

use App\Models\LoginModel;

use App\Models\ShiftModel;
use App\Models\AreaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Shift extends BaseController
{
    protected $ShiftModel;
    protected $AreaModel;
    protected $builder;
    protected $aturshift;

    public function __construct()
    {
        $this->ShiftModel = new ShiftModel();
        $this->AreaModel = new AreaModel();
        $this->builder      = \Config\Database::connect()->table('data_shift');
        $this->aturshift      = \Config\Database::connect()->table('data_shift_personil');
    }


    public function index()
    {


        $keyword = $this->request->getVar('keyword');



        if ($keyword) {
            $Shift = $this->ShiftModel->searchShift($keyword);
        } else {
            $Shift = $this->ShiftModel->getShift();
        }
        // dd($Shift);

        $data = [
            'Shift' => $Shift,
        ];

        // dd($data);
        return view('Shift/Shift', $data);
    }
    public function setting_shift()
    {
        if ($_SESSION['role'] == 'user') {
            session()->setFlashdata('pesan', 'tidak ada akses');
            return redirect()->to('/Dashboard');
        } else {

            $shift = $this->ShiftModel->findAll();
            $area = $this->AreaModel->findAll();
            $data = [
                'shift' => $shift,
                'area' => $area
            ];
            return view('Pengaturan/Shift', $data);
        }
    }
    public function save()
    {

        $this->builder->selectMax('ID_shift');
        $max = $this->builder->get()->getResultArray();
        $result = $max['0']['ID_shift'];
        $data = [
            'Nama_area' => $this->request->getVar('Nama_area'),
            'Hari' => $this->request->getVar('Hari'),
            'Jam' => $this->request->getVar('Jam'),
            'tanggali' => date("Y-m-d"),
            'ID_shift' => $result + 1


        ];
        // dd($data);

        $this->builder->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Shift/setting_shift');
    }
    public function delete($ID_shift)
    {
        $this->aturshift->where('ID_shift', $ID_shift);
        $this->aturshift->delete();
        $this->ShiftModel->delete($ID_shift);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Shift/setting_shift');
    }
    public function edit($id)
    {

        $data = [
            'Nama_area' => $this->request->getVar('Nama_area'),
            'Hari' => $this->request->getVar('Hari'),
            'Jam' => $this->request->getVar('Jam'),
            'tanggali' => date("Y-m-d")
        ];

        // dd($data);

        $this->builder->where('ID_shift', $id);
        $this->builder->update($data);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Shift/setting_shift');
    }
    public function setting_atur_shift()
    {
        if ($_SESSION['role'] == 'user') {
            session()->setFlashdata('pesan', 'tidak ada akses');
            return redirect()->to('/Dashboard');
        } else {

            $data = [
                'atur_shift' => $this->ShiftModel->atur_shift(),
                'nama_personil' => $this->ShiftModel->Personil_Shift(),
                'data_shift' => $this->ShiftModel->findAll()
            ];

            // dd($data);
            return view('Pengaturan/Atur_shift', $data);
        }
    }
    public function atur_shit_save()
    {
        $data = [
            'NIK' => $this->request->getVar('NIK'),
            'ID_shift' => $this->request->getVar('shift'),
        ];

        // dd($data);
        $this->ShiftModel->atur_shit_save($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Shift/setting_atur_shift');
    }
    public function atur_shit_edit($id)
    {
        $data = [
            'NIK' => $this->request->getVar('NIK'),
            'ID_shift' => $this->request->getVar('shift'),
        ];

        $this->aturshift->where('id', $id);
        $this->aturshift->update($data);
        // dd($data);

        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->to('/Shift/setting_atur_shift');
    }
    public function atur_shit_hapus($id)
    {


        $this->aturshift->where('id', $id);
        $this->aturshift->delete();

        session()->setFlashdata('pesan', 'Data berhasil hapus');
        return redirect()->to('/Shift/setting_atur_shift');
    }

    // export pdf
    public function reportpdf()
    {
        $shift = $this->ShiftModel->findAll();



        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/shift_pdf', [
            'shift' => $shift,
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }

    // export excel
    public function export()
    {

        $shift = $this->ShiftModel->findAll();

        $spreadsheet = new Spreadsheet;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama_area')
            ->setCellValue('C1', 'hari')
            ->setCellValue('D1', 'jam');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($shift as $S) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $S['Nama_area'])
                ->setCellValue('C' . $kolom, $S['hari'])
                ->setCellValue('D' . $kolom, $S['jam']);

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
            return redirect()->to('/Shift/setting_shift');
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

                $Nama_area = $row[1];
                $hari = $row[2];
                $jam = $row[3];


                $this->builder->where(['Nama_area' => $Nama_area]);
                $this->builder->where(['hari' => $hari]);
                $this->builder->where(['jam' => $jam]);
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
                    $this->builder->selectMax('ID_shift');
                    $max = $this->builder->get()->getResultArray();
                    $result = $max['0']['ID_shift'];

                    $datasimpan = [
                        'Nama_area' => $Nama_area,
                        'hari' => $hari,
                        'jam' => $jam,
                        'ID_shift' => $result + 1,
                        'tanggali' => date("Y-m-d")
                    ];
                    $this->builder->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            // foreach ($pesan_error as $error) {
            //     echo $error;
            // }

            $this->session->setFlashdata('pesan', "$jumlaherror Data tidak diimport karna memiliki kesamaan pada data yang sudah ada <br> $jumlahsukses Data berhasil di import");
            return redirect()->to('/Shift/setting_shift');
        }
    }


    public function atur_reportpdf()
    {
        $data = [
            'atur_shift' => $this->ShiftModel->atur_shift(),

        ];
        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/atur_shift_pdf', $data);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }

    // export excel
    public function atur_export()
    {


        $atur_shift = $this->ShiftModel->atur_shift();

        // dd($atur_shift);

        $spreadsheet = new Spreadsheet;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'NIK')
            ->setCellValue('C1', 'ID_shift');

        // ->setCellValue('B1', 'Nama')
        // ->setCellValue('C1', 'Nama_area')
        // ->setCellValue('D1', 'hari')
        // ->setCellValue('E1', 'jam');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($atur_shift as $d) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $d['NIK'])
                ->setCellValue('C' . $kolom, $d['ID_shift']);

            // ->setCellValue('B' . $kolom, $d['Nama'])
            // ->setCellValue('C' . $kolom, $d['Nama_area'])
            // ->setCellValue('D' . $kolom, $d['Hari'])
            // ->setCellValue('E' . $kolom, $d['Jam']);
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
    public function atur_import()
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
            return redirect()->to('/Shift/setting_atur_shift');
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

                $NIK = $row[1];
                $ID_shift = $row[2];
                // $Nama = $row[1];
                // $Nama_area = $row[2];
                // $Hari = $row[3];
                // $Jam = $row[4];

                $cekdata = $this->ShiftModel->atur_shift_where($NIK, $ID_shift);
                // dd($cekdata);

                // $this->builder->where(['Nama' => $Nama]);
                // $cekdata = $this->aturshift->get();
                // dd($cekdata);

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
                        'NIK' => $NIK,
                        'ID_shift' => $ID_shift,
                    ];

                    // dd($data);
                    $this->ShiftModel->atur_shit_save($datasimpan);
                    // $this->builder->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            // foreach ($pesan_error as $error) {
            //     echo $error;
            // }

            $this->session->setFlashdata('pesan', "$jumlaherror Data tidak diimport karna memiliki kesamaan pada data yang sudah ada <br> $jumlahsukses Data berhasil di import");
            return redirect()->to('/Shift/setting_atur_shift');
        }
    }
}
