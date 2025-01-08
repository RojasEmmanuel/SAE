<?= $this->extend('layout/template') ?>
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


    <h1>Eventos Próximos</h1>

    <main class="contenedor-eventos">
    <?php if (!empty($eventos) && is_array($eventos)): 
        foreach ($eventos as $evento): 
            if($evento->tipo == "Académico"){
                $tipo = "tipo-educativo";
            }else if($evento->tipo == "Deportivo"){
                $tipo = "tipo-deportivo";
            }else if($evento->tipo == "Cultural"){
                $tipo = "tipo-cultural";
            }else if($evento->tipo == "Cívico"){
                $tipo = "tipo-civico";
            }

            // Establecer el locale a español
            setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es_MX.UTF-8', 'es_MX');

            // Formatear la fecha
            $fecha = DateTime::createFromFormat('Y-m-d', $evento->fecha);
            $fechaFormateada = strftime('%d de %B del %Y', $fecha->getTimestamp());

            // Formatear la hora
            $hora = DateTime::createFromFormat('H:i:s', $evento->hora);
            $horaFormateada = $hora->format('h:i a');
            ?>
            <div class="tarjeta-evento <?= esc($tipo) ?>">
                <div class="encabezado">
                    <h2><?= esc($evento->nombre) ?></h2>
                </div>
                <div class="contenido">
                    <p><strong>Fecha:</strong> <?= esc($fechaFormateada) ?></p>
                    <p><strong>Hora:</strong> <?= esc($horaFormateada) ?></p>
                    <p><strong>Lugar:</strong> <?= esc($evento->lugar) ?></p>
                    <p><strong>Área:</strong> <?= esc($evento->area) ?></p>
                    <p><strong>Responsable:</strong> <?= esc($evento->responsable) ?></p>
                    <p><strong>Descripción:</strong> <?= esc($evento->descripcion) ?></p>
                </div>
                <div class="acciones">
                    <button class="btn-eliminar" onclick="eliminarEvento(<?= $evento->idEvento ?>)">Eliminar</button>
                    <button class="btn-editar" onclick="openEditModal(<?= htmlspecialchars(json_encode($evento), ENT_QUOTES, 'UTF-8') ?>)">Editar</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay eventos próximos.</p>
    <?php endif; ?>
    </main>
</div>

<!-- Modal para editar evento -->
<div class="modal-overlay10" id="editModal10" style="display: none;">
    <div class="modal10">
        <div class="modal-header10">
            <h2>Editar Evento</h2>
            <button onclick="closeEditModal()">&times;</button>
        </div>
        <div class="modal-body10">
            <form id="editForm10" action="<?= base_url('proximos/editarEvento') ?>" method="post">
                <input type="hidden" id="editId10" name="idEvento">
                <div class="contenedorForm">
                <div class="form0">
                    <div class="form-group">
                        <label for="editNombre10">Nombre del Evento</label>
                        <input type="text" id="editNombre10" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="editFecha10">Fecha</label>
                        <input type="date" id="editFecha10" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="editHora10">Hora</label>
                        <input type="time" id="editHora10" name="hora" required>
                    </div>
                    <div class="form-group">
                        <label for="editLugar10">Lugar</label>
                        <input type="text" id="editLugar10" name="lugar" required>
                    </div>
                </div>
                <div class="form1">
                    <div class="form-group">
                        <label for="editArea10">Área</label>
                        <input type="text" id="editArea10" name="area" required>
                    </div>
                    <div class="form-group">
                        <label for="editTipo10">Tipo</label>
                        <select id="editTipo10" name="tipo" required>
                            <option value="Académico">Académico</option>
                            <option value="Deportivo">Deportivo</option>
                            <option value="Cultural">Cultural</option>
                            <option value="Cívico">Cívico</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editResponsable10">Responsable</label>
                        <input type="text" id="editResponsable10" name="responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescripcion10">Descripción</label>
                        <textarea id="editDescripcion10" name="descripcion" required></textarea>
                    </div>
                    
                </div>
                </div>
                <div class="form-group button-group">
                    <button type="submit">Guardar Cambios</button>
                    <button type="button" class="cancel-button" onclick="closeEditModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function eliminarEvento(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
        window.location.href = '<?= base_url('proximos/eliminarEvento') ?>/' + id;
    }
}

function openEditModal(evento) {
    document.getElementById('editId10').value = evento.idEvento;
    document.getElementById('editNombre10').value = evento.nombre;
    document.getElementById('editFecha10').value = evento.fecha;
    document.getElementById('editHora10').value = evento.hora;
    document.getElementById('editLugar10').value = evento.lugar;
    document.getElementById('editArea10').value = evento.area;
    document.getElementById('editTipo10').value = evento.tipo;
    document.getElementById('editResponsable10').value = evento.responsable;
    document.getElementById('editDescripcion10').value = evento.descripcion;
    document.getElementById('editModal10').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editModal10').style.display = 'none';
}
</script>

<?= $this->endSection(); ?>