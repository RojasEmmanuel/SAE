<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Login extends BaseController
{
    private $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()//: string
    {
        return view('login');
    }

    public function auth(){
        $rules =[
            'username' => 'required',
            'password' => 'required',
        ];

        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors',$this->validator->listErrors());
        }

        $userModel = new AdminModel();
        $post = $this->request->getPost(['username','password']);
        $user = $userModel->validateUser($post['username'], $post['password']);
   
        if($user!== null){
            $this->setsession($user);
            return redirect()->to(base_url('principal'));
        }

        return redirect()->back()->withInput()->with('errors','El usuario o contraseña con incorrectos');
    }

    private function setsession($userdata){
        $data = [
            'logged_id'=>true,
            'userdid' => $userdata['idAdmin'],
            'usernombre' => $userdata['nombre'],
        ];

        $this->session->set($data);
    }

    public function logout(){
        if($this->session->get('logged_id')){
            $this->session->destroy();
        }

        return redirect()->to(base_url());
    }
}
