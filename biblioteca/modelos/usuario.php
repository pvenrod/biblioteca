<?php

    class Usuario {

        private $db;

        public function __construct() {

            $this->db = new mysqli("localhost:3386", "root", "bitnami", "biblioteca");

        }

        public function buscarUsuario($usuario, $contrasenya) {

            $devuelve = false;

            $consulta = $this->db->query("SELECT *
                                        FROM usuarios
                                        WHERE usuario = '$usuario'
                                        AND BINARY contrasenya = '$contrasenya'");

            if ($consulta->num_rows > 0) {

                $usuario = $consulta->fetch_object();
                // Iniciamos la sesión
                $_SESSION["idUsuario"] = $usuario->id;
                $_SESSION["usuario"] = $usuario->usuario;

                $devuelve = true;

            }

            return $devuelve;

        }

        public function get($id) {

            $arrayResult = array();

            if ($result = $this->db->query("SELECT * 
                                            FROM usuarios
                                            WHERE id = '$id'")) {
                $arrayResult[] = $result->fetch_object();

            } else {

                $arrayResult = null;

            }

            return $arrayResult;

        }

        public function getAll() {
        }

        public function insert() {
        }

        public function update() {
        }

        public function delete() {
        }

    }
