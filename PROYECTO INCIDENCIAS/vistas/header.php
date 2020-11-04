<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilos.css">
    <title>Huefi S.L. - Aerolínea internacional</title>
</head>
<body>

<?php

    if (isset($_SESSION["usuario"])) {

        echo "<div id='header'>
            <a href='index.php'><img id='logo' src='img/logo.png' /></a>
            <table id='tablaHeader'>
                <tr>
                    <td onclick='location.href=\"index.php\"'>Incidencias</td>
                    <td onclick='nuevaIncidencia()'>Nueva Incidencia</td>
                </tr>
            </table>
            <button id='botonCerrarSesion' onclick='location.href=\"index.php?action=cerrarSesion\"'>Cerrar sesión</button>
        </div>";

    }