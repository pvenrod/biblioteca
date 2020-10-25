<?php

    include_once("vista.php");
    include_once("modelos/usuario.php");
    include_once("modelos/incidencia.php");

    class Controlador {

        private $vista, $usuario, $incidencia;

        /**
         * Constructor. Crea las variables de los modelos y la vista
         */
        public function __construct() {

            $this->vista = new Vista();
            $this->usuario = new Usuario();
            //$this->incidencia = new Incidencia();

        }

        public function mostrarFormularioIniciarSesion() {

            $this->vista->mostrar("usuario/formularioIniciarSesion");

        }

        public function mostrarFormularioRegistrarse() {

            $this->vista->mostrar("usuario/formularioRegistrarse");

        }

    }