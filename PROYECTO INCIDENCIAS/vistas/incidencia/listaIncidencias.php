<?php

// Variables para esta vista: $data["listaIncidencias"] y $data["rolUsuario"]

//var_dump($data);

if (count($data["listaIncidencias"]) > 0) {

    if ($data["rolUsuario"] == "admin") {

        //echo    "<th>ID</th>";

    }

    echo "<div class='divIncidencias'>";

    foreach($data["listaIncidencias"] as $incidencia) {

        echo "<div class='incidencia'></div>";
        
        //echo    "<td>" . $incidencia->fecha . "</td>
                //<td>" . $incidencia->lugar . "</td>
                //<td>" . $incidencia->equipo . "</td>
               // <td>" . $incidencia->descripcion . "</td>
               // <td>" . $incidencia->observaciones . "</td>";

    }

    echo "</div>";

}