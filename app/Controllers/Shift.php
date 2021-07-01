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
    protected $aturshift;

    public function __construct()
    {
        $this->ShiftModel = new ShiftModel();
        $this->AreaModel = new AreaModel();
        $this->builder      = \Config\Database::connect()->table('data_shift');
        $this->aturshift      = \Config\Database::connect()->table('data_shift_personil');
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
        if ($_SESSION['role'] == 'user') {
            session()->setFlashdata('pesan', 'tidak ada akses');
            return redirect()->to('/Dashboard');
        } else {

            $shift = $this->ShiftModel->findAll();
            $area = $this->AreaModel->findAll();
            $data = [
                'shift' => $shift,
                'area' => $area
            ];
            return view('Pengaturan/Shift', $data);
        }
    }
    public function save()
    {

        $this->builder->selectMax('ID_shift');
        $max = $this->builder->get()->getResultArray();
        $result = $max['0']['ID_shift'];
        $data = [
            'Nama_area' => $this->request->getVar('Nama_area'),
            'Hari' => $this->request->getVar('Hari'),
            'Jam' => $this->request->getVar('Jam'),
            'tanggali' => date("Y-m-d"),
            'ID_shift' => $result + 1


        ];
        // dd($data);

        $this->builder->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Shift/setting_shift');
    }
    public function delete($ID_shift)
    {
        $this->aturshift->where('ID_shift', $ID_shift);
        $this->aturshift->delete();
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
        if ($_SESSION['role'] == 'user') {
            session()->setFlashdata('pesan', 'tidak ada akses');
            return redirect()->to('/Dashboard');
        } else {

            $data = [
                'atur_shift' => $this->ShiftModel->atur_shift(),
                'nama_personil' => $this->ShiftModel->Personil_Shift(),
                'data_shift' => $this->ShiftModel->findAll()


            ];

            // dd($data);
            return view('Pengaturan/Atur_shift', $data);
        }
    }
    public function atur_shit_save()
    {
        $data = [
            'NIK' => $this->request->getVar('NIK'),
            'ID_shift' => $this->request->getVar('shift'),
        ];

        // dd($data);
        $this->ShiftModel->atur_shit_save($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Shift/setting_atur_shift');
    }
    public function atur_shit_edit($id)
    {
        $data = [
            'NIK' => $this->request->getVar('NIK'),
            'ID_shift' => $this->request->getVar('shift'),
        ];

        $this->aturshift->where('id', $id);
        $this->aturshift->update($data);
        // dd($data);

        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->to('/Shift/setting_atur_shift');
    }
    public function atur_shit_hapus($id)
    {


        $this->aturshift->where('id', $id);
        $this->aturshift->delete();

        session()->setFlashdata('pesan', 'Data berhasil hapus');
        return redirect()->to('/Shift/setting_atur_shift');
    }

    // export pdf
    public function reportpdf()
    {
        $shift = $this->ShiftModel->findAll();



        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/shift_pdf', [
            'shift' => $shift,
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }

    public function atur_reportpdf()
    {
        $data = [
            'atur_shift' => $this->ShiftModel->atur_shift(),

        ];
        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/atur_shift_pdf', $data);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
}
