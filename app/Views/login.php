<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Eventos Academicos</title>
    <link href="<?= base_url('css/loginStyle.css');?>" rel="stylesheet" >
</head>
<body>
   
<div class="login-container">
        <div class="login-box">
            <h1>Gestor de Eventos Académicos</h1>
            <!-- LOGO TEC -->
            <img src="<?= base_url("Logo-Tec-Pochutla.jpeg")?>" alt="Instituto Tecnológico de Pochutla" class="logo">
            
            <form id="loginForm" action="<?= base_url("auth")?>" method="post" autocomplete="off">

                <?= csrf_field();?>
                <!-- Username -->
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Nombre de usuario" required>
                </div>
                <!-- Password -->
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>

                <!-- Boton -->
                <button type="submit" class="login-btn">Iniciar sesión</button>
            </form>

            <?php if(session()->getFlashdata('errors')!=null):?>
            <div class="alert alert-danger"><?= session()->getFlashdata('errors')?> </div>
            <?php endif; ?>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>