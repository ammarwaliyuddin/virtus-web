<?php

namespace App\Controllers;

use App\Models\JabatanModel;
use App\Models\AreaModel;
use CodeIgniter\Validation\Rules;
use PDO;
use \Mpdf\Mpdf;

// require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Jabatan extends BaseController
{
    protected $JabatanModel;
    public $builder;

    public function __construct()
    {
        $this->JabatanModel = new JabatanModel();
        $this->areaModel = new AreaModel();
        $this->builder   = \Config\Database::connect()->table('data_jabatan');
    }

    public function index()
    {
        $Jabatan = $this->JabatanModel->findAll();
        $Area = $this->areaModel->findAll();

        $data = [
            'Jabatan' => $Jabatan,
            'Area' => $Area
        ];

        return view('Pengaturan/Jabatan', $data);
    }

    public function save()
    {


        $this->JabatanModel->save([
            'Jabatan' => $this->request->getVar('Jabatan'),
            'Deskripsi' => $this->request->getVar('Deskripsi'),
            'Nama_area' => $this->request->getVar('Nama_area')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Jabatan');
    }

    public function delete($ID_jabatan)
    {
        $this->JabatanModel->delete($ID_jabatan);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Jabatan');
    }

    public function edit($ID_jabatan)
    {
        $Jabatan = $this->request->getVar('Jabatan');
        $Nama_area = $this->request->getVar('Nama_area');
        $Deskripsi = $this->request->getVar('deskripsi');
        $data = [
            'ID_Jabatan' => $ID_jabatan,
            'Jabatan' => $Jabatan,
            'Nama_area' => $Nama_area,
            'Deskripsi' => $Deskripsi
        ];

        $this->builder->where('ID_jabatan', $ID_jabatan);
        $this->builder->update($data);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Jabatan');
    }

    //import excel
    public function import_excel()
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
            return redirect()->to('/Jabatan/index');
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

                $Jabatan = $row[1];
                $Nama_area = $row[2];
                $Deskripsi = $row[3];


                $this->builder->where(['Jabatan' => $Jabatan]);
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
                        'Jabatan' => $Jabatan,  'Deskripsi' => $Deskripsi, 'Nama_area' => $Nama_area,
                    ];
                    $this->builder->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            // foreach ($pesan_error as $error) {
            //     echo $error;
            // }

            $this->session->setFlashdata('pesan', "$jumlaherror Data tidak diimport karna memiliki kesamaan pada data yang sudah ada <br> $jumlahsukses Data berhasil di import");
            return redirect()->to('/Jabatan');
        }
    }
    public function reportpdf()
    {
        $Jabatan = $this->JabatanModel->findAll();
        // var_dump($Jabatan);
        // die;

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/Jabatan_pdf', [
            'Jabatan' => $Jabatan
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
    // export excel
    public function export_excel()
    {

        //  $semua_pengguna = $this->export_model->getAll()->result();
        $Jabatan = $this->JabatanModel->findAll();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Jabatan')
            ->setCellValue('C1', 'Nama_area')
            ->setCellValue('D1', 'Deskripsi');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($Jabatan as $J) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $J['Jabatan'])
                ->setCellValue('C' . $kolom, $J['Nama_area'])
                ->setCellValue('D' . $kolom, $J['Deskripsi']);

            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="rekap.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
