<?php
namespace App\Controllers;
use App\Models\EventosModel;

class Principal extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM evento WHERE fecha >= CURDATE() ORDER BY fecha ASC LIMIT 3');
        $result = $query->getResult();

        $consulta = $db->query('SELECT * FROM evento');
        $r = $consulta->getResult();

        $data = [
            'title' => 'Principal',
            'notificaciones'=> $result,
            'eventos'=>$r
        ];
        
        return view('principal', $data);
    }

    public function insertarEvento()
    {
        $evt = new EventosModel();

        // Validación de datos
        $validation = $this->validate([
            'nombre' => 'required|min_length[3]|max_length[255]',
            'fecha' => 'required|valid_date',
            'hora' => 'required|regex_match[/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/]', // Validación de hora en formato HH:MM
            'lugar' => 'required|min_length[3]|max_length[255]',
            'area' => 'required|min_length[3]|max_length[255]',
            'tipo' => 'required|min_length[3]|max_length[255]',
            'responsable' => 'required|min_length[3]|max_length[255]',
            'descripcion' => 'required|min_length[3]|max_length[1000]'
        ]);

        if (!$validation) {
            // Si la validación falla, redirigir con errores
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Datos validados
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'fecha' => $this->request->getPost('fecha'),
            'hora' => $this->request->getPost('hora'),
            'lugar' => $this->request->getPost('lugar'),
            'area' => $this->request->getPost('area'),
            'tipo' => $this->request->getPost('tipo'),
            'responsable' => $this->request->getPost('responsable'),
            'descripcion' => $this->request->getPost('descripcion')
        ];

        // Insertar datos en la base de datos
        if ($evt->insert($data)) {
            return redirect()->to('/principal')->with('message', 'Evento insertado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al insertar el evento.');
        }
    }

}