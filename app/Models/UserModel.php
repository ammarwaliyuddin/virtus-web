<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'master_data_admin';
    protected $allowedFields = ['NIK', 'Nama', 'Password', 'Status', 'Jabatan', 'Foto', 'Expiredate', 'Email', 'Keterangan'];
}
