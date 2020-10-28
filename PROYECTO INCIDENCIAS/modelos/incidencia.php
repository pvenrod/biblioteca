<?php

    class Incidencia {

        private $db;

        /**
         * Constructor. Establece la conexión con la base de datos y la 
         * guarda en una variable de clase.
         */
        public function __construct() {

            $this->db = new mysqli("localhost","root","","incidencias");

        }


        /**
         * Función que devuelve una incidencia concreta.
         * @param id El id de la incidencia a consultar.
         * @return Un objeto con todos los datos de la incidencia extraídos de la BD, o null en caso de error.
         */
        public function get($id) {
            
            $devolver = null;

            if ($result = $this->db->query("SELECT *
                                            FROM incidencias
                                            WHERE id = '$id'")->num_rows == 1) {

                $devolver = $result->fetch_object();

            }

            return $devolver;

        }

        /**
         * Función que devuelve todas las incidencias.
         * @return Un objeto con todos los datos de todas las incidencias extraídos de la BD, o null en caso de error.
         */
        public function getAll() {

            $devolver = null;
            $result = $this->db->query("SELECT *
                                            FROM incidencias");

            if ($result->num_rows == 1) {

                $devolver = array();

                while($fila = $result->fetch_object()) {

                    $devolver[] = $fila;

                }

            }

            return $devolver;

        }


        /**
         * Función que devuelve todas las incidencias.
         * @return Un objeto con todos los datos de todas las incidencias extraídos de la BD, o null en caso de error.
         */
        public function getAllEstandar() {

            $devolver = null;

            if ($result = $this->db->query("SELECT *
                                            FROM incidencias")->num_rows == 1) {

                $devolver = array();

                while($fila = $result->fetch_object()) {

                    $devolver[] = $fila;

                }

            }

            return $devolver;

        }

        
        /**
         * Función para registrar nuevos usuarios.
         * @param usuario El nombre de usuario.
         * @param email El email del usuario.
         * @param contrasenya La contraseña del usuario.
         * @param contrasenya2 La confirmación de la contraseña.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function insert($fecha, $lugar, $equipo, $descripcion, $observaciones, $usuario, $estado, $prioridad) {

            $devolver = 0;

            $id = $this->db->query("SELECT IFNULL(MAX(id), 0) + 1 as id
                                    FROM incidencias")->fetch_object->id; // Saco el nuevo id para el usuario
            $usuario;
            $email;
            $contrasenya;
            $contrasenya2;
            $rol = "estandar";

            if ($contrasenya == $contrasenya2) {

                $result = $this->db->query("INSERT INTO usuarios
                                            VALUES
                                                ('$id', '$usuario', '$email', '$contrasenya', '$rol'");
                  
                $devolver = $result->affected_rows;

            }

            return $devolver;

        }


        /**
         * Función para actualizar la información de los usuarios.
         * @param id Es el id del usuario a actualizar.
         * @param usuario Es el nombre de usuario del usuario a actualizar.
         * @param email Es el nuevo email del usuario a actualizar.
         * @param contrasenya Es la nueva contraseña del usuario a actualizar.
         * @param contrasenya2 Es la confirmación de la contraseña.
         * @param rol Es el rol del usuario a actualizar.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function update($id, $usuario, $email, $contrasenya, $contrasenya2, $rol) {

            $devolver = 0;

            $id;
            $usuario;
            $email;
            $contrasenya;
            $contrasenya2;
            $rol;

            if ($contrasenya == $contrasenya2) {

                $this->delete($id);

                $result = $this->db->query("INSERT INTO usuarios
                                            VALUES
                                                ('$id', '$usuario', '$email', '$contrasenya', '$rol'");
                  
                $devolver = $result->affected_rows;

            }

            return $devolver;

        }


        /**
         * Función para actualizar la información de los usuarios.
         * @param id Es el id del usuario a eliminar.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function delete($id) {

            $devolver = 0;

            $result = $this->db->query("DELETE FROM usuarios
                                        WHERE id = '$id'");

            // También vamos a borrar todas las incidencias creadas por este usuario.
            $result2 = $this->db->query("DELETE FROM incidencias
                                        WHERE usuario = '$id'");

            $devolver = $result->affected_rows;

            return $devolver;

        }
    }

