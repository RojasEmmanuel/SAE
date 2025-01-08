<?php

namespace App\Controllers;
use App\Models\EstudiantesModel;
use App\Models\AsistenciasModel;
use App\Models\EventosModel;

class DetallesEvt extends BaseController
{
    public function index($idEvento)
    {
        $asistenciasModel = new AsistenciasModel();
        $estudiantesModel = new EstudiantesModel();
        $eventosModel = new EventosModel();

        // Obtener los detalles del evento
        $evento = $eventosModel->find($idEvento);

        // Obtener los IDs de los estudiantes que asistieron al evento
        $asistencias = $asistenciasModel->where('idEvento', $idEvento)->findAll();
        $idEstudiantes = array_column($asistencias, 'nroControl');

        // Obtener los detalles de los estudiantes
        $estudiantes = $estudiantesModel->whereIn('nroControl', $idEstudiantes)->findAll();

        $data = [
            'title' => 'Detalles del Evento',
            'evento' => $evento,
            'estudiantes' => $estudiantes,
        ];
        
        return view('detallesEvento', $data);
    }
}
