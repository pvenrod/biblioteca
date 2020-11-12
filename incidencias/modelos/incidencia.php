<?php

    include_once("mysqlDB.php");

    class Incidencia {

        private $db;

        /**
         * Constructor. Establece la conexión con la base de datos y la 
         * guarda en una variable de clase.
         */
        public function __construct() {

            $this->db = new mysqlDB("localhost","paolo","Gji54@7s","paolo-veneruso");

        }


        /**
         * Función que devuelve una incidencia concreta.
         * @param id El id de la incidencia a consultar.
         * @return Un objeto con todos los datos de la incidencia extraídos de la BD, o null en caso de error.
         */
        public function get($id) {
            
            $result = $this->db->query("SELECT *
                                        FROM incidencias
                                        WHERE id = '$id'");

            return $result;

        }

        /**
         * Función que devuelve todas las incidencias.
         * @return Un objeto con todos los datos de todas las incidencias extraídos de la BD, o null en caso de error.
         */
        public function getAll() {

            $result = false;
            $usuario = $_SESSION["idUsuario"];
            $rol = $_SESSION["rol"];

            if ($rol == "admin") {

                $result = $this->db->consulta("SELECT incidencias.*, usuarios.usuario as nombreUsuario, usuarios.id as idUsuario
                                                FROM incidencias
                                                INNER JOIN usuarios
                                                    ON incidencias.usuario = usuarios.id");

            } else if ($rol == "estandar") {

                $result = $this->db->consulta("SELECT incidencias.*, usuarios.usuario as nombreUsuario, usuarios.id as idUsuario
                                                FROM incidencias
                                                INNER JOIN usuarios
                                                    ON incidencias.usuario = usuarios.id
                                                WHERE usuarios.id = $usuario");

            }

            return $result;

        }

        
        /**
         * Función para registrar nuevas incidencias.
         * @param fecha La fecha en la que se registra la incidencia.
         * @param lugar El lugar de la incidencia.
         * @param equipo El equipo de la incidencia.
         * @param descripcion Desscripcion de la incidencia.
         * @param observaciones Observaciones de la incidencia.
         * @param estado Estado de la incidencia.
         * @param usuario Usuario que ha abierto la incidencia.
         * @param prioridad Prioridad de la incidencia. Si no se especifica, toma el valor de "BAJA".
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function insert($lugar, $equipo, $descripcion, $observaciones, $usuario, $estado, $prioridad = "BAJA") {

            $id = $this->db->consulta("SELECT IFNULL(MAX(id), 0) + 1 as id
                                    FROM incidencias")[0]->id; // Saco el nuevo id para la incidencia.
            $lugar;
            $equipo;
            $descripcion;
            $observaciones;
            $usuario;
            $estado;
            $prioridad;

            $result = $this->db->modificacion("INSERT INTO incidencias
                                            VALUES
                                                ('$id', NOW(), '$lugar', '$equipo', '$descripcion', '$observaciones', '$usuario', '$estado', '$prioridad')");

            return $result;

        }


        /**
         * Función para actualizar incidencias.
         * @param fecha La fecha en la que se registra la incidencia.
         * @param lugar El lugar de la incidencia.
         * @param equipo El equipo de la incidencia.
         * @param descripcion Desscripcion de la incidencia.
         * @param observaciones Observaciones de la incidencia.
         * @param estado Estado de la incidencia.
         * @param usuario Usuario que ha abierto la incidencia.
         * @param prioridad Prioridad de la incidencia. Si no se especifica, toma el valor de "BAJA".
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function update($id,$fecha,$lugar,$equipo,$descripcion,$observaciones,$usuario,$estado,$prioridad) {

            $fecha;
            $lugar;
            $equipo;
            $descripcion;
            $observaciones;
            $usuario;
            $estado;
            $prioridad;

            $this->delete($id);

            $result = $this->db->modificacion("INSERT INTO incidencias
                                            VALUES
                                                ('$id', '$fecha', '$lugar', '$equipo', '$descripcion', '$observaciones', '$usuario', '$estado', '$prioridad')");

            return $result;

        }


        /**
         * Función para eliminar incidencias.
         * @param id Es el id de la incidencia a eliminar.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function delete($id) {

            $result = $this->db->modificacion("DELETE FROM incidencias
                                            WHERE id = '$id'");

            return $result;

        }


        public function marcarCerrada($id) {

            $result = $this->db->query("UPDATE incidencias
                                        SET estado = 'CERRADA',
                                            prioridad = 'NINGUNA'
                                        WHERE id = '$id'");

            return $result;

        }
    }

