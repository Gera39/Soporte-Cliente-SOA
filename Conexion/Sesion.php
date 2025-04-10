<?php
class Sesion {

    // Inicia la sesión si no está ya iniciada
    public static function startSesion() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Inicia sesión con un nombre de usuario
    public static function login($username) {
        self::startSesion();
        // Establecer variables de sesión
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
    }
    public static function id($id){
        $_SESSION['id'] = $id;
    }
    public static function getId(){
        self::startSesion();
        return isset($_SESSION['id']) ? $_SESSION['id'] : null;
    }
    public static function servicios($servicios){
        $_SESSION['servicios'] = $servicios;
    }

    public static function getServicios(){
        self::startSesion();
        return isset($_SESSION['servicios']) ? $_SESSION['servicios'] : null;
    }
    public static function tickets($tickets){
        $_SESSION['tickets'] = $tickets;
    }

    public static function getTickets(){
        self::startSesion();
        return isset($_SESSION['tickets']) ? $_SESSION['tickets'] : null;
    }
    
      public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

   
    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

   
    public static function delete($key) {
        unset($_SESSION[$key]);
    }
    public static function rol($rol){
        $_SESSION['rol'] = $rol;
    } 
    public static function getRol(){
        self::startSesion();
        return isset($_SESSION['rol']) ? $_SESSION['rol'] : null;  
    }   

    // Verifica si el usuario está autenticado
    public static function estaAutenticado() {
        self::startSesion();
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    // Obtiene el nombre de usuario de la sesión
    public static function getUsername() {
        self::startSesion();
        return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    // Cierra la sesión
    public static function logout() {
        self::startSesion();
        // Eliminar todas las variables de sesión
        session_unset();
        // Destruir la sesión
        session_destroy();
    }

    // Regenera el ID de sesión para prevenir ataques de fijación de sesión
    public static function regenerateSessionId() {
        self::startSesion();
        session_regenerate_id(true);
    }
}
?>
