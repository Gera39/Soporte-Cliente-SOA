<?php
    require_once "ConsumoApi.php";
    require_once "Sesion.php";
    $username = Sesion::getUsername();
    $apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

    $empleado = $apiClient->post("empleado",["username"=> $username]);
    $empleadoId = $empleado[0]["id_empleado"];
    $username = Sesion::getUsername();
    $estado = $_GET["estado"];

    $resultado = $apiClient->post("actualizarEstado",["id"=> $empleadoId,"estado"=>$estado]);
    

    header("Location: ../dashboard/dashboardEmpleado.php?estado=activo");
?>