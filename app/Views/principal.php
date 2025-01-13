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

    <div class="seccion-superior">
        <h1 class="saludo">Bienvenido de nuevo Emmanuel! 🚀</h1>
        <p class="descripcion">Aquí podrás consultar y administrar información sobre los eventos realizados en el Instituto Tecnológico de Pochutla.</p>
    
        <div class="detalles">

            <ul class="lista-herramientas">
                <li>✅ Registra un evento académico, civico, cultural o deportivo.</li>
                <li>✅ Comparte el enlace de registro a los docentes.</li>
                <li>✅ Consulta, analiza y exporta los datos registrados.</li>
            </ul>

            <div class="btnLink">
                <button class="shadow__btn" onclick="openModal()">Registrar Evento</button>
            </div>

            <br><br>
            <div class="containerNotificaciones">
                <h3 class="subtitulo">Eventos proximos</h2><br>
                <div class="event-grid">
                    <?php foreach($notificaciones as $notificacion): ?>
                        <div class="card">
                            <button class="show-event-button" onclick="openModal2(<?= htmlspecialchars(json_encode($notificacion), ENT_QUOTES, 'UTF-8') ?>)">🔔
                                <?php 
                                    $nombre = $notificacion->nombre;
                                    if (strlen($nombre) > 60) {
                                        $nombre = substr($nombre, 0, 60) . '...';
                                    }
                                    echo $nombre;
                                ?></button>
                            <div class="card__conte">
                                <?php 
                                    $descripcion = $notificacion->descripcion;
                                    if (strlen($descripcion) > 60) {
                                        $descripcion = substr($descripcion, 0, 60) . '...';
                                    }
                                    echo $descripcion;
                                ?>
                            </div>
                            <div class="card__date">
                            <?php 
                                $fecha = DateTime::createFromFormat('Y-m-d', $notificacion->fecha);
                                echo $fecha->format('d M. Y');
                            ?>
                            </div>
                            
                            <div class="card__arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                                    <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
                                </svg>
                            </div>
                        </div>
                    <?php endforeach; ?> 
                </div>
            </div>
            <div class="modal-overlay2" id="modalOverlay2">
                <div class="modal2">
                    <div class="modal-header2">
                        <h1 style="color: white;"><span id="modal2Title"></span></h1>
                    </div>
                    <div class="modal-body2">
                        <p><strong>Fecha:</strong> <span id="modal2Fecha"></span></p>
                        <p><strong>Hora:</strong> <span id="modal2Hora"></span></p>
                        <p><strong>Lugar:</strong> <span id="modal2Lugar"></span></p>
                        <p><strong>Área:</strong> <span id="modal2Area"></span></p>
                        <p><strong>Tipo:</strong> <span id="modal2Tipo"></span></p>
                        <p><strong>Responsable:</strong> <span id="modal2Responsable"></span></p>
                        <p><strong>Descripción:</strong> <span id="modal2Descripcion"></span></p>
                    </div>
                    <div class="modal-footer2">
                        <button onclick="closeModal2()">Cerrar</button>
            </div>
        </div>
    </div>

</div>
        
</div>

    <br><br>
    <div class="calendario">
        <h3 class="subtitulo">Calendario de Eventos</h3>
        <div class="calendar-header">
            <button id="prevMonth">◀</button>
            <span id="monthYear"></span>
            <button id="nextMonth">▶</button>
        </div>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mié</th>
                    <th>Jue</th>
                    <th>Vie</th>
                    <th>Sáb</th>
                    <th>Dom</th>
                </tr>
            </thead>
            <tbody id="calendarBody">
                <!-- Días del mes -->
            </tbody>
        </table>
    </div>
    
</div>    
<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <button class="close-button" onclick="closeModal()">&times;</button>
        <h1>Registro de Eventos</h1>
        <form action="<?= base_url('principal/insertarEvento') ?>" method="POST">
            <div class="contenedorForm">
                <div class="form0">
                    <div class="form-group">
                        <label for="nombre">Nombre del evento</label>
                        <input type="text" id="nombre" name="nombre" value="<?= old('nombre') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" id="fecha" name="fecha" value="<?= old('fecha') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" id="hora" name="hora" value="<?= old('hora') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lugar">Lugar</label>
                        <input type="text" id="lugar" name="lugar" value="<?= old('lugar') ?>" required>
                    </div>
                </div>

                <div class="form1">
                    <div class="form-group">
                        <label for="area">Área</label>
                        <input type="text" id="area" name="area" placeholder="Ingresa el área" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select id="tipo" name="tipo" required>
                            <option value="">Selecciona el tipo</option>
                            <option value="Académico">Académico</option>
                            <option value="Deportivo">Deportivo</option>
                            <option value="Cultural">Cultural</option>
                            <option value="Cívico">Cívico</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="responsable">Responsable</label>
                        <input type="text" id="responsable" name="responsable" placeholder="Ingresa el nombre del responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese una descripción general del evento">
                    </div>
                </div>
            </div>
            <div class="form-group button-group">
                <button type="button" class="cancel-button" onclick="closeModal()">Cancelar</button>
                <button class="shadow__btn">Registrar Evento</button>
            </div>
        </form>
    </div>
</div>
<script>
    closeModal();
    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    let selectedDate = today.getDate();

    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    const daysInWeek = ["Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"];

    document.getElementById("prevMonth").addEventListener("click", function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    document.getElementById("nextMonth").addEventListener("click", function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    function renderCalendar(month, year) {
        const firstDay = (new Date(year, month)).getDay();
        const daysInMonth = 32 - new Date(year, month, 32).getDate();

        const calendarBody = document.getElementById("calendarBody");
        calendarBody.innerHTML = "";

        document.getElementById("monthYear").textContent = `${monthNames[month]} ${year}`;

        let date = 1;
        let startDay = (firstDay + 6) % 7; // Ajuste para que el lunes sea el primer día
        for (let i = 0; i < 6; i++) {
            let row = document.createElement("tr");

            for (let j = 0; j < 7; j++) {
                let cell = document.createElement("td");
                if (i === 0 && j < startDay) {
                    cell.textContent = "";
                } else if (date > daysInMonth) {
                    break;
                } else {
                    cell.setAttribute("data-day", date);
                    // Marca el día actual
                    if (date === selectedDate && month === today.getMonth() && year === today.getFullYear()) {
                        cell.classList.add("today");
                    }
                    date++;
                }
                row.appendChild(cell);
            }

            calendarBody.appendChild(row);
        }
    }

    // Inicializa el calendario
    renderCalendar(currentMonth, currentYear);


    function openModal() {
        const overlay = document.getElementById('modalOverlay');
        overlay.style.display = 'flex';
    }

    function closeModal() {
        const overlay = document.getElementById('modalOverlay');
        overlay.style.display = 'none';
    }

    function openModal2(evento) {
        const overlay = document.getElementById('modalOverlay2');
        document.getElementById('modal2Title').textContent = evento.nombre;
        document.getElementById('modal2Fecha').textContent = evento.fecha;
        document.getElementById('modal2Hora').textContent = evento.hora;
        document.getElementById('modal2Lugar').textContent = evento.lugar;
        document.getElementById('modal2Area').textContent = evento.area;
        document.getElementById('modal2Tipo').textContent = evento.tipo;
        document.getElementById('modal2Responsable').textContent = evento.responsable;
        document.getElementById('modal2Descripcion').textContent = evento.descripcion;
        overlay.style.display = 'flex';
    }

    function closeModal2() {
        const overlay = document.getElementById('modalOverlay2');
        overlay.style.display = 'none';
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const eventos = <?= json_encode($eventos) ?>;
    const calendarBody = document.getElementById('calendarBody');
    const monthYear = document.getElementById('monthYear');
    const prevMonth = document.getElementById('prevMonth');
    const nextMonth = document.getElementById('nextMonth');

    let currentDate = new Date();

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
        const lastDayOfLastMonth = new Date(year, month, 0).getDate();

        monthYear.textContent = currentDate.toLocaleDateString('es-ES', { month: 'long', year: 'numeric' });

        calendarBody.innerHTML = '';

        let date = 1;
        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');

            for (let j = 0; j < 7; j++) {
                const cell = document.createElement('td');
                const cellText = document.createElement('span');

                if (i === 0 && j < firstDayOfMonth) {
                    cellText.textContent = lastDayOfLastMonth - firstDayOfMonth + j + 1;
                    cell.classList.add('prev-month');
                } else if (date > lastDateOfMonth) {
                    cellText.textContent = date - lastDateOfMonth;
                    cell.classList.add('next-month');
                    date++;
                } else {
                    cellText.textContent = date;
                    cell.classList.add('current-month');

                    const eventDate = new Date(year, month, date).toISOString().split('T')[0];
                    eventos.forEach(evento => {
                        if (evento.fecha === eventDate) {
                            const eventSpan = document.createElement('span');
                            eventSpan.textContent = evento.nombre;
                            eventSpan.classList.add('event');
                            cell.appendChild(eventSpan);
                        }
                    });

                    date++;
                }

                cell.appendChild(cellText);
                row.appendChild(cell);
            }

            calendarBody.appendChild(row);
        }
    }

    prevMonth.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonth.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
});
</script>

<?= $this->endSection(); ?>
