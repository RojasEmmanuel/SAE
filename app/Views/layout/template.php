<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? "SAE - ".$title : 'SAE' ?></title>
    <link href="<?= base_url('css/proximos.css?v=' . time()); ?>" rel="stylesheet"> 
    <link href="<?= base_url('css/plantilla.css?v=' . time()); ?>" rel="stylesheet">
    <link href="<?= base_url('css/historial.css?v=' . time()); ?>" rel="stylesheet">
    <link href="<?= base_url('css/evento.css?v=' . time()); ?>" rel="stylesheet">
    <link href="<?= base_url('css/importar.css?v=' . time()); ?>" rel="stylesheet">
    <link href="<?= base_url('css/estudiantesDocentes.css?v=' . time()); ?>" rel="stylesheet">
    <link href="<?= base_url('css/paginaPrincipal.css?v=' . time()); ?>" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
<!-- Barra de Navegación -->
<nav class="navbar">
    <div class="nav-left">
        <!-- Ícono del menú -->
        <button class="menu-icon" id="toggleMenu">
            <i class="fa fa-bars"></i>
        </button>
        
        <!-- Logo -->
        <img src="<?= base_url('/LogoTecnm.png') ?>" alt="Logo TecNM" class="nav-logo">
        <img src="<?= base_url('/LogoITP.png') ?>" alt="Logo Instituto Tecnológico de Pochutla" class="nav-logo2">
    </div>

    <!-- Texto y links de la barra -->
    <div class="nav-middle">
        <a href="<?= base_url('/principal') ?>" class="nav-link">Principal</a>
    </div>

    <div class="TEXTO-SAL">
        <!-- Botón salir -->
        <a href="<?= base_url('logout') ?>" class="nav-link salir">Salir</a>
        <!-- Ícono de perfil -->
    </div>

    <div class="nav-right">
        <img src="<?= base_url('/user.png') ?>" alt="Imagen Esquina" class="img-corner">
    </div>
</nav>

<!-- Menú Desplegable -->
<div class="dropdown-menu" id="dropdownMenu">
    <ul>
        <li><a href="<?= base_url('/historial') ?>">Historial de Eventos</a></li>
        <li><a href="<?= base_url('/proximos') ?>">Eventos Proximos</a></li>
        <li><a href="<?= base_url('/estudiantes') ?>">Estudiantes</a></li>
        <li><a href="<?= base_url('/docentes') ?>">Docentes</a></li>
        <li><a href="<?= base_url('/formatos') ?>">Formatos</a></li>
        <li><a href="<?= base_url('/importar') ?>">Importar Datos</a></li>
    </ul>
</div>
<script>
    // JavaScript para mostrar/ocultar el menú desplegable
    document.getElementById('toggleMenu').addEventListener('click', function() {
        var menu = document.getElementById('dropdownMenu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none'; // Ocultar menú
        } else {
            menu.style.display = 'block'; // Mostrar menú
        }
    });
</script>

<div class="contenido">
    <?= $this->renderSection('content') ?>
</div>

<footer style="background-color: #000; color: #ecf0f1; padding: 40px 0; font-size: 15px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <div style="max-width: 1000px; margin: 0 auto; display: flex; justify-content: space-between; align-items: flex-start; padding: 0 20px; flex-wrap: wrap;">
        
        <!-- Sección de versión y actualización -->
        <div style="flex: 1; min-width: 250px; margin-bottom: 20px;">
            <div style="display: flex;">
                <p style="font-size: 16px; font-weight: bold; margin-right:10px; margin-bottom: 10px;">Versión actual del sistema: </p>
                <p style="color: #3498db; margin: 0;"> v1.0.1</p>
            </div>
            <p style="color: #95a5a6;">Última actualización: 24 de octubre de 2024</p>
        </div>
        
        <!-- Sección de contacto de soporte -->
        <div style="flex: 1; min-width: 250px; margin-bottom: 20px;">
            <p style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Soporte técnico:</p>
            <p style="margin-bottom: 10px;">WhatsApp: <a href="https://wa.me/529581737977" target="_blank" style="color: #1abc9c; text-decoration: none;">+52 9581737977</a></p>
            <p style="margin-bottom: 10px;">Correo electrónico: <a href="mailto:rojasemmanuel.1202@gmail.com" style="color: #1abc9c; text-decoration: none;">rojasemmanuel.1202@gmail.com</a></p>
            <p style="margin-bottom: 10px;">Horario de atención: Lunes a viernes, de 8:00 am a 5:00 pm</p>
        </div>
        
    </div>

    <!-- Separador -->
    <div style="border-top: 1px solid #7f8c8d; margin-top: 20px; padding-top: 20px;">
        <p style="text-align: center; margin: 0;">
            <a href="/politica-privacidad" target="_blank" style="color: #ecf0f1; text-decoration: none; margin-right: 15px;">Política de privacidad</a> | 
            <a href="/terminos-condiciones" target="_blank" style="color: #ecf0f1; text-decoration: none; margin-left: 15px;">Términos y condiciones</a>
        </p>
    </div>
</footer>
</body>
</html>