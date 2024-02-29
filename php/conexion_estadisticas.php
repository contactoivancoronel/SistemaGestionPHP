<?php
    class conexion{
        private $servidor;
        private $usuario;
        private $contrasena;
        private $basedatos;
        public $conexion;
        public function __construct(){
            $this->servidor = "localhost";
            $this->usuario = "u869947011_flamenca";
            $this->contrasena = "GimenaFlamenca@202";
            $this->basedatos = "u869947011_bdhostinger";
        }
        function conectar(){
            $this->conexion = new mysqli($this->servidor,$this->usuario,$this->contrasena,
            $this->basedatos);
            $this->conexion->set_charset("utf8");
        } 
        function cerrar(){
            $this->conexion->close();
        }
    }
?>
