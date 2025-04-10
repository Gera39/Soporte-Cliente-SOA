<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>
</head>
<style>

  .perfil {
    width: 40%;
    margin: auto;
    text-align: center;
  }
  .perfil img{
    width: 200px;
  }
  body{
    background-color:#9b9c9a;
  }
  h2,h3{
    text-align: center;
    font-family: 'Times New Roman', Times, serif;
    color: #fff;
  }
  
</style>
<body>
   <?php
     session_start();
  require_once "autenticacion.php";
?>
 
  <div class="perfil">
    <img src="<?php echo $foto;?>" alt="">
    <h2>Bienvenido <?php echo $name ?></h2>
    <h3><?php echo $email?></h3>
    <p><?= $google_id?></p>
    <!-- Enlace para cerrar sesión -->
    <a href="apiGoogle/logout.php" class="logout-btn">Cerrar Sesión</a>
  </div>
</body>
</html>