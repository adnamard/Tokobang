<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarStatusModel extends Model
{
    protected $table            = 'daftar_status';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['status'];
}
