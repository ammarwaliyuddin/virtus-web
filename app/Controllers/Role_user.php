<?php

namespace App\Controllers;

use App\Models\RoleUserModel;
use App\Models\JabatanModel;

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
}
