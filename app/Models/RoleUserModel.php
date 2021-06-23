<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleUserModel extends Model
{
    protected $table = 'master_data_admin';
    protected $primaryKey = 'NIK';
    protected $allowedFields = ['Nama', 'Status', 'Foto', 'Jabatan', 'Email', 'role'];

    protected $builder;

    public function simpan($data)
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('master_data_admin');

        return $this->builder->insert($data);
    }
    public function edit($NIK, $data)
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('master_data_admin');
        $this->builder->where('NIK', $NIK);
        return $this->builder->update($data);
    }
}
