<?php

namespace App\Controllers;

use App\Models\LokasiModel;

use App\Models\PersonilModel;

class Security extends BaseController
{
    protected $PersonilModel;
    protected $LokasiModel;
    protected $builder;
    public function __construct()
    {
        $this->LokasiModel = new LokasiModel();
        $this->PersonilModel = new PersonilModel();
        $this->builder      = \Config\Database::connect()->table('master_data_personil');
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
        $data = [
            'Nama' => $this->request->getVar('Nama'),
            'Umur' => $this->request->getVar('Umur'),
            'Nomor_HP' => $this->request->getVar('Nomor_HP'),
            'Status' => $this->request->getVar('Status'),
            'Email' => $this->request->getVar('Email'),
            'NIK' => $this->request->getVar('NIK'),
            'Foto' => $this->request->getVar('Foto'),
            'PIN' => $this->request->getVar('PIN'),
            'Status' => '0'
        ];

        $this->builder->insert($data);

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
        // $personilAll = $this->PersonilModel->getPersonil();
        $personilAll = $this->PersonilModel->findAll();
        // $Area = $this->LokasiModel->findAll();
        $data = [
            'personilAll' => $personilAll
            // 'Area' => $Area
        ];

        return view('Pengaturan/Personil', $data);
    }
    public function delete($NIK)
    {
        $this->PersonilModel->delete($NIK);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Security/setting_personil');
    }
    public function edit($NIK)
    {

        $data = [
            'Nama' => $this->request->getVar('Nama'),
            'Umur' => $this->request->getVar('Umur'),
            'Nomor_HP' => $this->request->getVar('Nomor_HP'),
            'Email' => $this->request->getVar('Email'),
            'NIK' => $this->request->getVar('NIK'),
            'Foto' => $this->request->getVar('Foto'),
            'PIN' => $this->request->getVar('PIN'),
            'Status' => '0'
        ];


        // dd($data);

        $this->builder->where('NIK', $NIK);
        $this->builder->update($data);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Security/setting_personil');
    }
    // export pdf
    public function reportpdf()
    {
        $personilAll = $this->PersonilModel->findAll();
        // dd($role);
        // die;

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/personil_pdf', [
            'personilAll' => $personilAll
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
}
