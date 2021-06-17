<?php

namespace App\Controllers;

use App\Models\SmartwatchModel;

class Smartwatch extends BaseController
{
    protected $JabatanModel;
    public $builder;
    public function __construct()
    {
        $this->SmartwatchModel = new SmartwatchModel();
        $this->builder   = \Config\Database::connect()->table('data_jam');
    }

    public function index()
    {
        $Smartwatch = $this->SmartwatchModel->findAll();

        $data = [
            'Smartwatch' => $Smartwatch
        ];


        return view('Pengaturan/Smartwatch', $data);
    }

    public function save()
    {
        $this->SmartwatchModel->save([
            'merek' => $this->request->getVar('merek'),
            'longitude' => $this->request->getVar('longitude'),
            'latitude' => $this->request->getVar('latitude')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Smartwatch');
    }

    public function delete($ID_jam)
    {
        $this->SmartwatchModel->delete($ID_jam);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Smartwatch');
    }

    public function edit($ID_jam)
    {

        $merek = $this->request->getVar('merek');
        $latitude = $this->request->getVar('latitude');
        $longitude = $this->request->getVar('longitude');
        $lokasi = $this->request->getVar('lokasi');

        $data = [
            'ID_jam' => $ID_jam,
            'merek' => $merek,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'lokasi' => $lokasi
        ];

        // dd($data);

        $this->builder->where('ID_jam', $ID_jam);
        $this->builder->update($data);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Smartwatch');
    }
    public function reportpdf()
    {
        $Smartwatch = $this->SmartwatchModel->findAll();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/Smartwatch_pdf', [
            'Smartwatch' => $Smartwatch
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
}
