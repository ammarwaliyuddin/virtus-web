<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table = 'data_area';
    protected $primaryKey = 'ID_pelanggaran';
    protected $allowedFields = ['Lokasi', 'persentase_ngantuk', 'persentase_tidur', 'persentase_kerja'];
}
