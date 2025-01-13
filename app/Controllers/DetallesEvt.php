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

        // Obtener el total de estudiantes
        $totalEstudiantes = $estudiantesModel->countAllResults();

        // Obtener los IDs de los estudiantes que asistieron al evento
        $asistencias = $asistenciasModel->where('idEvento', $idEvento)->findAll();
        $idEstudiantes = array_column($asistencias, 'nroControl');

        // Obtener el total de estudiantes que asistieron al evento
        $totalAsistentes = count($idEstudiantes);

        // Obtener el total de estudiantes hombres que asistieron al evento
        $totalHombres = $estudiantesModel->whereIn('nroControl', $idEstudiantes)->where('sexo', 'M')->countAllResults();

        // Obtener el total de estudiantes mujeres que asistieron al evento
        $totalMujeres = $estudiantesModel->whereIn('nroControl', $idEstudiantes)->where('sexo', 'F')->countAllResults();

        // Calcular el porcentaje de participación
        $porcentajeAsistentes = ($totalAsistentes / $totalEstudiantes) * 100;
       

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
            'totalAsistentes' => $totalAsistentes,
            'totalHombres' => $totalHombres,
            'totalMujeres' => $totalMujeres,
            'porcentajeAsistentes' => $porcentajeAsistentes,
        ];
        
        return view('detallesEvento', $data);
    }
}
