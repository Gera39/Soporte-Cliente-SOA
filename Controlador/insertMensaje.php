<?php
require_once("../Conexion/ConsumoApi.php");
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

if (isset($_POST['id_ticket']) && isset($_POST['id_usuario']) && isset($_POST['mensaje']) && isset($_POST['url_archivo'])) {
    // Obtener los datos del formulario
    $id_ticket = $_POST['id_ticket'];
    $id_usuario = $_POST['id_usuario'];
    $mensaje = $_POST['mensaje'];
    $url_archivo = $_POST['url_archivo'];
    $error = 0;

    // Preparar los datos para enviar a la API
    $nuevoMensaje = [
        "id_ticket" => $id_ticket,
        "id_usuario" => $id_usuario,
        "mensaje" => $mensaje,
        "url_archivo" => $url_archivo,
        "error" => $error
    ];

    // Llamar a la API para insertar el mensaje
    $resultado = $apiClient->post("insert-mensaje", $nuevoMensaje);

    if (isset($resultado["error"]) && $resultado["error"] == 0) {
        echo json_encode(['error' => $resultado["error"]], JSON_PRETTY_PRINT);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'No se pudo insertar el mensaje'], JSON_PRETTY_PRINT);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos'], JSON_PRETTY_PRINT);
}
?>
