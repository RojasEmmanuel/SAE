<?php

namespace App\Controllers;

class Docentes extends BaseController
{
    public function index()//: string
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM docentes');
        $result = $query->getResult();

        $data = [
            'title' => 'Docentes del Periodo',
            'docentes' => $result
        ];
        
        return view('docentes',$data);
    }

    public function getAcademias()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT DISTINCT academia FROM docentes");
        $result = $query->getResultArray();
        return $this->response->setJSON($result);
    }
}
