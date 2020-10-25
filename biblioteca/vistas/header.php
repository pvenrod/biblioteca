<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="../estilos/estilos.css">
  </head>
  <body>

    <?php

        session_start();

        if (!isset($_REQUEST["action"])) {

            if (isset($_SESSION["usuario"])) {

                echo "<button class='botonSesion cerrarSesion' onclick='location.href=\"index.php?action=cerrarSesion\"'>Cerrar sesión</button>";

            }

            else {

                echo "<button class='botonSesion iniciarSesion' onclick='location.href=\"index.php?action=formularioIniciarSesion\"'>Iniciar sesión</button>";

            }
        }