<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonilModel extends Model
{
    protected $table = 'master_data_personil';
    protected $primaryKey = 'NIK';
    protected $allowedFields = ['Nama', 'Umur', 'Status', 'Foto', 'PIN', 'Nomor_HP', 'Email', 'NIK'];

    public function getNama()
    {
        return $this->db->table('master_data_personil')
            ->join('data_pelanggaran', 'master_data_personil.NIK=data_pelanggaran.NIK')
            ->join('data_shift_personil', 'data_shift_personil.NIK=master_data_personil.NIK')
            ->join('data_shift', 'data_shift.ID_shift=data_shift_personil.ID_shift')
            ->get()->getResultArray();
    }

    public function getPersonil()
    {
        return $this->db->table('master_data_personil')
            ->join('data_shift_personil', 'data_shift_personil.NIK=master_data_personil.NIK')
            ->join('data_shift', 'data_shift.ID_shift=data_shift_personil.ID_shift')
            ->get()->getResultArray();
    }

    public function searchPersonil($keyword)
    {
        return $this->db->table('master_data_personil')
            ->join('data_shift_personil', 'data_shift_personil.NIK=master_data_personil.NIK')
            ->join('data_shift', 'data_shift.ID_shift=data_shift_personil.ID_shift')
            ->like('Nama', $keyword)
            ->orLike('data_shift_personil.Nama_area', $keyword)
            ->orLike('data_shift_personil.NIK', $keyword)
            ->get()->getResultArray();
    }
    public function detailPersonil($detail)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('master_data_personil');
        $builder->where(['master_data_personil.NIK' => $detail]);
        $builder->join('data_shift_personil', 'data_shift_personil.NIK=master_data_personil.NIK');
        $builder->join('data_shift', 'data_shift_personil.ID_shift=data_shift.ID_shift');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function detailHistory($id)
    {
        return $this->db->table('master_data_personil')
            ->where(['master_data_personil.NIK' => $id])
            ->join('data_pelanggaran', 'master_data_personil.NIK=data_pelanggaran.NIK')
            ->join('data_shift_personil', 'data_shift_personil.NIK=master_data_personil.NIK')
            ->join('data_shift', 'data_shift.ID_shift=data_shift_personil.ID_shift')
            ->get()->getResultArray();
    }
}
