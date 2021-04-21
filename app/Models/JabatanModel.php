<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table = 'data_jabatan';
    protected $primaryKey = 'ID_jabatan';
    protected $allowedFields = ['Jabatan', 'Deskripsi', 'Nama_area'];
}
