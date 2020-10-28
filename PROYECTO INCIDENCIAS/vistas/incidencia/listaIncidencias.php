<?php


if (count($data["listaIncidencias"]) > 0) {

    echo "<table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
            </tr>";

    foreach($data["listaIncidencias"] as $incidencia) {

        echo "<tr>
                <td>" . $incidencia->lugar . "</td>
                <td>" . $incidencia->estado . "</td>
            </tr>";

    }

}