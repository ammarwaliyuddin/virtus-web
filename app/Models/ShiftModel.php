<?php

namespace App\Models;

use CodeIgniter\Model;

class ShiftModel extends Model
{
    protected $table = 'data_shift';
    protected $primaryKey = 'ID_shift';
    protected $allowedFields = ['shift', 'hari', 'jam', 'Nama_area'];

    public function getShift()
    {
        return $this->db->table('data_shift')
            ->join('data_shift_personil', 'data_shift.ID_shift=data_shift_personil.ID_shift')
            ->join('master_data_personil', 'data_shift_personil.NIK=master_data_personil.NIK')
            ->join('data_area', 'data_shift_personil.Nama_area=data_area.Nama_area')
            ->get()->getResultArray();
    }

    public function getAreaByID($ID_area)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('data_area');
        $builder->where(['ID_area' => $ID_area]);
        $builder->join('data_shift_personil', 'data_shift_personil.Nama_area=data_area.Nama_area');
        $builder->join('master_data_personil', 'master_data_personil.NIK=data_shift_personil.NIK');
        $builder->orderBy('State ASC');
        $monitoring = $builder->get()->getResultArray();
        return $monitoring;
    }
}
