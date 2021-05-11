<?php

namespace App\Controllers;

use App\Models\SmartwatchModel;

class Smartwatch extends BaseController
{
    protected $JabatanModel;
    public function __construct()
    {
        $this->SmartwatchModel = new SmartwatchModel();
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
        $this->SmartwatchModel->delete($ID_jam);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Smartwatch');
    }
    public function reportpdf()
    {
        $Smartwatch = $this->SmartwatchModel->findAll();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Pengaturan/Smartwatch_pdf', [
            'Smartwatch' => $Smartwatch
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
}
