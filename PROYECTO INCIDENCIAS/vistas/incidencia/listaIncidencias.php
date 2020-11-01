<?php

// Variables para esta vista: $data["listaIncidencias"] y $data["rolUsuario"]

//var_dump($data);

echo "<div class='divIncidencias'>";

if (count($data["listaIncidencias"]) > 0) {

    if ($data["rolUsuario"] == "admin") {

        //echo    "<th>ID</th>";

    }

    foreach($data["listaIncidencias"] as $incidencia) {

        $colorIncidencia;
        $colorFuente;
        $colorBolaPrioridad;

        switch ($incidencia->prioridad) {
            case "MAXIMA":
                $colorIncidencia = " maxPrioridad";
                $colorFuente = " maxPrioridadF";
                $colorBolaPrioridad = " maxPrioridadB";
            break;
            case "MEDIA":
                $colorIncidencia = " medPrioridad";
                $colorFuente = " medPrioridadF";
                $colorBolaPrioridad = " medPrioridadB";
            break;
            case "BAJA":
                $colorIncidencia = " bajaPrioridad";
                $colorFuente = " bajaPrioridadF";
                $colorBolaPrioridad = " bajaPrioridadB";
            break;
            default:
                $colorIncidencia = " ninPrioridad";
                $colorFuente = " ninPrioridadF";
                $colorBolaPrioridad = " ninPrioridadB";

        }

        echo "<div class='incidencia $colorIncidencia' id='" . (int)$incidencia->id . "'>
                <table style='width: 80%; position: relative; left: 50%; transform: translateX(-50%)'>
                    <tr>
                        <td><span><strong>ID</strong>: $incidencia->id </span></td>
                        <td><span><strong>Fecha</strong>: $incidencia->fecha </span></td>
                        <td><span><strong>Lugar</strong>: $incidencia->lugar </span></td>
                        <td><span><strong>Equipo</strong>: $incidencia->equipo </span></td>
                        <td><span><strong>Estado</strong>: $incidencia->estado </span></td>
                    </tr>
                </table>
                <span class='bolaPrioridadIncidencia $colorBolaPrioridad' title='$incidencia->prioridad PRIORIDAD'></span><br>
                <button onclick='mostrar(" . $incidencia->id . "," . (int)$incidencia->id * 1000000 . ")' class='botonMostrarMas' id='" . (int)$incidencia->id * 1000000 . "'>Mostrar más</button><br>
                <table style='width: 60%; position: relative; left: 50%; transform: translateX(-50%)'>
                    <tr>
                        <td style='width: 45%'><span><strong>Descripción</strong>: $incidencia->descripcion </span></td>
                        <td  style='width: 10%'></td>
                        <td style='width: 45%'><span><strong>Obersvacones</strong>: $incidencia->observaciones </span></td>
                    </tr>
                </table>
                
            </div>
            <div class='ampliacion sinDesplegar'></div>";
        
        //echo    "<td>" . $incidencia->fecha . "</td>
                //<td>" . $incidencia->lugar . "</td>
                //<td>" . $incidencia->equipo . "</td>
               // <td>" . $incidencia->descripcion . "</td>
               // <td>" . $incidencia->observaciones . "</td>";

    }

} else {

    echo "No existe ninguna incidencia actualmente.";

}

echo "</div>
    <script>

        function mostrar(div, boton) {

            var divSeleccionado = document.getElementById(div);
            var botonSeleccionado = document.getElementById(boton);

            divSeleccionado.style.height = '160px';
            botonSeleccionado.innerHTML = 'Mostrar menos';
            botonSeleccionado.removeAttribute('onclick');
            botonSeleccionado.setAttribute('onclick', \"esconder(\" + div + \",\" + boton + \")\");

        }

        function esconder(div, boton) {

            var divSeleccionado = document.getElementById(div);
            var botonSeleccionado = document.getElementById(boton);

            divSeleccionado.style.height = '100px';

            botonSeleccionado.innerHTML = 'Mostrar más';
            botonSeleccionado.removeAttribute('onclick');
            botonSeleccionado.setAttribute('onclick', \"mostrar(\" + div + \",\" + boton + \")\");

        }

    </script>";