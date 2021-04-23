<?php

namespace App\Controllers;

use App\Models\JabatanModel;
use CodeIgniter\Validation\Rules;
use PDO;

class Jabatan extends BaseController
{
    protected $JabatanModel;
    public function __construct()
    {
        $this->JabatanModel = new JabatanModel();
    }

    public function index()
    {
        $Jabatan = $this->JabatanModel->findAll();

        $data = [
            'Jabatan' => $Jabatan
        ];

        return view('Pengaturan/Jabatan', $data);
    }

    public function save()
    {
        $this->JabatanModel->save([
            'Jabatan' => $this->request->getVar('Jabatan'),
            'Deskripsi' => $this->request->getVar('Deskripsi'),
            'Nama_area' => $this->request->getVar('Nama_area')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/Jabatan');
    }

    public function delete($ID_jabatan)
    {
        $this->JabatanModel->delete($ID_jabatan);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Jabatan');
    }

    public function edit($ID_jabatan)
    {
        $this->JabatanModel->delete($ID_jabatan);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Jabatan');
    }

    public function upload()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate(
            [
                'fileimport' => [
                    'label' => 'inputan file',
                    'rules' => 'uploaded[fileimport]|ext_in[fileimport,xls,xlsx]',
                    'errors' => [
                        'uploaded' => '{field} wajib diisi',
                        'ext_in' => '{field} harus ekstensi xls & xlsx'
                    ]
                ]
            ]
        );

        if (!$valid) {

            $this->session->setFlashdata('pesan', $validation->getError('fileimport'));
            return redirect()->to('/Jabatan/index');
        } else {
            $file_excel = $this->request->getFile('fileimport');

            $ext = $file_excel->getClientExtension();
            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $render->load($file_excel);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $pesan_error = [];
            $jumlaherror = 0;
            $jumlahsukses = 0;

            foreach ($data as $x => $row) {
                if ($x == 0) {
                    continue;
                }

                $Jabatan = $row[1];
                $Nama_area = $row[2];
                $Deskripsi = $row[3];

                $db = \Config\Database::connect();

                $builder = $db->table('data_jabatan');
                $builder->where(['Jabatan' => $Jabatan]);
                $builder->where(['Nama_area' => $Nama_area]);
                $cekdata = $builder->get();

                // $cekNama_area =  $db->table('data_area')->getWhere(['Nama_area' => $Nama_area])->getResult();
                if (count($cekdata->getResult()) > 0) {
                    $jumlaherror++;
                    // // $pesan_error[] = "Jabatan : $Jabatan, dan Nama Area $Nama_area, sudah ada<br>";
                    // $pesan_error = [
                    //     'Jabatan' => $Jabatan,
                    //     'Nama_area' => $Nama_area
                    // ];
                } else {
                    $datasimpan = [
                        'Jabatan' => $Jabatan,  'Deskripsi' => $Deskripsi, 'Nama_area' => $Nama_area,
                    ];
                    $db->table('data_jabatan')->insert($datasimpan);
                    $jumlahsukses++;
                }
            }
            // foreach ($pesan_error as $error) {
            //     echo $error;
            // }

            $this->session->setFlashdata('pesan', "$jumlaherror Data tidak diimport karna memiliki kesamaan pada data yang sudah ada <br> $jumlahsukses Data berhasil di import");
            return redirect()->to('/Jabatan');
        }
    }
}
