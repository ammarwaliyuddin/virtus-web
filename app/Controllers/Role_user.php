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
    public function __construct()
    {
        $this->RoleUserModel = new RoleUserModel();
        $this->JabatanModel = new JabatanModel();
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
        $data = [
            'Nama' => $this->request->getVar('Nama'),
            'NIK' => $this->request->getVar('NIK'),
            'Password' => $this->request->getVar('Password'),
            'Jabatan' => $this->request->getVar('Jabatan'),
            'Email' => $this->request->getVar('Email'),
            'Keterangan' => $this->request->getVar('Keterangan'),
            'Foto' => $this->request->getVar('Foto'),
            'Role' => $this->request->getVar('Role')
        ];
        $this->RoleUserModel->simpan($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Role_user');
    }

    public function delete($NIK)
    {
        $this->RoleUserModel->delete($NIK);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Role_user');
    }

    public function edit($NIK)
    {

        $data = [
            'Nama' => $this->request->getVar('Nama'),
            'NIK' => $this->request->getVar('NIK'),
            'Password' => $this->request->getVar('Password'),
            'Jabatan' => $this->request->getVar('Jabatan'),
            'Email' => $this->request->getVar('Email'),
            'Keterangan' => $this->request->getVar('Keterangan'),
            'Foto' => $this->request->getVar('Foto'),
            'Status' => $this->request->getVar('status'),
            'role' => $this->request->getVar('role')
        ];
        // dd($data);
        $this->RoleUserModel->edit($NIK, $data);



        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Role_user');
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

    //export excel
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
}
