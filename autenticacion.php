<?php 
    require_once "configuracion.php";
  
    // Autenticación para el OAuth Flow de Google
    if (isset($_GET["code"])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
        
        if (isset($token["access_token"])) {
            $client->setAccessToken($token["access_token"]);

            // Obtenemos la información del perfil
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get(); // Corregido 'userinfo'
            $email = $google_account_info->email;
            $name = $google_account_info->name;
            $foto = $google_account_info->picture;
            $google_id = $google_account_info->id;

            // Ahora puedes usar el $email y $name según lo que necesites
        } else {
            // Manejo de error si el token no se obtiene correctamente
            echo "Error al obtener el token de acceso.";
        }

        if (isset($token['error'])) {
            echo "Error: " . $token['error_description'];
            exit;
        }
    }
?>
