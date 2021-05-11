<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Models\UserDelete;

class User extends BaseController
{
    protected $UserModel;
    protected $UserDelete;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->UserDelete = new UserDelete();
    }

    public function index()
    {
        $User = $this->UserDelete->getUser();

        $data = [
            'User' => $User
        ];

        return view('Pengaturan/User', $data);
    }

    public function save()
    {
        $this->UserModel->save([
            'NIK' => $this->request->getVar('NIK'),
            'Nama' => $this->request->getVar('Nama'),
            'Password' => $this->request->getVar('Password'),
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

    public function edit($Nama)
    {
        $this->UserModell->delete($Nama);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
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
}
