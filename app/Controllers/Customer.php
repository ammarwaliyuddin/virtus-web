<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Customer extends BaseController
{
    protected $CustomerModel;
    protected $builder;
    public function __construct()
    {
        $this->CustomerModel = new CustomerModel();
        $this->builder   = \Config\Database::connect()->table('master_data_customer');
    }

    public function index()
    {
        if ($_SESSION['role'] == 'user') {
            session()->setFlashdata('pesan', 'tidak ada akses');
            return redirect()->to('/Dashboard');
        } else {

            $Customer = $this->CustomerModel->findAll();

            $data = [
                'Customer' => $Customer
            ];

            return view('Pengaturan/Customer', $data);
        }
    }

    public function save()
    {
        $this->CustomerModel->save([
            'Nama_customer' => $this->request->getVar('Nama_customer'),
            'Nama_PIC' => $this->request->getVar('Nama_PIC'),
            'Telepon_customer' => $this->request->getVar('Telepon_customer'),
            'Telepon_PIC' => $this->request->getVar('Telepon_PIC'),
            'Email_PIC' => $this->request->getVar('Email_PIC'),
            'Alamat_PIC' => $this->request->getVar('Alamat_PIC'),
            'Area' => $this->request->getVar('Area')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Customer');
    }

    public function delete($ID_customer)
    {
        $this->CustomerModel->delete($ID_customer);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Customer');
    }

    public function update($ID_customer)
    {
        $this->CustomerModel->save([
            'ID_customer' => $ID_customer,
            'Nama_customer' => $this->request->getVar('Nama_customer'),
            'Nama_PIC' => $this->request->getVar('Nama_PIC'),
            'Telepon_customer' => $this->request->getVar('Telepon_customer'),
            'Telepon_PIC' => $this->request->getVar('Telepon_PIC'),
            'Email_PIC' => $this->request->getVar('Email_PIC'),
            'Alamat_PIC' => $this->request->getVar('Alamat_PIC'),
            'Area' => $this->request->getVar('Area')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Customer');
    }

    public function reportpdf()
    {
        $Customer = $this->CustomerModel->findAll();
        // var_dump($Customer);
        // die;

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/Customer_pdf', [
            'Customer' => $Customer
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }

    // export excel
    public function export()
    {

        $Customer = $this->CustomerModel->findAll();
        // dd($User);

        $spreadsheet = new Spreadsheet;


        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama_customer')
            ->setCellValue('C1', 'Telepon_customer')
            ->setCellValue('D1', 'Nama_PIC')
            ->setCellValue('E1', 'Telepon_PIC')
            ->setCellValue('F1', 'Email_PIC')
            ->setCellValue('G1', 'Alamat_PIC')
            ->setCellValue('H1', 'Area');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($Customer as $C) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $C['Nama_customer'])
                ->setCellValue('C' . $kolom, $C['Telepon_customer'])
                ->setCellValue('D' . $kolom, $C['Nama_PIC'])
                ->setCellValue('E' . $kolom, $C['Telepon_PIC'])
                ->setCellValue('F' . $kolom, $C['Email_PIC'])
                ->setCellValue('G' . $kolom, $C['Alamat_PIC'])
                ->setCellValue('H' . $kolom, $C['Area']);

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
            return redirect()->to('/Customer/index');
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

                $Nama_customer = $row[1];
                $Telepon_customer = $row[2];
                $Nama_PIC = $row[3];
                $Telepon_PIC = $row[4];
                $Email_PIC = $row[5];
                $Alamat_PIC = $row[6];
                $Area = $row[7];


                $this->builder->where(['Nama_customer' => $Nama_customer]);
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
                        'Nama_customer' => $Nama_customer,
                        'Telepon_customer' => $Telepon_customer,
                        'Nama_PIC' => $Nama_PIC,
                        'Telepon_PIC' => $Telepon_PIC,
                        'Email_PIC' => $Email_PIC,
                        'Alamat_PIC' => $Alamat_PIC,
                        'Area' => $Area,
                    ];
                    $this->builder->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            // foreach ($pesan_error as $error) {
            //     echo $error;
            // }

            $this->session->setFlashdata('pesan', "$jumlaherror Data tidak diimport karna memiliki kesamaan pada data yang sudah ada <br> $jumlahsukses Data berhasil di import");
            return redirect()->to('/Customer');
        }
    }
}
