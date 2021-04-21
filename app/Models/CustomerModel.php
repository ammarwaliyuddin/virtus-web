<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'master_data_customer';
    protected $primaryKey = 'ID_customer';
    protected $allowedFields = ['Nama_customer', 'Nama_PIC', 'Telepon_customer', 'Telepon_PIC', 'Email_PIC', 'Alamat_PIC', 'Area'];
}
