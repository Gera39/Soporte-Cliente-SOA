<?php
require_once("../Conexion/ConsumoApi.php");
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

if (isset($_POST['id_ticket']) && isset($_POST['id_cliente']) && isset($_POST['id_empleado']) && isset($_POST['id_servicio']) && isset($_POST['descripcion'])) {
    // Obtener los datos del formulario
    $id_ticket = $_POST['id_ticket'];
    $id_cliente = $_POST['id_cliente'];
    $id_empleado = $_POST['id_empleado'];
    $id_servicio = $_POST['id_servicio'];
    $descripcion = $_POST['descripcion'];
    $error = 0;

    // Preparar los datos para enviar a la API
    $ticketActualizado = [
        "id_ticket" => $id_ticket,
        "id_cliente" => $id_cliente,
        "id_empleado" => $id_empleado,
        "id_servicio" => $id_servicio,
        "descripcion" => $descripcion,
        "error" => $error
    ];

    // Llamar a la API para actualizar el ticket
    $resultado = $apiClient->post("update-ticket", $ticketActualizado);

    if (isset($resultado["error"]) && $resultado["error"] == 0) {
        echo json_encode(['error' => $resultado["error"]], JSON_PRETTY_PRINT);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'No se pudo actualizar el ticket'], JSON_PRETTY_PRINT);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos'], JSON_PRETTY_PRINT);
}
?>
