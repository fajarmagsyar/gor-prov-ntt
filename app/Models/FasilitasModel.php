<?php

namespace App\Models;

use CodeIgniter\Model;

class FasilitasModel extends Model
{
    protected $table      = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';

    protected $allowedFields = [
        'id_fasilitas',
        'id_gor',
        'nama_fasilitas',
        'keterangan',
        'foto_fasilitas'
    ];
}
