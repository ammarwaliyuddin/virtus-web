<?php

namespace App\Controllers;

use App\Models\LokasiModel;

use App\Models\AreaModel;

use PDO;
use \Mpdf\Mpdf;

class Area extends BaseController
{
    protected $LokasiModel;
    public function __construct()
    {
        $this->LokasiModel = new LokasiModel();
    }

    public function index()
    {
        $Area = $this->LokasiModel->findAll();

        $data = [
            'Area' => $Area
        ];

        return view('Pengaturan/Area', $data);
    }

    public function save()
    {
        // dd($this->request->getVar());
        $this->LokasiModel->save([
            'Nama_area' => $this->request->getVar('Nama_area'),
            'Lokasi' => $this->request->getVar('Lokasi'),
            'persentase_ngantuk' => $this->request->getVar('persentase_ngantuk'),
            'persentase_tidur' => $this->request->getVar('persentase_tidur'),
            'persentase_kerja' => $this->request->getVar('persentase_kerja'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Area');
    }

    public function delete($ID_area)
    {
        $this->LokasiModel->delete($ID_area);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Area');
    }

    public function edit($Nama_area)
    {
        $this->LokasiModel->delete($Nama_area);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Area');
    }
    public function reportpdf()
    {
        $Area = $this->LokasiModel->findAll();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Pengaturan/Area_pdf', [
            'Area' => $Area
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
}
