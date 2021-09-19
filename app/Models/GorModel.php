<?php

namespace App\Models;

use CodeIgniter\Model;

class GorModel extends Model
{
    protected $table      = 'gor';
    protected $primaryKey = 'id_gor';

    protected $allowedFields = [
        'id_gor',
        'nama_gor',
        'profil',
        'foto_muka'
    ];
}
