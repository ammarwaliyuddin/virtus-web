<?php

namespace App\Controllers;

use App\Models\ShiftModel;
use App\Models\PersonilModel;

class Dashboard2 extends BaseController
{
    protected $LokasiModel;
    protected $HistoryPelanggaran;
    public function __construct()
    {
        $this->ShiftModel = new ShiftModel();
        $this->HistoryPelanggaran = new PersonilModel();
    }

    public function index($Nama_area)
    {
        //$area = $this->ShiftModel->where(['Nama_area' => $Nama_area])->getShift();
        //dd($area);
        $session = session();
        $session->get('user_name');

        // $Lokasi = $this->LokasiModel->findAll();
        //  $History = $this->HistoryPelanggaran->findAll();
        $History = $this->HistoryPelanggaran->getNama();
        //  $data['siswa'] = $model->getSiswa();

        $data = [
            // 'Lokasi' => $Lokasi,
            'History' => $History
        ];
        return view('Dashboard/d_2', $data);
    }
}
