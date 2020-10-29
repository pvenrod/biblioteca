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
            $this->incidencia = new Incidencia();

        }

        public function mostrarFormularioIniciarSesion() {

            if (isset($_SESSION["usuario"])) {

                $this->vista->mostrar("incidencia/listaIncidencias");

            } else {

                $this->vista->mostrar("usuario/formularioIniciarSesion");

            }

        }

        public function mostrarFormularioRegistrarse() {

            if (isset($_SESSION["usuario"])) {

                $this->vista->mostrar("incidencia/listaIncidencias");

            } else {

                $this->vista->mostrar("usuario/formularioRegistrarse");

            }

        }

        public function procesarLogin() {

            $usuario = $_REQUEST["usuario"];
            $contrasenya = $_REQUEST["contrasenya"];

            if ($this->usuario->buscarUsuario($usuario, $contrasenya)) {

                $this->mostrarListaIncidencias();

            } else  {

                $data["msjError"] = "Usuario y/o contraseña incorrectos.";

                $this->vista->mostrar("usuario/formularioIniciarSesion", $data);

            }

        }

        public function cerrarSesion() {

            session_destroy();
            header("Location: index.php");

        }

        public function procesarRegistro() {

            $usuario = $_REQUEST["usuario"];
            $email = $_REQUEST["email"];
            $contrasenya1 = $_REQUEST["contrasenya1"];
            $contrasenya2 = $_REQUEST["contrasenya2"];

            if ($this->usuario->insert($usuario, $email, $contrasenya1, $contrasenya2)) {

                $this->usuario->buscarUsuario($usuario, $contrasenya1);
                $this->mostrarListaIncidencias();

            } else  {

                $data["msjError"] = "Introduce los datos correctamente.";

                $this->vista->mostrar("usuario/formularioRegistrarse", $data);

            }

        }

        public function mostrarListaIncidencias() {

            $data = array();

            if (isset($_SESSION["usuario"])) {

                $data["rolUsuario"] = $_SESSION["rol"];

                if ($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "estandar") {

                    $data["listaIncidencias"] = $this->incidencia->getAll();
                    $this->vista->mostrar("incidencia/listaIncidencias",$data);

                } else if ($_SESSION["rol"] == "desactivado") {

                    $data["msjError"] = "Tu usuario aún no está habilitado. Inténtalo más tarde.";
                     $this->vista->mostrar("usuario/formularioIniciarSesion", $data);

                }

            } else  {

                $data["msjError"] = "Necesitas estar logueado para hacer eso.";

                $this->vista->mostrar("usuario/formularioIniciarSesion", $data);

            }


        }

    }