<?php

    include_once("vista.php");
    include_once("modelos/usuario.php");
    include_once("modelos/libro.php");
    include_once("modelos/persona.php");

    // Creamos la vista y los modelos

    class Controlador {

        private $vista;
        private $usuario;
        private $libro;
        private $persona;

        public function __construct() {

            $this->vista = new Vista();
            $this->usuario = new Usuario();
            $this->libro = new Libro();
            $this->persona = new Persona();

        }

        public function mostrarFormularioLogin() {

            $this->vista->mostrar("usuario/formularioLogin");

        }

        public function procesarLogin() {

            $usuario = $_REQUEST["usuario"];
            $contrasenya = $_REQUEST["contrasenya"];

            $result = $this->usuario->buscarUsuario($usuario, $contrasenya);

            if ($result) {

                header("Location: index.php");

            }

            else {

                $data["msjError"] = "Nombre de usuario o contraseña incorrectos";
                $this->vista->mostrar("usuario/formularioLogin", $data);

            }

        }

        public function cerrarSesion() {

            session_destroy();
            $data["msjInfo"] = "Sesión cerrada correctamente";
            $this->vista->mostrar("usuario/formularioLogin",$data);

        }

        public function mostrarListaLibros() {

            $data["listaLibros"] = $this->libro->getAll();
            $this->vista->mostrar("libro/mostrarListaLibros",$data);

        }

        public function formularioInsertarLibros() {

            if (isset($_SESSION["usuario"])) {

                $data["listaAutores"] = $this->persona->getAll();
                $this->vista->mostrar("libro/formularioInsertarLibro", $data);

            }

            else {

                $data["msjError"] = "No tienes permisos para hacer eso.";
                $this->vista->mostrar("usuario/formularioLogin", $data);

            }

        }

        public function insertarLibro() {

            $titulo = $_REQUEST["titulo"];
            $genero = $_REQUEST["genero"];
            $pais = $_REQUEST["pais"];
            $anyo = $_REQUEST["anyo"];
            $numPaginas = $_REQUEST["numPaginas"];
            $idEscritor = $_REQUEST["escritor"];
            $idLibro;

            $result = $this->libro->insert($titulo, $genero, $pais, $anyo, $numPaginas);

            if ($result == 1) {

                $idLibro = $this->libro->getLastId();

                foreach ($idEscritor as $autor) {

                    $this->persona->escribe($idLibro, $autor);

                }

                $data["msjInfo"] = "Libro insertado con éxito.";

            }

            else {

                $data["msjError"] = "Ha ocurrido un error al insertar el libro.";

            }

        }

    }