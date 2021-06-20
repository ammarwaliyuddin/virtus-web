<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'data_area';
    protected $primaryKey = 'ID_area';
    protected $allowedFields = ['Nama_area', 'persentase_tidur', 'persentase_ngantuk', 'persentase_kerja', 'Lokasi'];

    public function getLokasi()
    {
        return $this->findAll();
    }
    public function area($ID_area)
    {
        $builder = $this->db->table('data_area');
        $builder->where(['ID_area' => $ID_area]);
        $area = $builder->get()->getResultArray();
        return $area;
    }
}
