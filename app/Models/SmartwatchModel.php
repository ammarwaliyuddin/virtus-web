<?php

namespace App\Models;

use CodeIgniter\Model;

class SmartwatchModel extends Model
{
    protected $table = 'data_jam';
    protected $primaryKey = 'ID_jam';
    protected $allowedFields = ['merek', 'latitude', 'longitude'];
}
