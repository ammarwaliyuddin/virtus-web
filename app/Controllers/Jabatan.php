<?php

namespace App\Controllers;

use App\Models\JabatanModel;

class Jabatan extends BaseController
{
    protected $JabatanModel;
    public function __construct()
    {
        $this->JabatanModel = new JabatanModel();
    }

    public function index()
    {
        $Jabatan = $this->JabatanModel->findAll();

        $data = [
            'Jabatan' => $Jabatan
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
        $this->JabatanModel->delete($ID_jabatan);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Jabatan');
    }
}
