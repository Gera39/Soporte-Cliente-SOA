<?php
require_once("../Conexion/ConsumoApi.php");
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

if(isset($_POST['id_servicio']) && isset($_POST['nombre_servicio']) && isset($_POST['descripcion']) && isset($_POST['costo'])) {
    // Obtener los datos del formulario
    $id_servicio = $_POST['id_servicio'];
    $nombre_servicio = $_POST['nombre_servicio'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    
  
    // Preparar los datos para enviar a la API
    $actServicio = [
        "id_servicio" =>$id_servicio,
        "nombre_servicio" => $nombre_servicio,
        "descripcion" => $descripcion,
        "costo" =>$costo
    ];

    // Llamar a la API para actualizar el servicio
    $resultado = $apiClient->put("update-servicio", $actServicio);

    if ( $resultado["error"] == 0) {
        header("Location: ../dashboard/dashboardAdmin.php");
    } else {
        echo 'error'; // Si hay algún error
    }
} else {
    echo 'Faltan datos'; // Si no se reciben todos los datos necesarios
}
?>
