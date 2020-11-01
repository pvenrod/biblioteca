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
                <span><strong>Fecha</strong>: $incidencia->fecha </span>
                <span><strong>Lugar</strong>: $incidencia->lugar </span>
                <span><strong>Equipo</strong>: $incidencia->equipo </span>
                <span><strong>Estado</strong>: $incidencia->estado </span>
                <span class='bolaPrioridadIncidencia $colorBolaPrioridad' title='$incidencia->prioridad PRIORIDAD'></span><br>
                <button onclick='mostrar(" . $incidencia->id . "," . (int)$incidencia->id * 1000000 . ")' class='botonMostrarMas' id='" . (int)$incidencia->id * 1000000 . "'>Mostrar más</button><br>
                <span><strong>Descripción</strong>: $incidencia->descripcion </span>
                <span><strong>Obersvacones</strong>: $incidencia->observaciones </span>
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