<?php
function obtenerUbicacionOpenCage($latitud, $longitud) {
    $apiKey = '4a76f0e8ea6d424a830e61d2010f12d8'; // Sustituye con tu clave API de OpenCage
    $url = "https://api.opencagedata.com/geocode/v1/json?q=$latitud+$longitud&key=$apiKey";

    // Realiza la solicitud GET
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data['status']['code'] == 200) {
        $codigoPostal = '';
        $estado = '';

        // Buscar en los resultados la información deseada
        foreach ($data['results'][0]['components'] as $key => $value) {
            if ($key == 'road') {
                $codigoPostal = $value;
            }
            if ($key == '_normalized_city') {
                $estado = $value;
            }
        }

        return ['direccion' => $codigoPostal, 'estado' => $estado];
    }

    return null; 
}


if (isset($_POST['latitud']) && isset($_POST['longitud'])) {
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    
    $ubicacion = obtenerUbicacionOpenCage($latitud, $longitud);  

    if ($ubicacion) {
       
        echo json_encode([
            'direccion' => $ubicacion['direccion'], 
            'estado' => $ubicacion['estado']
        ]);
    } else {
        echo json_encode(null);
    }
}
?>
