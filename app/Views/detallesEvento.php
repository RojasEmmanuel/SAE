<?= $this->extend('layout/template')?>
<?= $this->section('content'); ?>

<div class="contenidoPagina">

    <h2 class="NombreEvento"><?= esc($evento['nombre']); ?></h2>
    <p class="fechaEvento"><?= formatearFecha($evento['fecha']); ?> : <?= esc($evento['hora']); ?></p>
    <p class="lugar"><?= esc($evento['lugar']); ?>📌</p>
    
    <br>    
    <div class="descripcionEvento">
        <p style="text-align: center;"><b><i>Descripción:</i> </b><?= esc($evento['descripcion']); ?></p>
    </div>
   
    <div class="estadisticas" style="display: flex; align-items: center; justify-content: center; width: 90%;">

        <table class="datosEstadisticos">
        <tr>
                <td>Responsable</td>
                <td><?= esc($evento['responsable']); ?></td>
            </tr>   
            <tr>
                <td>Área</td>
                <td><?= esc($evento['area']); ?></td>
            </tr>         
            
            <tr>
                <td>Total de Estudiantes que Asistieron</td>
                <td><?= esc($totalAsistentes); ?></td>
            </tr>
            <tr>
                <td>Total de Estudiantes Hombres que Asistieron</td>
                <td><?= esc($totalHombres); ?></td>
            </tr>
            <tr>
                <td>Total de Estudiantes Mujeres que Asistieron</td>
                <td><?= esc($totalMujeres); ?></td>
            </tr>
            <tr>
                <td>Porcentaje de Participación Total</td>
                <td><?= esc(number_format($porcentajeAsistentes, 2)); ?>%</td>
            </tr>
        </table>
    </div>
    

    <br><br><h3 class="titulo">Asistencia</h3>
    <h3 class="subtitulo" style="text-align: center;">Ordenar</h3> <br>
    <div class="botonesCentro">

        <div class="input-wrapper">
        <button class="icon"> 
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="25px" width="25px">
            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"></path>
            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M22 22L20 20"></path>
            </svg>
        </button>
        <input placeholder="nombre.." id="buscarNControl" class="input" name="text" type="text">
        </div>

        <div class="btnOrdenar">
            <button class="btn1" onclick="ordenarTabla(0)">N. Control</button>
            <button class="btn1" onclick="ordenarTabla(1)">Nombre</button>
            <button class="btn1" onclick="ordenarTabla(2)">Carrera</button>
            <button class="btn1" onclick="ordenarTabla(3)">Semestre</button>
            <button class="btn1" onclick="ordenarTabla(4)">Sexo</button>
        </div>
    
        <div class="exportarFiltrar">
        <button class="btn1">Exportar</button>
        <button class="btn1"  id="filtroBtn4">Filtrar Tabla</button>
        </div>
    </div>
    
    <div class="tablaAsistencia">
        <table class="asistencia" id = "tablaAsistencias">
            <tr>
                <th>N. Control</th>
                <th>Nombre</th>
                <th>Carrera</th>
                <th>Semestre</th>
                <th>Sexo</th>
            </tr>
            <?php foreach($estudiantes as $estudiante):?>
            <tr>
                <td><?= esc($estudiante['nroControl']); ?></td>
                <td><?php echo mb_convert_case(mb_strtolower($estudiante['nombre'], 'UTF-8'), MB_CASE_TITLE, 'UTF-8'); ?></td>
                <td><?php 
                    switch ($estudiante['carrera']) {
                        case "IC":
                            echo "Ingeniería Civil";
                            break;
                        case "ISC":
                            echo "Ingeniería en Sistemas Computacionales";
                            break;
                        case "IGE":
                            echo "Ingeniería en Gestión Empresarial";
                            break;
                        case "IEME":
                            echo "Ingeniería Electromecánica";
                            break;
                        case "IIAL":
                            echo "Ingeniería en Industrias Alimentarias";
                            break;

                        case "LAMD":
                            echo "Licenciatura en Administración de Empresas";
                            break;
                        // Otros casos...
                    }
                ?></td>
                <td><?= esc($estudiante['semestre']); ?></td>
                <td><?php if($estudiante['sexo']== 'M'){echo "Masculino";}else {echo "Femenino";}?></td>
            </tr>
            <?php endforeach?>
        </table>
    </div>

    
    <br><br>
    <h3 class="subtitulo">Galería de fotos</h3><br>
    <div class="galeria">
        <div class="imagen-con-descripcion">
            <img src="1 (1).jpg" alt="Imagen 1" onclick="abrirLightbox(this)">
            <div class="descripcion">
                <span>Autor: Emmanuel Eliseo Rojas Hdz</span>
            </div>
        </div>
        <div class="imagen-con-descripcion">
            <img src="2.jpg" alt="Imagen 1" onclick="abrirLightbox(this)">
            <div class="descripcion">
                <span>Autor: Ing. Miguel Morgan Matus</span>
            </div>
        </div>
        <div class="imagen-con-descripcion">
            <img src="3.jpg" alt="Imagen 1" onclick="abrirLightbox(this)">
            <div class="descripcion">
                <span>Autor: Emmanuel Eliseo Rojas Hdz</span>
            </div>
        </div>
        <div class="imagen-con-descripcion">
            <img src="4.jpg" alt="Imagen 1" onclick="abrirLightbox(this)">
            <div class="descripcion">
                <span>Autor: Ing. Miguel Morgan Matus</span>
            </div>
        </div>
        <div class="imagen-con-descripcion">
            <img src="3.jpg" alt="Imagen 1" onclick="abrirLightbox(this)">
            <div class="descripcion">
                <span>Autor: Emmanuel Eliseo Rojas Hdz</span>
            </div>
        </div>
        <div class="imagen-con-descripcion">
            <img src="4.jpg" alt="Imagen 1" onclick="abrirLightbox(this)">
            <div class="descripcion">
                <span>Autor: Ing. Miguel Morgan Matus</span>
            </div>
        </div>
        <!-- Agrega más imágenes según lo necesites -->
    </div>
    
    <div id="lightbox" class="lightbox">
        <span class="cerrar" onclick="cerrarLightbox()">&times;</span>
        <img class="lightbox-img" id="imagenLightbox">
    </div>
                

    
</div>

<!-- Modal para filtrar -->
<div id="filtrarModal4" class="modal4" style="display: none;">
    <div class="modal-content4">
        <span class="close4">&times;</span>
        <h2>Filtrar Estudiantes</h2>
        <form id="filtrarForm4">
            <label for="carrera4">Carrera:</label>
            <select class="campo" id="carrera4" name="carrera">
                <option value="">Todas</option>
                <!-- Opciones de carrera se llenarán dinámicamente -->
            </select>
            <label for="semestre4">Semestre:</label>
            <select class="campo"  id="semestre4" name="semestre">
                <option value="">Todos</option>
                <!-- Opciones de semestre se llenarán dinámicamente -->
            </select>
            <label for="sexo4">Sexo:</label>
            <select class="campo"  id="sexo4" name="sexo">
                <option value="">Todos</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
            <button type="button" id="aplicarFiltro4">Aplicar Filtro</button>
        </form>
    </div>
</div>



<script>
function abrirLightbox(img) {
    var lightbox = document.getElementById("lightbox");
    var imagenLightbox = document.getElementById("imagenLightbox");
    imagenLightbox.src = img.src; // Cambiar la fuente de la imagen del lightbox
    lightbox.style.display = "flex"; // Mostrar el lightbox
}

function cerrarLightbox() {
    var lightbox = document.getElementById("lightbox");
    lightbox.style.display = "none"; // Ocultar el lightbox
}
</script>


<script>
function ordenarTabla(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("tablaAsistencias");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc"; 
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('tablaAsistencias');
    const rows = Array.from(table.querySelectorAll('tr')).slice(1); // Excluir la fila de encabezado

    // Modal de filtro
    const filtroModal4 = document.getElementById('filtrarModal4');
    const filtroCarrera4 = document.getElementById('carrera4');
    const filtroSemestre4 = document.getElementById('semestre4');
    const filtroSexo4 = document.getElementById('sexo4');
    const aplicarFiltro4 = document.getElementById('aplicarFiltro4');
    const closeModal4 = document.querySelector('.close4');

    document.getElementById('filtroBtn4').addEventListener('click', function() {
        filtroModal4.style.display = 'block';
        cargarOpcionesFiltro();
    });

    closeModal4.addEventListener('click', function() {
        filtroModal4.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == filtroModal4) {
            filtroModal4.style.display = 'none';
        }
    });

    aplicarFiltro4.addEventListener('click', function() {
        const carreraFiltro = filtroCarrera4.value.toLowerCase();
        const semestresFiltro = Array.from(filtroSemestre4.selectedOptions).map(option => option.value);
        const sexoFiltro = filtroSexo4.value;

        rows.forEach(row => {
            const carrera = row.cells[2].textContent.toLowerCase();
            const semestre = row.cells[3].textContent;
            const sexo = row.cells[4].textContent;

            if ((carrera.includes(carreraFiltro) || carreraFiltro === '') &&
                (semestresFiltro.includes(semestre) || semestresFiltro.length === 0 || semestresFiltro.includes('')) &&
                (sexo === sexoFiltro || sexoFiltro === '')) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        filtroModal4.style.display = 'none';
    });

    function cargarOpcionesFiltro() {
        const carreras = new Set();
        const semestres = new Set();
        const sexos = new Set();

        rows.forEach(row => {
            carreras.add(row.cells[2].textContent);
            semestres.add(row.cells[3].textContent);
            sexos.add(row.cells[4].textContent);
        });

        filtroCarrera4.innerHTML = '<option value="">Todas</option>';
        filtroSemestre4.innerHTML = '<option value="">Todos</option>';
        filtroSexo4.innerHTML = '<option value="">Todos</option>';

        carreras.forEach(carrera => {
            filtroCarrera4.innerHTML += `<option value="${carrera}">${carrera}</option>`;
        });

        semestres.forEach(semestre => {
            filtroSemestre4.innerHTML += `<option value="${semestre}">${semestre}</option>`;
        });

        sexos.forEach(sexo => {
            filtroSexo4.innerHTML += `<option value="${sexo}">${sexo}</option>`;
        });
    }
});
</script>


<script>
document.getElementById('buscarNControl').addEventListener('keyup', function() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById('buscarNControl');
    filter = input.value.toUpperCase();
    table = document.getElementById('tablaAsistencias');
    tr = table.getElementsByTagName('tr');

    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName('td')[1]; // Columna de nombre
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }
});
</script>

<?= $this->endSection(); ?>

<?php
function formatearFecha($fecha) {
    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es_MX.UTF-8', 'es_MX');
    $timestamp = strtotime($fecha);
    return strftime('%d de %B del %Y', $timestamp);
}
?>