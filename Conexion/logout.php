<?php
require_once "ConsumoApi.php";

include "../Conexion/Sesion.php";

Sesion::startSesion();



if(!empty($_GET["estado"])){ 
    $estado = $_GET["estado"];
    if($estado == "activo"){
       
        $username = Sesion::getUsername();
        $apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");
    
        $empleado = $apiClient->post("empleado",["username"=> $username]);
        $empleadoId = $empleado[0]["id_empleado"];
        $username = Sesion::getUsername();
        $estado = "inactivo";
        echo "kjhjkhkjhkjhkjh";
        $resultado = $apiClient->post("actualizarEstado",["id"=> $empleadoId,"estado"=>$estado]);   
    }
    echo "sdfsaf";
}

Sesion::logout();

header("Location: ../index.php");
exit();
?>