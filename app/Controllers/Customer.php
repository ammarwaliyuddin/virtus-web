<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customer extends BaseController
{
    protected $CustomerModel;
    public function __construct()
    {
        $this->CustomerModel = new CustomerModel();
    }

    public function index()
    {
        $Customer = $this->CustomerModel->findAll();

        $data = [
            'Customer' => $Customer
        ];

        return view('Pengaturan/Customer', $data);
    }

    public function save()
    {
        $this->CustomerModel->save([
            'Nama_customer' => $this->request->getVar('Nama_customer'),
            'Nama_PIC' => $this->request->getVar('Nama_PIC'),
            'Telepon_customer' => $this->request->getVar('Telepon_customer'),
            'Telepon_PIC' => $this->request->getVar('Telepon_PIC'),
            'Email_PIC' => $this->request->getVar('Email_PIC'),
            'Alamat_PIC' => $this->request->getVar('Alamat_PIC'),
            'Area' => $this->request->getVar('Area')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Customer');
    }

    public function delete($ID_customer)
    {
        $this->CustomerModel->delete($ID_customer);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Customer');
    }

    public function edit($ID_customer)
    {
        $this->CustomerModel->delete($ID_customer);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Customer');
    }
    public function reportpdf()
    {
        $Customer = $this->CustomerModel->findAll();
        // var_dump($Customer);
        // die;

        $mpdf = new \Mpdf\Mpdf();

        $html = view('Pengaturan/Customer_pdf', [
            'Customer' => $Customer
        ]);
        $mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
        $mpdf->WriteHTML($html);

        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
    }
}
