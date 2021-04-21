<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'master_data_admin';
    protected $primaryKey = 'NIK';
    protected $allowedFields = ['Nama', 'Password', 'Status', 'Foto', 'Jabatan', 'Expiredate', 'Keterangan'];
}
