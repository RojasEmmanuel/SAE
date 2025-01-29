<?= $this->extend('layout/template')?>
<?= $this->section('content'); ?>

<div class="contenidoPagina">
    <h1>Configuración del formato</h1>

    
    <div class="DatosEvt">
        <h3>Datos generales</h3>
        <form method="post" action="guardar_datos.php">
            <div class="form-group">
                <label><input type="checkbox" name="datos[]" value="nombre_evento"> Nombre del evento</label>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="datos[]" value="fecha"> Fecha</label>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="datos[]" value="hora"> Hora</label>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="datos[]" value="lugar"> Lugar</label>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="datos[]" value="area"> Área</label>
            </div>
            <div class="form-group">
                
                <div class="toggler">
                <input id="toggler-1" name="toggler-1" type="checkbox" value="1">
                <h4 class="label">Responsable</h4>
                <label for="toggler-1">
                    <svg class="toggler-on" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <polyline class="path check" points="100.2,40.2 51.5,88.8 29.8,67.5"></polyline>
                    </svg>
                    <svg class="toggler-off" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <line class="path line" x1="34.4" y1="34.4" x2="95.8" y2="95.8"></line>
                        <line class="path line" x1="95.8" y1="34.4" x2="34.4" y2="95.8"></line>
                    </svg> 
                </label>
                </div>
            </div>
            <button type="submit">Guardar</button>
        </form>
    </div>

    <div class="DatosEvt">
        <h3>Datos generados</h2>
        <div class="form-group">
        </div>
    </div>

    <div class="DatosEvt">
        <h3>Membretes</h2>
    </div>

</div>


<?= $this->endSection(); ?>