<?php 
namespace App\Models;  
use CodeIgniter\Model;

  
class AdminModel extends Model{

    protected $table = 'admin';
    
    protected $allowedFields = [
        'id_gor',
        'nama_admin',
        'no_hp',
        'jk',
        'alamat',
        'email',
        'password'
    ];

}