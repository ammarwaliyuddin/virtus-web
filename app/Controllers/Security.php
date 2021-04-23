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
        $Lokasi = $this->LokasiModel->findAll();
        $Personil = $this->PersonilModel->findAll();

        $data = [
            'Lokasi' => $Lokasi,
            'Personil' => $Personil
        ];

        //dd($data);
        return view('Security/Security', $data);
    }

    public function detail_personil()
    {
        return view('Security/Detail_Personil');
    }
}
