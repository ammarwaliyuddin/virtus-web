<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDelete extends Model
{
    protected $table = 'master_data_admin';
    protected $primaryKey = 'NIK';
    protected $allowedFields = ['Nama', 'Status', 'Jabatan', 'Foto', 'Expiredate', 'Email', 'Keterangan'];

    public function getUser()
    {
        return $this->db->table('master_data_admin')
            ->select('NIK, Nama, Jabatan')
            ->get()->getResultArray();
    }

    public function insertUser()
    {
        return $this->db->table('master_data_admin')
            ->select('*')
            ->get()->getResultArray();
    }
}
