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
        $Shift = $this->ShiftModel->getShift();

        $data = [
            'Shift' => $Shift,
        ];

        //dd($data);
        return view('Shift/Shift', $data);
    }
}
