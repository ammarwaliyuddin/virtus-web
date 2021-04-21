<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryPelanggaran extends Model
{
    protected $table = 'data_pelanggaran';
    protected $primaryKey = 'ID_pelanggaran';
    protected $allowedFields = ['NIK', 'tanggal', 'jam', 'jenis_pelanggaran'];
}
