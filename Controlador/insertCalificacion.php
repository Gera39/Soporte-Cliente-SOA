<?php
require_once("../Conexion/ConsumoApi.php");
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

if (isset($_POST['id_empleado']) && isset($_POST['id_cliente']) && isset($_POST['id_ticket']) && isset($_POST['calificacion']) && isset($_POST['comentario'])) {
    // Obtener los datos del formulario
    $id_empleado = $_POST['id_empleado'];
    $id_cliente = $_POST['id_cliente'];
    $id_ticket = $_POST['id_ticket'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $error = 0;

    // Preparar los datos para enviar a la API
    $nuevaCalificacion = [
        "id_empleado" => $id_empleado,
        "id_cliente" => $id_cliente,
        "id_ticket" => $id_ticket,
        "calificacion" => $calificacion,
        "comentario" => $comentario,
        "error" => $error
    ];
    // Llamar a la API para insertar la calificación
    $resultado = $apiClient->post("insert-calificacion", $nuevaCalificacion);

    if (isset($resultado["error"]) && $resultado["error"] == 0) {
        echo json_encode(['error' => $resultado["error"]], JSON_PRETTY_PRINT);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'No se pudo insertar la calificación'], JSON_PRETTY_PRINT);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos'], JSON_PRETTY_PRINT);
}
?>
