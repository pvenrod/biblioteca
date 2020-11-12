<?php

    class mysqlDB {

        private $db;

        /**
         * Constructor. Establece la conexión con la base de datos y la 
         * guarda en una variable de clase.
         */
        public function __construct() {

            $this->db = new mysqli("localhost","paolo","Gji54@7s","paolo-veneruso");

        }


        /**
         * Función que loguea a los usuarios.
         * @param sql El nombre de usuario.
         * @return un array con las filas extraídas de la base de datos.
         */
        public function consulta($sql) {

            $arrayResult = array();

            if ($result = $this->db->query($sql)) {

                while ($fila = $result->fetch_object()) {

                    $arrayResult[] = $fila;

                }
                
            }

            return $arrayResult;
        }

    }

