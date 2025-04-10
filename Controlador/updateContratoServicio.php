<?php
require_once("../Conexion/ConsumoApi.php");
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

if (isset($_POST['id_contrato']) && isset($_POST['id_cliente']) && isset($_POST['id_servicio']) && isset($_POST['fecha_contratacion'])) {
    // Obtener los datos del formulario
    $id_contrato = $_POST['id_contrato'];
    $id_cliente = $_POST['id_cliente'];
    $id_servicio = $_POST['id_servicio'];
    $fecha_contratacion = $_POST['fecha_contratacion'];
    $error = 0;

    // Preparar los datos para enviar a la API
    $actualizarContratoServicio = [
        "id_contrato" => $id_contrato,
        "id_cliente" => $id_cliente,
        "id_servicio" => $id_servicio,
        "fecha_contratacion" => $fecha_contratacion,
        "error" => $error
    ];

    // Llamar a la API para actualizar el contrato de servicio
    $resultado = $apiClient->post("update-contrato-servicio", $actualizarContratoServicio);

    if (isset($resultado["error"]) && $resultado["error"] == 0) {
        echo json_encode(['error' => $resultado["error"]], JSON_PRETTY_PRINT);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'No se pudo actualizar el contrato de servicio'], JSON_PRETTY_PRINT);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos'], JSON_PRETTY_PRINT);
}
?>
