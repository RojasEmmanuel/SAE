<?php

namespace App\Controllers;

class Formatos extends BaseController
{
    public function index()//: string
    {
        $data = [
            'title' => 'Formatos',
        ];
        return view('formatos',$data);
    }
}
