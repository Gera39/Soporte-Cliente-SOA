<?php
session_start();

if (isset($_SESSION['access_token'])) {
    // URL para revocar el token
    $revoke_url = 'https://accounts.google.com/o/oauth2/revoke?token=' . $_SESSION['access_token'];

    // Inicializar una sesión cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $revoke_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud de revocación
    curl_exec($ch);
    curl_close($ch);

    // Borrar la variable de sesión del token de acceso
    unset($_SESSION['access_token']);
}

// Destruir la sesión de PHP
session_destroy();

// Redirigir al usuario a la página principal o de inicio de sesión
header('Location: ../index.php');
exit();
?>