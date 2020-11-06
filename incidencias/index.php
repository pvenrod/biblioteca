<!-- 

    Proyecto de Incidencias de la aerolínea "Huefi S.L."

-->

<?php

    session_start();

    // Instanciamos el/los controlador/es.
    include_once("controlador.php");
    $controlador = new Controlador();

    // Comprobamos si la variable action está definida, para realizar una acción u otra.
    if (isset($_REQUEST["action"])) {

        $action = $_REQUEST["action"];

    }

    else {

        $action = "mostrarFormularioIniciarSesion"; // Este será el action por defecto.

    }

    $controlador->$action(); // Ejecutamos la acción a través del objeto controlador.