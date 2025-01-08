<?php
namespace App\Models;

use CodeIgniter\Model;

class EstudiantesModel extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'nroControl';
    protected $allowedFields = ['nroControl', 'nombre', 'semestre', 'sexo', 'carrera'];
}