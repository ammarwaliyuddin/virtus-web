<?php

namespace App\Controllers;

use App\Models\LokasiModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function update($ID_area)
    {
        $AreaLama = $this->request->getVar('AreaLama');
        $AreaBaru = $this->request->getVar('Nama_area');
        if ($AreaLama == $AreaBaru) {
            $this->LokasiModel->save([
                'ID_area' => $ID_area,
                'Lokasi' => $this->request->getVar('Lokasi'),
                'persentase_ngantuk' => $this->request->getVar('persentase_ngantuk'),
                'persentase_tidur' => $this->request->getVar('persentase_tidur'),
                'persentase_kerja' => $this->request->getVar('persentase_kerja'),
            ]);
        } else {
            if (!$this->validate([
                'Nama_area' => [
                    'rules' => 'is_unique[data_area.Nama_area]',
                    'erors' => [
                        'required' => '{field} field harus diisi.',
                        'is_unique' => '{field} nama sudah terdaftar.'
                    ]
                ]
            ])) {
                return redirect()->to('/Area');
            }
            $this->LokasiModel->save([
                'ID_area' => $ID_area,
                'Nama_area' => $this->request->getVar('Nama_area'),
                'Lokasi' => $this->request->getVar('Lokasi'),
                'persentase_ngantuk' => $this->request->getVar('persentase_ngantuk'),
                'persentase_tidur' => $this->request->getVar('persentase_tidur'),
                'persentase_kerja' => $this->request->getVar('persentase_kerja'),
            ]);
        }
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/Area');
    }

    public function reportpdf()
    {
        $Area = $this->LokasiModel->findAll();

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Template_pdf/Area_pdf', [
            'Area' => $Area
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
    // export excel
    public function export_excel()
    {

        //  $semua_pengguna = $this->export_model->getAll()->result();
        $Area = $this->LokasiModel->findAll();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama_area')
            ->setCellValue('C1', 'Lokasi');

        $kolom = 2;
        $nomor = 1;
        $i = 1;
        foreach ($Area as $A) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $i++)
                ->setCellValue('B' . $kolom, $A['Nama_area'])
                ->setCellValue('C' . $kolom, $A['Lokasi']);

            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="rekap.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
