<?php

namespace App\Controllers;

use App\Models\RoleUserModel;

class Role_user extends BaseController
{
    protected $RoleUserModel;
    public function __construct()
    {
        $this->RoleUserModel = new RoleUserModel();
    }


    public function index()
    {
        $RoleUser = $this->RoleUserModel->findAll();

        $data = [
            'RoleUser' => $RoleUser
        ];

        return view('Pengaturan/Role_user', $data);
    }

    public function save()
    {
        $this->RoleUserModel->save([
            'Jabatan' => $this->request->getVar('Jabatan'),
            'Lihat' => $this->request->getVar('Lihat'),
            'Tambah' => $this->request->getVar('Tambah'),
            'Ubah' => $this->request->getVar('Ubah'),
            'Hapus' => $this->request->getVar('Hapus')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Role_user');
    }

    public function delete($ID_role_user)
    {
        $this->RoleUserModel->delete($ID_role_user);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Role_user');
    }

    public function edit($ID_role_user)
    {
        $this->RoleUserModel->edit($ID_role_user);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Role_user');
    }
}
