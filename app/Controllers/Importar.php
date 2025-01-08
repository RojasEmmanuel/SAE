<?php
namespace App\Controllers;

use App\Models\DocentesModel;
use App\Models\EstudiantesModel;
class Importar extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Importar Datos',
        ];
        return view('importar',$data); // Vista del formulario
    }

    public function estudiantes()
    {
        $archivo = $this->request->getFile('archivo');

        if ($archivo->isValid() && !$archivo->hasMoved()) {
            $ruta = WRITEPATH . 'uploads/' . $archivo->getName();
            $archivo->move(WRITEPATH . 'uploads');

            // Instancia del modelo
            $usuarioModel = new EstudiantesModel();

            // Elimina todos los registros actuales de la tabla
            $usuarioModel->truncate();

            // Abre el archivo CSV
            if (($handle = fopen($ruta, 'r')) !== false) {
                // Lee el archivo línea por línea
                while (($datos = fgetcsv($handle, 1000, ',')) !== false) {
                    // Ajusta los índices según las columnas de tu CSV
                    $usuarioModel->insert([
                        'nroControl' => $datos[0],
                        'nombre' => $datos[1],
                        'semestre' => $datos[2],
                        'sexo' => $datos[3],
                        'carrera' => $datos[4]
                    ]);
                }
                fclose($handle);

                return redirect()->to('/estudiantes')->with('message', 'Datos importados correctamente. Los registros anteriores fueron eliminados.');
            }
        }

        return redirect()->to('/importar')->with('error', 'Error al procesar el archivo.');
    }

    public function docentes()
    {
        $archivo = $this->request->getFile('archivo');

        if ($archivo->isValid() && !$archivo->hasMoved()) {
            $ruta = WRITEPATH . 'uploads/' . $archivo->getName();
            $archivo->move(WRITEPATH . 'uploads');

            // Instancia del modelo
            $usuarioModel = new DocentesModel();

            // Elimina todos los registros actuales de la tabla
            $usuarioModel->truncate();

            // Abre el archivo CSV
            if (($handle = fopen($ruta, 'r')) !== false) {
                // Lee el archivo línea por línea
                while (($datos = fgetcsv($handle, 1000, ',')) !== false) {
                    // Ajusta los índices según las columnas de tu CSV
                    $usuarioModel->insert([
                        'idDocentes' => $datos[0],
                        'nombre' => $datos[1],
                        'academia' => $datos[2],
                        'telefono' => $datos[3],
                        'rfc' => $datos[4],
                        'curp' => $datos[5]
                    ]);
                }
                fclose($handle);

                return redirect()->to('/docentes')->with('message', 'Datos importados correctamente. Los registros anteriores fueron eliminados.');
            }
        }

        return redirect()->to('/importarDocente')->with('error', 'Error al procesar el archivo.');
    }
    
}
