<?php

// Variables para esta vista: $data["listaIncidencias"] y $data["rolUsuario"]

//var_dump($data);

echo "<div id='divIncidencias'>
        <span id='tituloIncidencias'>Lista de incidencias:</span>";

if (count($data["listaIncidencias"]) > 0) {

    foreach($data["listaIncidencias"] as $incidencia) {

        $colorIncidencia;
        $colorFuente;
        $colorBolaPrioridad;

        switch ($incidencia->prioridad) { // Este switch es para determinar el color que va a tener cada incidencia, en función de su prioridad.
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
                        <td><span><strong>ID</strong>:<br> $incidencia->id </span></td>
                        <td><span><strong>Lugar</strong>:<br> $incidencia->lugar </span></td>
                        <td><span><strong>Equipo</strong>:<br> $incidencia->equipo </span></td>
                        <td><span><strong>Estado</strong>:<br> $incidencia->estado </span></td>";

        if ($data["rolUsuario"] == "admin") {

            echo        "<td><span><strong>Usuario</strong>:<br> $incidencia->nombreUsuario </span></td>";

        }

        echo            "<td><button class='botonModificarIncidencia' onclick='modificarIncidencia(\"$incidencia->id\", \"$incidencia->fecha\", \"$incidencia->lugar\", \"$incidencia->equipo\", \"$incidencia->descripcion\", \"$incidencia->observaciones\", \"$incidencia->idUsuario\", \"$incidencia->estado\", \"$incidencia->prioridad\")'>Modificar</button></td>";
        
        if ($incidencia->estado != "CERRADA") { // Si la incidencia no está cerrada, aparecerá un botón para cerrarla.

            echo        "<td><button class='botonCerrarIncidencia' onclick='marcarCerradaIncidencia($incidencia->id)'>Marcar como cerrada</button></td>";

        } else { // En caso contrario, el botón estará deshabilitado.

            echo        "<td><button title='La incidencia ya se encuentra cerrada.' class='botonCerrarIncidencia disabled'>Marcar como cerrada</button></td>";

        }
        if ($data["rolUsuario"] == "admin") { // Si el usuario es "admin", se le mostrará la opción de eliminar las incidencias.

            echo        "<td><button class='botonEliminarIncidencia' onclick='eliminarIncidencia($incidencia->id)'>Eliminar</button></td>";
    
        }

        echo        "</tr>
                </table>
                <span style='position: absolute; top: 5px; left: 10px;'>$incidencia->fecha</span>
                <span class='bolaPrioridadIncidencia $colorBolaPrioridad' title='$incidencia->prioridad PRIORIDAD'></span><br>
                <button onclick='mostrar(" . $incidencia->id . "," . (int)$incidencia->id * 1000000 . ")' class='botonMostrarMas' id='" . (int)$incidencia->id * 1000000 . "'>Mostrar más...</button><br>
                <table style='width: 60%; position: relative; left: 50%; transform: translateX(-50%)'>
                    <tr>
                        <td style='width: 45%'><span><strong>Descripción</strong>: $incidencia->descripcion </span></td>
                        <td  style='width: 10%'></td>
                        <td style='width: 45%'><span><strong>Obersvacones</strong>: $incidencia->observaciones </span></td>
                    </tr>
                </table><br>
                
            </div>";
        
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

            divSeleccionado.style.height = '200px';
            divSeleccionado.style.overflowY = 'scroll';
            divSeleccionado.style.paddingBottom = '20px';

            botonSeleccionado.innerHTML = 'Mostrar menos...';
            botonSeleccionado.removeAttribute('onclick');
            botonSeleccionado.setAttribute('onclick', 'esconder(' + div + ',' + boton + ')');

        }

        function esconder(div, boton) {

            var divSeleccionado = document.getElementById(div);
            var botonSeleccionado = document.getElementById(boton);

            divSeleccionado.scrollTop = 0;
            divSeleccionado.style.height = '150px';
            divSeleccionado.style.overflowY = 'hidden';
            divSeleccionado.style.paddingBottom = '0px';

            botonSeleccionado.innerHTML = 'Mostrar más...';
            botonSeleccionado.removeAttribute('onclick');
            botonSeleccionado.setAttribute('onclick', 'mostrar(' + div + ',' + boton + ')');

        }
        

        function marcarCerradaIncidencia(id) {

            var fondo = document.createElement('div');
            fondo.setAttribute('id', 'fondo');

            var div = document.createElement('div');
            div.setAttribute('id','divConfirmacion');

            var span = document.createElement('span');
            span.innerHTML = '¿Estás seguro de que deseas marcar como cerrada la incidencia con <strong>ID: ' + id + '</strong>?';

            var boton1 = document.createElement('button');
            boton1.innerHTML = 'Confirmar';
            boton1.setAttribute('onclick','location.href=\"index.php?action=marcarCerradaIncidencia&id=' + id + '\"');
            boton1.setAttribute('id', 'botonConfirmar');

            var boton2 = document.createElement('button');
            boton2.innerHTML = 'Cancelar';
            boton2.setAttribute('onclick','document.getElementById(\"fondo\").remove(); document.getElementById(\"divConfirmacion\").remove()');
            boton2.setAttribute('id', 'botonCancelar');

            

            

            document.body.appendChild(fondo);
            document.body.appendChild(div);
            div.appendChild(span);
            div.appendChild(document.createElement('br'));
            div.appendChild(boton1);
            div.appendChild(boton2);

        }
        
        
        function modificarIncidencia(id,fecha) {

            var fondo = document.createElement('div');
            fondo.setAttribute('id', 'fondo');

            var div = document.createElement('div');
            div.setAttribute('id','divModificarIncidencia');

            var span = document.createElement('span');
            span.innerHTML = 'Vas a modificar la incidencia con <strong>ID: ' + id + '</strong>';

            var form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', 'index.php');

            var table = document.createElement('table');
            table.setAttribute('id', 'tablaModificar');

            var tr1 = document.createElement('tr');
            var td1tr1 = document.createElement('td');
            td1tr1.innerHTML = 'Fecha';
            var td2tr1 = document.createElement('td');
            var inputFecha = document.createElement('input');
            inputFecha.setAttribute('type','text');
            inputFecha.setAttribute('value',fecha);

            var boton1 = document.createElement('button');
            boton1.innerHTML = 'Guardar';
            boton1.setAttribute('onclick','location.href=\"index.php?action=modificarIncidencia&id=' + id + '\"');
            boton1.setAttribute('id', 'botonConfirmar');

            var boton2 = document.createElement('button');
            boton2.innerHTML = 'Cancelar';
            boton2.setAttribute('onclick','document.getElementById(\"fondo\").remove(); document.getElementById(\"divConfirmacion\").remove()');
            boton2.setAttribute('id', 'botonCancelar');

            

            

            document.body.appendChild(fondo);
            document.body.appendChild(div);
            div.appendChild(span);
            div.appendChild(document.createElement('br'));
            div.appendChild(form);
                form.appendChild(table);
                    table.appendChild(tr1);
                        tr1.appendChild(td1tr1);
                        tr1.appendChild(td2tr1);
                            td2tr1.appendChild(inputFecha); 
            div.appendChild(boton1);
            div.appendChild(boton2);

        }
        ";

    if ($data["rolUsuario"] == "admin") {

        echo "function eliminarIncidencia(id) {

            var fondo = document.createElement('div');
            fondo.setAttribute('id', 'fondo');

            var div = document.createElement('div');
            div.setAttribute('id','divConfirmacion');

            var span = document.createElement('span');
            span.innerHTML = '¿Estás seguro de que deseas borrar la incidencia con <strong>ID: ' + id + '</strong>?';

            var boton1 = document.createElement('button');
            boton1.innerHTML = 'Confirmar';
            boton1.setAttribute('onclick','location.href=\"index.php?action=eliminarIncidencia&id=' + id + '\"');
            boton1.setAttribute('id', 'botonConfirmar');

            var boton2 = document.createElement('button');
            boton2.innerHTML = 'Cancelar';
            boton2.setAttribute('onclick','document.getElementById(\"fondo\").remove(); document.getElementById(\"divConfirmacion\").remove()');
            boton2.setAttribute('id', 'botonCancelar');

            

            

            document.body.appendChild(fondo);
            document.body.appendChild(div);
            div.appendChild(span);
            div.appendChild(document.createElement('br'));
            div.appendChild(boton1);
            div.appendChild(boton2);

        }";

    }

echo    "</script>";

