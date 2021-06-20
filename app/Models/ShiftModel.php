<?php

namespace App\Models;

use CodeIgniter\Model;

class ShiftModel extends Model
{
    protected $table = 'data_shift';
    protected $primaryKey = 'ID_shift';
    protected $allowedFields = ['shift', 'hari', 'jam', 'Nama_area', 'tanggali'];

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
        $builder = $this->db->table('data_area');
        $builder->where(['ID_area' => $ID_area]);
        $builder->join('data_shift_personil', 'data_shift_personil.Nama_area=data_area.Nama_area');
        $builder->join('master_data_personil', 'master_data_personil.NIK=data_shift_personil.NIK');
        $builder->orderBy('State ASC');
        $monitoring = $builder->get()->getResultArray();
        return $monitoring;
    }
    public function searchShift($keyword)
    {
        return $this->db->table('data_shift')
            ->join('data_shift_personil', 'data_shift_personil.ID_shift=data_shift.ID_shift')
            ->join('master_data_personil', 'data_shift_personil.NIK=master_data_personil.NIK')
            ->join('data_area', 'data_shift_personil.Nama_area=data_area.Nama_area')
            ->like('master_data_personil.Nama', $keyword)
            ->orLike('data_area.Nama_area', $keyword)
            // ->orLike('data_shift_personil.NIK', $keyword)
            ->get()->getResultArray();
    }

    public function atur_shift()
    {
        $builder = $this->db->table('data_shift_personil');
        $builder->join('master_data_personil', 'master_data_personil.NIK=data_shift_personil.NIK');
        $builder->join('data_shift', 'data_shift_personil.ID_shift=data_shift.ID_shift');
        $builder->select('master_data_personil.NIK, master_data_personil.Nama, data_shift.Nama_area, data_shift.Jam,data_shift.Hari');
        return $builder->get()->getResultArray();
    }
    public function Personil_Shift()
    {

        $builder = $this->db->table('master_data_personil');

        $builder->select('Nama, NIK');
        $query = $builder->get()->getResultArray();
        return $query;
    }
    public function Area_Shift()
    {

        $builder = $this->db->table('data_area');

        $builder->select('Nama_area');
        $query = $builder->get()->getResultArray();
        return $query;
    }
    public function atur_shit_save($data)
    {

        $builder = $this->db->table('data_shift_personil');

        // $builder->select('Nama_area');
        $builder->insert($data);
        // $query = $builder->get()->getResultArray();
        return;
    }
}
