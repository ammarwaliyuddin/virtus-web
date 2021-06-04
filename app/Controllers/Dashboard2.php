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

    public function index($ID_area)
    {
        // $ID_area = $this->ShiftModel->where(['ID_area' => $ID_area])->getShift();
        $Monitoring = $this->ShiftModel->getAreaByID($ID_area);
        // dd($Monitoring);
        $session = session();
        $session->get('user_name');

        // $Lokasi = $this->LokasiModel->findAll();
        //  $History = $this->HistoryPelanggaran->findAll();
        $History = $this->HistoryPelanggaran->getNama();
        //  $data['siswa'] = $model->getSiswa();

        $data = [
            // 'Lokasi' => $Lokasi,
            'History' => $History,
            'Monitoring' => $Monitoring
        ];
        // dd($data);
        return view('Dashboard/d_2', $data);
    }
}
