<?php
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



?>
