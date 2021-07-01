<?php

namespace App\Controllers;

use App\Models\LokasiModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\AreaModel;
use App\Models\ShiftModel;


use PDO;
use \Mpdf\Mpdf;

class Area extends BaseController
{
    protected $LokasiModel;
    protected $builder;
    protected $ShiftModel;
    protected $aturshift;
    public function __construct()
    {
        $this->LokasiModel = new LokasiModel();
        $this->ShiftModel = new ShiftModel();
        $this->builder   = \Config\Database::connect()->table('data_area');
        $this->aturshift      = \Config\Database::connect()->table('data_shift_personil');
    }

    public function index()
    {
        if ($_SESSION['role'] == 'user') {
            session()->setFlashdata('pesan', 'tidak ada akses');
            return redirect()->to('/Dashboard');
        } else {

            $Area = $this->LokasiModel->findAll();

            $data = [
                'Area' => $Area
            ];

            return view('Pengaturan/Area', $data);
        }
    }

    public function save()
    {
        // dd($this->request->getVar());
        $this->LokasiModel->save([
            'Nama_area' => $this->request->getVar('Nama_area'),
            'Lokasi' => $this->request->getVar('Lokasi'),
            'persentase_ngantuk' => $this->request->getVar('persentase_ngantuk'),
            'persentase_tidur' => $this->request->getVar('persentase_tidur'),
            'persentase_kerja' => $this->request->getVar('persentase_kerja'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Area');
    }

    public function delete($ID_area)
    {

        // opsi 1
        // $shift = $this->ShiftModel->select('ID_shift');
        // $shift =  $this->ShiftModel->getWhere(['ID_area' => $ID_area])->getResultArray();

        //opsi 2
        $area =  $this->LokasiModel->select('Nama_area');
        $area =  $this->LokasiModel->getWhere(['ID_area' => $ID_area])->getResultArray();
        $Nama_area = $area[0]['Nama_area'];

        $shift = $this->ShiftModel->select('ID_shift');
        $shift =  $this->ShiftModel->getWhere(['Nama_area' => $Nama_area])->getResultArray();


        //akhir opsi

        $ID_shift = $shift[0]['ID_shift'];

        $this->aturshift->where('ID_shift', $ID_shift);
        $this->aturshift->delete();
        $this->ShiftModel->delete($ID_area);
        $this->LokasiModel->delete($ID_area);



        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Area');
    }

    public function update($ID_area)
    {
        $AreaLama = $this->request->getVar('AreaLama');
        $AreaBaru = $this->request->getVar('Nama_area');
        if ($AreaLama == $AreaBaru) {
            $this->LokasiModel->save([
                'ID_area' => $ID_area,
                'Lokasi' => $this->request->getVar('Lokasi'),
                'persentase_ngantuk' => $this->request->getVar('persentase_ngantuk'),
                'persentase_tidur' => $this->request->getVar('persentase_tidur'),
                'persentase_kerja' => $this->request->getVar('persentase_kerja'),
            ]);
        } else {
            if (!$this->validate([
                'Nama_area' => [
                    'rules' => 'is_unique[data_area.Nama_area]',
                    'erors' => [
                        'required' => '{field} field harus diisi.',
                        'is_unique' => '{field} nama sudah terdaftar.'
                    ]
                ]
            ])) {
                return redirect()->to('/Area');
            }
            $this->LokasiModel->save([
                'ID_area' => $ID_area,
                'Nama_area' => $this->request->getVar('Nama_area'),
                'Lokasi' => $this->request->getVar('Lokasi'),
                'persentase_ngantuk' => $this->request->getVar('persentase_ngantuk'),
                'persentase_tidur' => $this->request->getVar('persentase_tidur'),
                'persentase_kerja' => $this->request->getVar('persentase_kerja'),
            ]);
        }
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Area');
    }

    public function reportpdf()
    {
        $Area = $this->LokasiModel->findAll();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/Area_pdf', [
            'Area' => $Area
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
    // export excel
    public function export_excel()
    {

        //  $semua_pengguna = $this->export_model->getAll()->result();
        $Area = $this->LokasiModel->findAll();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama_area')
            ->setCellValue('C1', 'Lokasi');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($Area as $A) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $A['Nama_area'])
                ->setCellValue('C' . $kolom, $A['Lokasi']);

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
            return redirect()->to('/Area/index');
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
                $Lokasi = $row[2];



                $this->builder->where(['Nama_area' => $Nama_area]);
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
                        'Nama_area' => $Nama_area,
                        'Lokasi' => $Lokasi,
                    ];
                    $this->builder->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            // foreach ($pesan_error as $error) {
            //     echo $error;
            // }

            $this->session->setFlashdata('pesan', "$jumlaherror Data tidak diimport karna memiliki kesamaan pada data yang sudah ada <br> $jumlahsukses Data berhasil di import");
            return redirect()->to('/Area');
        }
    }
}
