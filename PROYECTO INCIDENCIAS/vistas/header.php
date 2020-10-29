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
            <img id='logo' src='img/logo.png' />
            <table id='tablaHeader'>
                <tr>
                    <td>Incidencias</td>
                    <td>Nueva Incidencia</td>
                </tr>
            </table>
            <button id='botonCerrarSesion' onclick='location.href=\"index.php?action=cerrarSesion\"'>Cerrar sesión</button>
        </div>";

    }