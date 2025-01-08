<?= $this->extend('layout/template')?>
<?= $this->section('content'); ?>

<div class="contenidoPagina">
<h1>Importar Datos</h1>

<p class="parrafoDescriptivo">
    En este apartado podrás importar un archivo CSV para el registro de los estudiantes y de los docentes. 
    para esto deberás seleccionar el archivo CSV y dar clic en el botón "Importar".
    antes de importar el archivo, asegúrate de que los datos estén en el formato correcto.
    A continuación, se muestra un ejemplo de cómo debe verse el archivo CSV para ambos casos.
</p>
<div class="content2">
<div class="apartado">
    <h2 class="apartadoEncabezado">Importar Estudiantes</h2>
    El archivo CSV para estudiantes debe contener los siguientes campos: <br><br>
    <b>numeración, número de control, nombre, semestre, sexo, carrera</b> <br> <br>
    
    <form class="form-importar" action="<?= base_url('importar/estudiantes') ?>" method="post" enctype="multipart/form-data">
        <label class="label-archivo"  for="archivo">Subir archivo CSV para Estudiantes:</label>
        <input class="input-archivo" type="file" name="archivo" id="archivo" required>
        <button class="btn-importar" type="submit">Importar</button>
    </form>
</div>

<div class="apartado">
    <h2 class="apartadoEncabezado">Importar Docentes</h2>
    El archivo CSV para docentes debe contener los siguientes campos: <br><br>
    <b>numeración, nombre, academia, telefono, rfc, curp</b> <br> <br>
   
    <form class="form-importar" action="<?= base_url('importar/docentes') ?>" method="post" enctype="multipart/form-data">
        <label class="label-archivo"  for="archivo">Subir archivo CSV para Docentes:</label>
        <input class="input-archivo" type="file" name="archivo" id="archivo" required>
        <button class="btn-importar" type="submit">Importar</button>
    </form>
</div>
</div>
</div>
<?= $this->endSection(); ?>