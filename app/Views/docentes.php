<?= $this->extend('layout/template')?>

<?= $this->section('content'); ?>

<div class="contenidoPagina">

    <?php if (session()->has('message')): ?>
        <div class="alert alert-success">
            <span class="icon">✔️</span>
            <?= session('message') ?>
            <button class="close-btn" onclick="this.parentElement.style.display='none';">✖️</button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <span class="icon">❌</span>
            <?= session('error') ?>
            <button class="close-btn" onclick="this.parentElement.style.display='none';">✖️</button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('errors')): ?>
        <div class="alert alert-danger">
            <span class="icon">❌</span>
            <?php foreach (session('errors') as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
            <button class="close-btn" onclick="this.parentElement.style.display='none';">✖️</button>
        </div>
    <?php endif; ?>


    <h3 class="titulo">Docentes Registrados</h3>
    <h3 class="subtitulo" style="text-align: center;">Ordenar</h3> <br>
    <div class="botonesCentro">
 
        <div class="input-wrapper">
        <button class="icon"> 
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="25px" width="25px">
            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"></path>
            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M22 22L20 20"></path>
            </svg>
        </button>
        <input placeholder="nombre.." id="buscarNombre" class="input" name="text" type="text">
        </div>

        <div class="btnOrdenar">
            <button class="btn1"  id="ordenarId">ID</button>
            <button class="btn1" id="ordenarNombre">Nombre</button>
            <button class="btn1" id="ordenarAcademia">Academia</button>
            <button class="btn1" id="ordenaRfc">RFC</button>
            <button class="btn1" id="ordenarCurp">CURP</button>
        </div>

        <div class="exportarFiltrar">
            <button id="exportButton" class="btn1">Exportar</button>
            <button class="btn1" id="filtroBtn4">Filtrar</button>
        </div>
    </div>
    <div class="tablaEstudiantesDocentes">
        <table class="estudiantes">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Academia</th>
                    <th>Teléfono</th>
                    <th>RFC</th>
                    <th>CURP</th>
                </tr>
            </thead>
            <tbody id="tablaDocentes">
                <?php foreach ($docentes as $docente): ?>
                <tr>
                    <td><?php echo $docente->idDocentes?></td>
                    <td><?php echo mb_convert_case(mb_strtolower($docente->nombre, 'UTF-8'), MB_CASE_TITLE, 'UTF-8'); ?></td>
                    <td><?php echo $docente->academia?></td> 
                    <td><?php echo $docente->telefono?></td>
                    <td><?php echo $docente->rfc?></td>
                    <td><?php echo $docente->curp?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para filtrar la tabla -->
<div id="filtrarModal4" class="modal4" style="display: none;">
    <div class="modal-content4">
        <span class="close4">&times;</span>
        <h2>Filtrar Docentes</h2>
        <form id="filtrarForm4">
            <label for="carrera4">Academia:</label>
            <select class="campo" id="carrera4" name="carrera">
                <option value="">Todas</option>
                <option value="Ingeniería Civil">Ingeniería Civil</option>
                <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                <option value="Ingeniería en Gestión Empresarial">Ingeniería en Gestión Empresarial</option>
                <option value="Ingeniería Electromecánica">Ingeniería Electromecánica</option>
                <option value="Ingeniería en Industrias Alimentarias">Ingeniería en Industrias Alimentarias</option>
                <option value="Licenciatura en Administración de Empresas">Licenciatura en Administración de Empresas</option>
                <!-- Agrega más opciones según sea necesario -->
            </select>
            
            <button type="button" id="aplicarFiltro4">Aplicar Filtro</button>
        </form>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal25" id="exportModal25" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel25" aria-hidden="true">
  <div class="modal-dialog25" role="document">
    <div class="modal-content25">
      <div class="modal-header25">
        <h5 class="modal-title25" id="exportModalLabel25">Exportar Tabla</h5>
          <span aria-hidden="true" class="close25">&times;</span>
      </div>
      <div class="modal-body25">
        <p>Seleccione el formato de exportación:</p>
        <button onclick="exportTableToExcel('estudiantes')" class=" btn-success25">Excel</button>
        <button onclick="exportTableToWord('estudiantes')" class=" btn-primary25">Word</button>
        <button onclick="exportTableToPdf('estudiantes')" class=" btn-danger25">PDF</button>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('.tablaEstudiantesDocentes table');
    const rows = Array.from(table.querySelectorAll('tr')).slice(1); // Excluir la fila de encabezado

    function sortTable(columnIndex, isNumeric = false) {
        const sortedRows = rows.sort((a, b) => {
            const aText = a.cells[columnIndex].textContent.trim();
            const bText = b.cells[columnIndex].textContent.trim();

            if (isNumeric) {
                return parseFloat(aText) - parseFloat(bText);
            } else {
                return aText.localeCompare(bText, 'es', { sensitivity: 'base' });
            }
        });

        // Reinsertar las filas ordenadas en la tabla
        sortedRows.forEach(row => table.appendChild(row));
    }

    document.getElementById('ordenarId').addEventListener('click', () => sortTable(0));
    document.getElementById('ordenarNombre').addEventListener('click', () => sortTable(1));
    document.getElementById('ordenarAcademia').addEventListener('click', () => sortTable(2));
    document.getElementById('ordenaRfc').addEventListener('click', () => sortTable(4));
    document.getElementById('ordenarCurp').addEventListener('click', () => sortTable(5));

    // Modal de filtro
    const filtroModal4 = document.getElementById('filtrarModal4');
    const filtroCarrera4 = document.getElementById('carrera4');
    const aplicarFiltro4 = document.getElementById('aplicarFiltro4');
    const closeModal4 = document.querySelector('.close4');

    document.getElementById('filtroBtn4').addEventListener('click', function() {
        filtroModal4.style.display = 'block';
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

        rows.forEach(row => {
            const carrera = row.cells[2].textContent.toLowerCase();


            if ((carrera.includes(carreraFiltro) || carreraFiltro === '') ){
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        filtroModal4.style.display = 'none';
    });


    // Buscar por N. Control
    document.getElementById('buscarNombre').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        rows.forEach(row => {
            const nControl = row.cells[1].textContent.toLowerCase();
            if (nControl.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

    });
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("exportModal25");
    var btn = document.getElementById("exportButton");
    var span = document.getElementsByClassName("close25")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

function exportTableToExcel(tableClass) {
    let table = document.querySelector(`.${tableClass}`);
    let wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});
    XLSX.writeFile(wb, 'tabla_docentes.xlsx');
}

function exportTableToWord(tableClass) {
    let table = document.querySelector(`.${tableClass}`).outerHTML;
    let html = `
        <html>
        <head>
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
            </style>
        </head>
        <body>
            ${table}
        </body>
        </html>`;
    let blob = htmlDocx.asBlob(html);
    saveAs(blob, 'tabla_estudiantes.docx');
}

function exportTableToPdf(tableClass) {
    let { jsPDF } = window.jspdf;
    let doc = new jsPDF();
    doc.autoTable({
        html: `.${tableClass}`,
        styles: {
            cellPadding: 3,
            fontSize: 10,
            halign: 'left',
            valign: 'middle',
            overflow: 'linebreak',
            tableWidth: 'wrap',
            lineColor: [44, 62, 80],
            lineWidth: 0.1,
        },
        headStyles: {
            fillColor: [242, 242, 242],
            textColor: [0, 0, 0],
            fontStyle: 'bold',
        },
    });
    doc.save('tabla_estudiantes.pdf');
}
</script>

<?= $this->endSection(); ?>