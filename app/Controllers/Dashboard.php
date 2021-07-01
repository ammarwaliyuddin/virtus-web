<?php

namespace App\Controllers;

use App\Models\LokasiModel;

use App\Models\PersonilModel;
use CodeIgniter\Debug\Toolbar\Collectors\History;

class Dashboard extends BaseController
{
    protected $LokasiModel;
    protected $HistoryPelanggaran;
    public function __construct()
    {
        $this->LokasiModel = new LokasiModel();
        $this->HistoryPelanggaran = new PersonilModel();
    }

    public function index()
    {
        $session = session();
        $session->get('user_name');

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $Lokasi = $this->LokasiModel->searchLokasi($keyword);
        } else {
            $Lokasi = $this->LokasiModel->findAll();
        }




        $History = $this->HistoryPelanggaran->getNama();

        $data = [
            'Lokasi' => $Lokasi,
            'History' => $History
        ];

        //dd($data);
        return view('Dashboard/d_1', $data);
    }
}
