<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'data_area';
    protected $primaryKey = 'ID_area';
    protected $allowedFields = ['Nama_area', 'persentase_tidur', 'persentase_ngantuk', 'persentase_kerja', 'Lokasi'];

    public function getLokasi()
    {
        return $this->findAll();
    }
}
