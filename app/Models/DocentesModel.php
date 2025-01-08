<?php
namespace App\Models;

use CodeIgniter\Model;

class DocentesModel extends Model
{
    protected $table = 'docentes';
    protected $primaryKey = 'idDocentes';
    protected $allowedFields = ['idDocentes','nombre', 'academia', 'telefono', 'rfc', 'curp'];
}