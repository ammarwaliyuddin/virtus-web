<?php

namespace App\Controllers;

use App\Models\ShiftModel;
class Dashboard2 extends BaseController
{
    protected $LokasiModel;
    public function __construct()
    {
        $this->ShiftModel = new ShiftModel();
    }
    
    public function index($Nama_area)
    {
        //$area = $this->ShiftModel->where(['Nama_area' => $Nama_area])->getShift();
        //dd($area);
        return view('Dashboard/d_2');
    }
    
}
