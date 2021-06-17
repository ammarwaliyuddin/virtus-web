<?php

namespace App\Controllers;

use App\Models\LokasiModel;

use App\Models\PersonilModel;

class Security extends BaseController
{
    protected $PersonilModel;
    protected $LokasiModel;
    public function __construct()
    {
        $this->LokasiModel = new LokasiModel();
        $this->PersonilModel = new PersonilModel();
    }

    public function index()
    {
        // $Lokasi = $this->LokasiModel->findAll();
        // $Personil = $this->PersonilModel->findAll();

        // dd($personil_lokasi);
        $keyword = $this->request->getVar('keyword');


        if ($keyword) {
            $personil_lokasi = $this->PersonilModel->searchPersonil($keyword);
        } else {
            $personil_lokasi = $this->PersonilModel->getPersonil();
        }
        // dd($personil_lokasi = $this->PersonilModel->getPersonil());
        $data = [
            // 'Lokasi' => $Lokasi,
            // 'Personil' => $Personil
            'Personil_lokasi' => $personil_lokasi
        ];

        // dd($data);
        return view('Security/Security', $data);
    }

    public function save()
    {
        $this->PersonilModel->save([
            'Nama' => $this->request->getVar('Nama'),
            'Umur' => $this->request->getVar('Umur'),
            'Nomor_HP' => $this->request->getVar('Nomor_HP'),
            'Status' => $this->request->getVar('Status'),
            'Email' => $this->request->getVar('Email'),
            'Nama_area' => $this->request->getVar('Nama_area'),
            'NIK' => $this->request->getVar('NIK'),
            'Foto' => $this->request->getVar('Foto')
        ]);



        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Security/setting_personil');
    }

    public function detail_personil($detail)
    {
        $detail = $this->PersonilModel->detailPersonil($detail);
        // dd($detail);
        // dd($detail);
        // $data = [
        //     // 'Lokasi' => $Lokasi,
        //     // 'Personil' => $Personil
        //     'detail' => $detail
        // ];

        $data = ['detail' => $detail[0]];
        // dd($data);
        // dd($data);
        return view('Security/Detail_Personil', $data);
    }
    public function setting_personil()
    {
        $personilAll = $this->PersonilModel->getPersonil();
        $Area = $this->LokasiModel->findAll();
        $data = [
            'personilAll' => $personilAll,
            'Area' => $Area
        ];

        return view('Pengaturan/Personil', $data);
    }
}
