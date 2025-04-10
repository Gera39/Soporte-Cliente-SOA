<?php
require_once("ConsumoApi.php");
// Instanciar la clase con la URL base de la API
$apiClient = new DatabaseApiClient("http://127.0.0.1:8000/api");


try {
    $usuarios = $apiClient->get("servicios");
    echo "Lista de Usuarios:\n";
    print_r($usuarios);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Ejemplo de solicitud POST para crear un nuevo usuario
try {
    $nuevoUsuario = [
    "nombre"=> "Jerry",
    "apellido"=> "Morales Lara",
    "correo"=> "jerrymorales19@gmail.com",
    "telefono"=> "2271062767",
    "direccion"=> "Calle Fa3",
    "cp"=>"74183",
    "estado"=> "Puebla",
    "password"=> "12345678"
    ];
    $respuesta = $apiClient->post("insert-cliente", $nuevoUsuario);
    echo "Usuario Creado:\n";
    
    print_r($respuesta);


    echo $respuesta["username"];
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


$rew = [
    "id_servicio"=>"5"
];
$respuesta = $apiClient->delete("deleteServicio",$rew);



echo $respuesta["mensaje"];


?>
