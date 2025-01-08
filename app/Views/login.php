<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Eventos Academicos</title>
    <link href="<?= base_url('css/loginStyle.css');?>" rel="stylesheet" >
</head>
<body>
   
    <!-- LOGIN-->
    <div class="login-container">
        <div class="login-box">
            <h1>Gestor de Eventos Académicos</h1>
            <!-- LOGO TEC -->
            <img src="<?= base_url("Logo-Tec-Pochutla.jpeg")?>" alt="Instituto Tecnológico de Pochutla" class="logo">
            
            <!-- Form -->
            <form id="loginForm" action="<?= base_url("login")?>" method="post">

                <?= csrf_field();?>
                <!-- Email -->
                <div class="input-group">
            
                    <input type="email" id="email" placeholder="Correo" required>
                </div>

                <!-- Password-->
                <div class="input-group">
                     <!--<label for="password">
                        <i class="fa fa-lock"></i>
                    </label>-->
                    <input type="password" id="password" placeholder="Contraseña" required>
                </div>

                <!-- Opcion-check -->
                <div class="remember">
                    <input type="checkbox" id="remember">
                    <label for="remember">Recordar contraseña</label>
                </div>

                <!-- Boton -->
                <button type="submit" class="login-btn">Iniciar sesión</button>
            </form>
        </div>
    </div>

    <script>
        // Capturar el evento del formulario
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el comportamiento por defecto del formulario

            // Aquí podrías agregar la lógica para autenticar al usuario,
            // como enviar los datos a un servidor con AJAX o Fetch

            // Simulamos una autenticación exitosa y redirigimos a la página 
            window.location.href = 'principal.html';
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>