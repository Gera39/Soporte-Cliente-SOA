<?php
include "../Conexion/Sesion.php";
require_once("../Conexion/ConsumoApi.php");
require_once "../autenticacion.php";//Esto es de Google
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

Sesion::startSesion();

// Lógica para manejar autenticación
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $user = $_POST["user"];
  $password = $_POST["password"];

  $ingresarUsuario = [
      "username" => $user,
      "password" => $password
  ];
  $respuesta = $apiClient->post("acceso", $ingresarUsuario);

  if ($respuesta["error"] == 0) {
      Sesion::login($respuesta["username"]);//se crea la sesion
      header("Location: ../dashboard/dashboardCliente.php");
      exit();
  } else if ($respuesta["error"] == 5) {
      Sesion::login($respuesta["username"]);
      header("Location: ../dashboard/dashboardEmpleado.php");
      exit();
  } else if ($respuesta["error"] == 6) {
      Sesion::login($respuesta["username"]);
      header("Location: ../dashboard/dashboardAdmin.php");
      exit();
  } else {
      header("Location: ../index.php?error=ip2");
      exit();
  }
} else {
  if (isset($google_id) && isset($name) && isset($email)) {
      $rol = $_GET["state"];
      $userGoogle = [
          "google_id" => $google_id,
          "nombre" => $name,
          "correo" => $email,
          "rol" => $rol
      ];
      $respuesta = $apiClient->post("accesoGoogle", $userGoogle);

      if ($respuesta["error"] == 0) {
         Sesion::login($respuesta["username"]);
         header("Location: ../dashboard/dashboardCliente.php");
          exit();
      } else if ($respuesta["error"] == 5) {
        Sesion::login($respuesta["username"]);
        header("Location: ../dashboard/dashboardEmpleado.php");
        exit(); 
        } else if ($respuesta["error"] == 6) {
          Sesion::login($respuesta["username"]);
          header("Location: ../dashboard/dashboardAdmin.php");
          exit();   
          } else {
          header("Location: ../index.php?error=ipaquiiiii");
          exit();
      }
  } else {
      header("Location: ../index.php?error=estanvacios");
      exit();
  }
}

?>