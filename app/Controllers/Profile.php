<?php

namespace App\Controllers;

use App\Models\RoleUserModel;
use App\Models\JabatanModel;


class Profile extends BaseController
{
    protected $RoleUserModel;
    protected $JabatanModel;

    public function __construct()
    {
        $this->RoleUserModel = new RoleUserModel();
        $this->JabatanModel = new JabatanModel();
    }

    public function index()
    {


        $RoleUser = $this->RoleUserModel->where('NIK',  $_SESSION['NIK'])->findAll();

        $data = [
            'RoleUser' => $RoleUser[0]
        ];

        return view('Profile/index', $data);
    }
}
