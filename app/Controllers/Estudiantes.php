<?php

namespace App\Controllers;

class Estudiantes extends BaseController
{
    public function index()//: string
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM estudiantes');
        $result = $query->getResult();

        $data = [
            'title' => 'Estudiantes Inscritos',
            'estudiantes' => $result
        ];
        
        return view('estudiantesTabla', $data);
    }
}