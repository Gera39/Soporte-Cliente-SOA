<?php
require_once("../Conexion/ConsumoApi.php");
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");



if($_SERVER["REQUEST_METHOD"] === "POST"){
    $emId = $_POST["empleados"];
    $dias = $_POST["dias"];
    $inicio = $_POST["inicio"];
    $fin = $_POST["fin"];
    $diasS = "";
    foreach($dias as $dia){
        $diasS .= "-".$dia; 
    }
    $diasS = ltrim($diasS,"-");
   
    $horario = $inicio."-".$fin.",".$diasS;

    
    $datos = [
        "empleados" => $emId,
        "nuevo_horario" => $horario
    ];

    $respuesta = $apiClient->post("actualizar-horarios",$datos);
   if($respuesta["success"] == true){
    header("Location: ../dashboard/dashboardAdmin.php");
   }
}
?>