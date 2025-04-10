<?php

$display = "none";
$mensaje = "";
// Verificar si se hace una solicitud GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Verificar si la clave "error" existe en el arreglo $_GET
    if (isset($_GET["error"])) {
        switch($_GET["error"]){
            case "ip1":
            $display = "block";
            $mensaje = "Inicie sesión para entrar";
            break;
            case "ip2":
            $display = "block";
            $mensaje = "Contraseña Incorrecta o Usuario no encontrado";
                break;
        }
        
    }
}




?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Login Soporte Cliente</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/estilos_index.css">
</head>
<body>
    <?php
    //Se importa la autentitcacion para API de google
        require("autenticacion.php");
    ?>
    <div id="error-message" class="bg-danger text-white p-3" style="border-radius:33px; display: <?= $display?>;"><?= $mensaje?></div>

    <div class="container" id="container">
        <div class="form-container sign-up">
        <form id="createForm" action="Controlador/LoginControlador.php" method="POST">
            <h1>Crear Cuenta</h1>
            <div class="social-icons">
            <?php $client->setState("c");?>
                <a href="<?php echo $client->createAuthUrl();?>" class="icon">
                    <i class="fa-brands fa-google"></i>
                </a>
                <!-- <a href="#" class="icon">
                <i class="fa-brands fa-facebook"></i>
                </a> -->
            </div>
            <span>o crea el registro</span>
            <input type="text" placeholder="Nombre" name="nombre" required>
            <input type="text" placeholder="Apellido" name="apellido"  required>
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="tel" name="telefono" placeholder="Telefono" required>
            <input type="password" id="contrasena" name="password"  placeholder=" Password"required>
            <input type="password" id="contrasenaV" placeholder=" Confirmar Password" required>
            <input type="hidden" name="rol" value="c">
            <div id="error-message" style="color: red; display: none;">Las contraseñas no coinciden, vuelva intentarlo</div>

            <button type="submit">Crear Cuenta</button>

        </form>
        </div>
        <div class="form-container sign-in">
            <form action="Controlador/SignControlador.php" method="post">
                <h1>Iniciar Sesion</h1>
                <div class="social-icons">
                    <?php $client->setState("c");?>
                <a href="<?php echo $client->createAuthUrl();?>" class="icon">
                    <i class="fa-brands fa-google"></i>
                </a>
                <!-- <a href="#" class="icon">
                <i class="fa-brands fa-facebook"></i>
                </a> -->
                </div>
                <span>o iniciar por usuario y contraseña</span>
                <input type="text" name="user" placeholder="Correo o Usuario">
                <input type="password" name="password"  placeholder="Contraseña">
                <!-- <a id="olvido" href="#">Olvide mi contraseña</a> -->
                <button type="submit">Iniciar</button>
            </form>

        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenido a CodeTrail!</h1>
                    <p>El que sirve mejor es el que más se beneficia</p>
                    <button class="hidden" id="login">Iniciar Sesion</button>
                </div>
                <div class="toggle-panel toggle-right">
                <h1>Hola otra vez a CodeTrail!</h1>
                    <p>Lo mejor es lo simple!
                        --Jerry´s
                    </p>
                    <button class="hidden" id="register">Crear Cuenta</button>
                </div>
            </div>
        </div>

    </div>
    <script src="JavaScript/main_index.js"></script>
</body>
</html>
