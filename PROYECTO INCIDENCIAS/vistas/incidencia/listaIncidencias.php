<?php

// Variables para esta vista: $data["listaIncidencias"] y $data["rolUsuario"]

if (count($data["listaIncidencias"]) > 0) {

    echo "<table id='tablaIncidencias'>
            <tr>";

    if ($data["rolUsuario"] == "admin") {

        echo    "<th>ID</th>";

    }

    echo        "<th>Fecha</th>
                <th>Lugar</th>
                <th>Equipo</th>
                <th>Descripción</th>
                <th>Observaciones</th>";

    if ($data["rolUsuario"] == "admin") {

        echo    "<th>Usuario</th>";

    }
     
    echo        "<th>Estado</th>
                <th>Prioridad</th>
             </tr>";

    foreach($data["listaIncidencias"] as $incidencia) {

        echo "<tr>";

        if ($data["rolUsuario"] == "admin") {

            echo "<td>" . $incidencia->id . "</td>";

        }
        
        echo    "<td>" . $incidencia->fecha . "</td>
                <td>" . $incidencia->lugar . "</td>
                <td>" . $incidencia->equipo . "</td>
                <td>" . $incidencia->descripcion . "</td>
                <td>" . $incidencia->observaciones . "</td>";
        
        if ($data["rolUsuario"] == "admin") {

            echo "<td>" . $incidencia->usuario . "</td>";

        }

        echo    "<td>" . $incidencia->estado . "</td>
                <td>" . $incidencia->prioridad . "</td>
                </tr>";

    }

    echo "</table>";

}