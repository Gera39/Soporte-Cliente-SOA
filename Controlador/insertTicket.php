<?php
require_once("../Conexion/ConsumoApi.php");
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

if (isset($_POST['id_cliente']) && isset($_POST['id_empleado']) && isset($_POST['id_servicio']) && isset($_POST['descripcion'])) {
    // Obtener los datos del formulario
    $id_cliente = $_POST['id_cliente'];
    $id_empleado = $_POST['id_empleado'];
    $id_servicio = $_POST['id_servicio'];
    $descripcion = $_POST['descripcion'];
   

    // Preparar los datos para enviar a la API
    $nuevoTicket = [
        "id_cliente" => $id_cliente,
        "id_empleado" => $id_empleado,
        "id_servicio" => $id_servicio,
        "descripcion" => $descripcion,
       
    ];

    // Llamar a la API para insertar el ticket
    $resultado = $apiClient->post("insert-ticket", $nuevoTicket);

    if ($resultado["error"] == 0) {
        //TOKEN QUE NOS DA FACEBOOK
$token = 'EAAPrH2guZCf4BOZCB0JkgSNKZCkTV7QwY1oWMUFCDp5k2bHaAHtSxCdIrCWOc4yetzUsQqVV4s0K3kkyCg0wVmaYmTf6t9Iz9TZBnr137LC6MUCzYXVHfnrZAGJAZAx2IZBemaf1qfCtcpL3Fs1BV2CxZBGsSmiluWBSALuC0GrNRHRkHyFHf9aduSgE1BRZCG5ZBScpYw0fDPlZBCJ5X4V6I1d0riG1FZAS';
//NUESTRO TELEFONO
$telefono = '522271111758';
//URL A DONDE SE MANDARA EL MENSAJE
$url = 'https://graph.facebook.com/v20.0/520805701105350/messages';

//CONFIGURACION DEL MENSAJE
$mensaje = ''
        . '{'
        . '"messaging_product": "whatsapp", '
        . '"to": "'.$telefono.'", '
        . '"type": "template", '
        . '"template": '
        . '{'
        . '     "name": "hello_world",'
        . '     "language":{ "code": "en_US" } '
        . '} '
        . '}';
//DECLARAMOS LAS CABECERAS
$header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
//INICIAMOS EL CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
$response = json_decode(curl_exec($curl), true);
//IMPRIMIMOS LA RESPUESTA 
//print_r($response);
//OBTENEMOS EL CODIGO DE LA RESPUESTA
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//CERRAMOS EL CURL
curl_close($curl);


        header("Location: ../dashboard/dashboardCliente.php");
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'No se pudo insertar el ticket'], JSON_PRETTY_PRINT);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos'], JSON_PRETTY_PRINT);
}
?>
