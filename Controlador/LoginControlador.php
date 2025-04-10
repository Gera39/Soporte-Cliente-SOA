<?php

include "../Conexion/Sesion.php";
require_once("../Conexion/ConsumoApi.php");
// Instanciar la clase con la URL base de la API
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

Sesion::startSesion();
$username = Sesion::getUsername();


if($_SERVER["REQUEST_METHOD"] === "POST"){

  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $correo = $_POST["correo"];
  $telefono = $_POST["telefono"];
  
  $rol = $_POST['rol'];
  $inserTipo="";
  $password = $_POST["password"];
  
  
  

  
 
 
  $nuevoUsuario = [
    "nombre"=> $nombre,
    "apellido"=> $apellido,
    "correo"=> $correo,
    "telefono"=> $telefono,
    "direccion"=> "Calle modificar",
    "CP"=>"modificar",
    "Estado"=> "Estado Modificar",
    "password"=>$password,
   
    ];

    if(!empty($_GET["accion"])){
        
      $direccion = $_POST["direccion"];
      $cp = $_POST["cp"];
      $estado = $_POST["estado"];

      $nuevoUsuario["CP"] = $cp;
      $nuevoUsuario["direccion"] = $direccion;
      $nuevoUsuario["Estado"] = $estado;
      $nuevoUsuario["username"]=$username;

      
      if($rol === "c"){
        $inserTipo = "update-administrador";
        print_r($nuevoUsuario);
        $respuesta = $apiClient->put($inserTipo, $nuevoUsuario);
      header("Location: ../dashboard/dashboardCliente.php?accion=actualizado");

      }else if ($rol === "e"){

      $inserTipo = "update-administrador";
      print_r($nuevoUsuario);
      $respuesta = $apiClient->put($inserTipo,$nuevoUsuario);
      
      header("Location: ../dashboard/dashboardAdmin.php?accion=actualizadoE");


      }else if ($rol === "a"){
        $inserTipo = "update-administrador";
        $respuesta = $apiClient->put($inserTipo,$nuevoUsuario);
      header("Location: ../dashboard/dashboardAdmin.php?accion=actualizado");

      }


    }else{
     
    if($rol === "c"){
      $inserTipo = "insert-cliente";
      $respuesta = $apiClient->post($inserTipo, $nuevoUsuario);
      Sesion::login($respuesta["username"]);
      header("Location: ../dashboard/dashboardCliente.php");
    }else if ($rol === "e"){
      $inserTipo = "insert-empleado";
      $nuevoUsuario["especialidad"] = $_POST["servicio"];
      $respuesta = $apiClient->post($inserTipo,$nuevoUsuario);
      header("Location: ../dashboard/dashboardAdmin.php");
    }else if ($rol === "a"){
      print_r($nuevoUsuario);
      $inserTipo = "insert-administrador";
      $respuesta = $apiClient->post($inserTipo,$nuevoUsuario);
      header("Location: ../dashboard/dashboardAdmin.php");


    }

    }



  



    



 
}
?>