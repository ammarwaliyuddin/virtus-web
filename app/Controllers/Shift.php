<?php

namespace App\Controllers;

use App\Models\LoginModel;

use App\Models\ShiftModel;

class Shift extends BaseController
{
    protected $ShiftModel;
    public function __construct()
    {
        $this->ShiftModel = new ShiftModel();
    }


    public function index()
    {


        $keyword = $this->request->getVar('keyword');


        // $Shift = $this->ShiftModel->searchShift($keyword);
        if ($keyword) {
            $Shift = $this->ShiftModel->searchShift($keyword);
        } else {
            $Shift = $this->ShiftModel->getShift();
        }
        // dd($Shift);

        $data = [
            'Shift' => $Shift,
        ];

        // dd($data);
        return view('Shift/Shift', $data);
    }
    public function setting_shift()
    {

        return view('Pengaturan/Shift');
    }
    public function setting_atur_shift()
    {

        return view('Pengaturan/Atur_shift');
    }
}
