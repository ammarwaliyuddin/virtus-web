<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonilModel extends Model
{
    protected $table = 'master_data_personil';
    protected $primaryKey = 'NIK';
    protected $allowedFields = ['Nama', 'Umur', 'Status', 'Foto'];

    public function getNama()
    {
        return $this->db->table('master_data_personil')
            ->join('data_pelanggaran', 'master_data_personil.NIK=data_pelanggaran.NIK')
            ->join('data_shift_personil', 'data_shift_personil.NIK=master_data_personil.NIK')
            ->get()->getResultArray();
    }

    public function getPersonil()
    {
        return $this->db->table('master_data_personil')
            ->join('data_shift_personil', 'data_shift_personil.NIK=master_data_personil.NIK')
            ->get()->getResultArray();
    }
}
