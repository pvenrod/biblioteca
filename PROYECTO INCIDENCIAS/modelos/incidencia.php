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
            $result = $this->db->query("SELECT incidencias.*, usuarios.usuario as nombreUsuario, usuarios.id as idUsuario
                                        FROM incidencias
                                        INNER JOIN usuarios
                                            ON incidencias.usuario = usuarios.id");

            if ($result->num_rows != 0) {

                $devolver = array();

                while($fila = $result->fetch_object()) {

                    $devolver[] = $fila;

                }

            }

            return $devolver;

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

            $devolver = 0;

            $id = $this->db->query("SELECT IFNULL(MAX(id), 0) + 1 as id
                                    FROM incidencias")->fetch_object()->id; // Saco el nuevo id para la incidencia.
            $lugar;
            $equipo;
            $descripcion;
            $observaciones;
            $usuario;
            $estado;
            $prioridad;

            $result = $this->db->query("INSERT INTO incidencias
                                        VALUES
                                            ('$id', NOW(), '$lugar', '$equipo', '$descripcion', '$observaciones', '$usuario', '$estado', '$prioridad')");
                  
            $devolver = $this->db->affected_rows;

            return $devolver;

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

            $devolver = 0;

            $fecha;
            $lugar;
            $equipo;
            $descripcion;
            $observaciones;
            $usuario;
            $estado;
            $prioridad;

            $this->delete($id);

            $result = $this->db->query("INSERT INTO incidencias
                                        VALUES
                                            ('$id', '$fecha', '$lugar', '$equipo', '$descripcion', '$observaciones', '$usuario', '$estado', '$prioridad')");
                  
            $devolver = $this->db->affected_rows;

            return $devolver;

        }


        /**
         * Función para eliminar incidencias.
         * @param id Es el id de la incidencia a eliminar.
         * @return 1 en caso de éxito, y 0 en caso de error.
         */
        public function delete($id) {

            $devolver = 0;

            $result = $this->db->query("DELETE FROM incidencias
                                        WHERE id = '$id'");

            $devolver = $this->db->affected_rows;

            return $devolver;

        }


        public function marcarCerrada($id) {

            $devolver = 0;

            $result = $this->db->query("UPDATE incidencias
                                        SET estado = 'CERRADA'
                                        WHERE id = '$id'");

            $devolver = $this->db->affected_rows;

            return $devolver;

        }
    }

