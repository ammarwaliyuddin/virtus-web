<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleUserModel extends Model
{
    protected $table = 'data_role_user';
    protected $primaryKey = 'ID_role_user';
    protected $allowedFields = ['Jabatan', 'Lihat', 'Tambah', 'Ubah', 'Hapus'];
}
