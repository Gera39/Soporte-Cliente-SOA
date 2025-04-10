<?php
    require_once ("../Conexion/ConsumoApi.php");
    require_once "../Conexion/Sesion.php";
	$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

    $username = Sesion::getUsername();

    if(isset($_POST["id_cliente"])&& isset($_POST["id_servicio"])){
        $idCliente = $_POST["id_cliente"];
        $idServicio = $_POST["id_servicio"];

        $ticketContratado = [
            "id_cliente" => $idCliente,
            "id_servicio" => $idServicio
        ];
        
        $resultados = $apiClient->post("insert-contrato-servicio",$ticketContratado);

        if($resultados["error"] === 0){
            header("Location: ../dashboard/dashboardCliente.php?error=ticket");
            exit();
        }

    }

?>

