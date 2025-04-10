<?php
class Persona{
    private $id_persona;
    private $nombre;
    private $apellido;
    private $correo;
    private $telefono;

    
    function __construct($nombre,$apellido,$correo,$telefono){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->telefono = $telefono;
    }

    // Getter y Setter para id_persona
    public function getIdPersona() {
        return $this->id_persona;
    }

    public function setIdPersona($id_persona) {
        $this->id_persona = $id_persona;
    }

    // Getter y Setter para nombre
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Getter y Setter para apellido
    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    // Getter y Setter para correo
    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    // Getter y Setter para telefono
    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }


    
}

?>