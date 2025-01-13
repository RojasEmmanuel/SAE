<?= $this->extend('layout/template')?>

<?= $this->section('content'); ?>

<div class="contenedorHistorial">

    <div class="title-section">
        <h1>Historial de Eventos</h1>
    </div>
    
    <div class="event-gridUno">
        <?php
            $tipoImagenes = [
                "Cívico" => "civico.png",
                "Cultural" => "Cultural.png",
                "Deportivo" => "Deportivo.png",
                "Académico" => "Academico.png"
            ];

            foreach($historial as $history):
                $imagen = isset($tipoImagenes[$history->tipo]) ? $tipoImagenes[$history->tipo] : 'default.png';
        ?>
            <div class="cardUno">
                <img src="<?= base_url('/' . $imagen) ?>" width="150" height="80" alt="Imagen de fondo">
                <div class="fechaUno"> <?= esc($history->fecha); ?> </div>
                
                <a href="<?= base_url('/detalles/' . $history->idEvento) ?>" class="titleUno"><?= esc($history->nombre); ?></a>

                <form action="<?= base_url('/historial/eliminar/' . $history->idEvento) ?>" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                <button class="btnEliminar1" type="submit">Eliminar
                </button>


                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>