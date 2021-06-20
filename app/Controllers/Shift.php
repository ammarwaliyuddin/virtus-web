<?php

namespace App\Controllers;

use App\Models\LoginModel;

use App\Models\ShiftModel;
use App\Models\AreaModel;

class Shift extends BaseController
{
    protected $ShiftModel;
    protected $AreaModel;
    protected $builder;

    public function __construct()
    {
        $this->ShiftModel = new ShiftModel();
        $this->AreaModel = new AreaModel();
        $this->builder      = \Config\Database::connect()->table('data_shift');
    }


    public function index()
    {


        $keyword = $this->request->getVar('keyword');



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
        $shift = $this->ShiftModel->findAll();
        $area = $this->AreaModel->findAll();
        $data = [
            'shift' => $shift,
            'area' => $area
        ];
        return view('Pengaturan/Shift', $data);
    }
    public function save()
    {
        $data = [
            'Nama_area' => $this->request->getVar('Nama_area'),
            'Hari' => $this->request->getVar('Hari'),
            'Jam' => $this->request->getVar('Jam'),
            'tanggali' => date("Y-m-d")
        ];


        $this->builder->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Shift/setting_shift');
    }
    public function delete($ID_shift)
    {
        $this->ShiftModel->delete($ID_shift);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Shift/setting_shift');
    }
    public function edit($id)
    {

        $data = [
            'Nama_area' => $this->request->getVar('Nama_area'),
            'Hari' => $this->request->getVar('Hari'),
            'Jam' => $this->request->getVar('Jam'),
            'tanggali' => date("Y-m-d")
        ];

        // dd($data);

        $this->builder->where('ID_shift', $id);
        $this->builder->update($data);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Shift/setting_shift');
    }
    public function setting_atur_shift()
    {

        $data = [
            'atur_shift' => $this->ShiftModel->atur_shift(),
            'nama_personil' => $this->ShiftModel->Personil_Shift(),
            'data_shift' => $this->ShiftModel->findAll()


        ];

        // dd($data);
        return view('Pengaturan/Atur_shift', $data);
    }
    public function atur_shit_save()
    {
        $data = [
            'NIK' => $this->request->getVar('Nama'),
            'ID_shift' => $this->request->getVar('shift'),
        ];

        // dd($data);
        $this->ShiftModel->atur_shit_save($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Shift/setting_atur_shift');
    }
}
