<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciasModel extends Model
{
    protected $table = 'asistencias';
    protected $allowedFields = ['idEvento','nroControl'];
}