<?php

namespace App\Controllers;
use App\Models\EventosModel;

class Proximos extends BaseController
{
    public function index()//: string
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM evento WHERE fecha >= CURDATE()');
        $result = $query->getResult();

        $data = [
            'title' => 'Eventos Próximos',
            'eventos' => $result
        ];

        return view('eventosProximos', $data);
    }

    public function eliminarEvento($id)
    {
        $evt = new EventosModel();

        // Intentar eliminar el evento
        if ($evt->delete($id)) {
            return redirect()->to('/principal')->with('message', 'Evento eliminado correctamente.');
        } else {
            return redirect()->to('/principal')->with('error', 'Error al eliminar el evento.');
        }
    }

    public function editarEvento()
    {
        $evt = new EventosModel();

        // Validación de datos
        $validation = $this->validate([
            'idEvento' => 'required|integer',
            'nombre' => 'required|min_length[3]|max_length[255]',
            'fecha' => 'required|valid_date',
            'hora' => 'required|regex_match[/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/]', // Validación de hora en formato HH:MM:SS
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
            'idEvento' => $this->request->getPost('idEvento'),
            'nombre' => $this->request->getPost('nombre'),
            'fecha' => $this->request->getPost('fecha'),
            'hora' => $this->request->getPost('hora'),
            'lugar' => $this->request->getPost('lugar'),
            'area' => $this->request->getPost('area'),
            'tipo' => $this->request->getPost('tipo'),
            'responsable' => $this->request->getPost('responsable'),
            'descripcion' => $this->request->getPost('descripcion')
        ];  

        // Actualizar datos en la base de datos
        if ($evt->save($data)) {
            return redirect()->to('/proximos')->with('message', 'Evento actualizado correctamente.');
        } else {
            return redirect()->to('/proximos')->with('error', 'Error al actualizar el evento.');
        }
    }

}
