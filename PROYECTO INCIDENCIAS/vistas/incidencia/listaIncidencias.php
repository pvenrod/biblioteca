<?php

// Variables para esta vista: $data["listaIncidencias"] y $data["rolUsuario"]

//var_dump($data);

echo "<div id='divIncidencias'>
        <span id='tituloIncidencias'>Lista de incidencias:</span>";


if (is_array($data["listaIncidencias"])) {

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
    
    } 
}
else {

    echo "<br><span style='position: absolute; top: 80px; left: 50%; transform: translateX(-50%);'>Aún no has creado ninguna incidencia.</span><br>";

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
        
        
        function modificarIncidencia(id,fecha,lugar,equipo,descripcion,observaciones,idUsuario,estado,prioridad) {

            var fondo = document.createElement('div');
            fondo.setAttribute('id', 'fondo');

            var div = document.createElement('div');
            div.setAttribute('id','divModificarIncidencia');";

            if ($data["rolUsuario"] == "admin") {

                echo "div.setAttribute('style','height: 470px');";

            } else {

                echo "div.setAttribute('style','height: 390px');";

            }

            echo "var span = document.createElement('span');
            span.innerHTML = 'Vas a modificar la incidencia con <strong>ID: ' + id + '</strong>';

            var form = document.createElement('form');
            form.setAttribute('method', 'post');";

            if ($data["rolUsuario"] == "admin") {

                echo "form.setAttribute('action', 'index.php');";

            } else {

                echo "form.setAttribute('action', 'index.php');";

            }

            echo "var table = document.createElement('table');
            table.setAttribute('id', 'tablaModificar');

            var tr2 = document.createElement('tr');
            var td1tr2 = document.createElement('td');
            td1tr2.innerHTML = 'Lugar:';
            var td2tr2 = document.createElement('td');
            var inputLugar = document.createElement('input');
            inputLugar.setAttribute('type','text');
            inputLugar.setAttribute('name','lugar');
            inputLugar.setAttribute('value',lugar);

            var tr3 = document.createElement('tr');
            var td1tr3 = document.createElement('td');
            td1tr3.innerHTML = 'Equipo:';
            var td2tr3 = document.createElement('td');
            var inputEquipo = document.createElement('input');
            inputEquipo.setAttribute('type','text');
            inputEquipo.setAttribute('name','equipo');
            inputEquipo.setAttribute('value',equipo);

            var tr4 = document.createElement('tr');
            var td1tr4 = document.createElement('td');
            td1tr4.innerHTML = 'Descripción:';
            var td2tr4 = document.createElement('td');
            var inputDesc = document.createElement('textarea');
            inputDesc.setAttribute('type','text');
            inputDesc.setAttribute('name','descripcion');
            inputDesc.innerHTML = descripcion;

            var tr5 = document.createElement('tr');
            var td1tr5 = document.createElement('td');
            td1tr5.innerHTML = 'Observaciones:';
            var td2tr5 = document.createElement('td');
            var inputObs = document.createElement('textarea');
            inputObs.setAttribute('type','text');
            inputObs.setAttribute('name','observaciones');
            inputObs.innerHTML = observaciones;

            var inputAction = document.createElement('input');
            inputAction.setAttribute('type','hidden');
            inputAction.setAttribute('value','modificarIncidencia')
            inputAction.setAttribute('name','action');

            var inputId = document.createElement('input');
            inputId.setAttribute('type','hidden');
            inputId.setAttribute('name','id');
            inputId.setAttribute('value',id);";

            if ($data["rolUsuario"] == "admin") {

                echo "var tr1 = document.createElement('tr');
                    var td1tr1 = document.createElement('td');
                    td1tr1.innerHTML = 'Fecha y hora:';
                    var td2tr1 = document.createElement('td');
                    var inputFecha = document.createElement('input');
                    inputFecha.setAttribute('type','text');
                    inputFecha.setAttribute('name','fecha');
                    inputFecha.setAttribute('value',fecha);
        
                    var tr6 = document.createElement('tr');
                    var td1tr6 = document.createElement('td');
                    td1tr6.innerHTML = 'Usuario:';
                    var td2tr6 = document.createElement('td');
                    var inputUsu = document.createElement('input');
                    inputUsu.setAttribute('type','text');
                    inputUsu.setAttribute('name','usuario');
                    inputUsu.setAttribute('value',idUsuario);
        
                    var tr7 = document.createElement('tr');
                    var td1tr7 = document.createElement('td');
                    td1tr7.innerHTML = 'Prioridad:';
                    var td2tr7 = document.createElement('td');
                    var inputPri = document.createElement('select');
                    inputPri.setAttribute('type','text');
                    inputPri.setAttribute('name','prioridad');
        
                    if (prioridad == 'MAXIMA') {
                        op1 = document.createElement('option');
                        op1.setAttribute('value',prioridad);
                        op1.innerHTML = prioridad;
                        op1.setAttribute('selected','selected');
                        op2 = document.createElement('option');
                        op2.setAttribute('value','MEDIA');
                        op2.innerHTML = 'MEDIA'
                        op3 = document.createElement('option');
                        op3.setAttribute('value','BAJA');
                        op3.innerHTML = 'BAJA';
                        op4 = document.createElement('option');
                        op4.setAttribute('value','NINGUNA');
                        op4.innerHTML = 'NINGUNA';
                    } 
                    else if (prioridad == 'MEDIA') {
                        op1 = document.createElement('option');
                        op1.setAttribute('value','MAXIMA');
                        op1.innerHTML = 'MAXIMA';
                        op2 = document.createElement('option');
                        op2.setAttribute('value',prioridad);
                        op2.innerHTML = prioridad;
                        op2.setAttribute('selected','selected');
                        op3 = document.createElement('option');
                        op3.setAttribute('value','BAJA');
                        op3.innerHTML = 'BAJA';
                        op4 = document.createElement('option');
                        op4.setAttribute('value','NINGUNA');
                        op4.innerHTML = 'NINGUNA';
                    }
                    else if (prioridad == 'BAJA') {
                        op1 = document.createElement('option');
                        op1.setAttribute('value','MAXIMA');
                        op1.innerHTML = 'MAXIMA';
                        op2 = document.createElement('option');
                        op2.setAttribute('value','MEDIA');
                        op2.innerHTML = 'MEDIA'
                        op3 = document.createElement('option');
                        op3.setAttribute('value',prioridad);
                        op3.innerHTML = prioridad;
                        op3.setAttribute('selected','selected');
                        op4 = document.createElement('option');
                        op4.setAttribute('value','NINGUNA');
                        op4.innerHTML = 'NINGUNA';
                    }
                    else if (prioridad == 'NINGUNA') {
                        op1 = document.createElement('option');
                        op1.setAttribute('value','MAXIMA');
                        op1.innerHTML = 'MAXIMA';
                        op2 = document.createElement('option');
                        op2.setAttribute('value','MEDIA');
                        op2.innerHTML = 'MEDIA'
                        op3 = document.createElement('option');
                        op3.setAttribute('value','BAJA');
                        op3.innerHTML = 'BAJA';
                        op4 = document.createElement('option');
                        op4.setAttribute('value',prioridad);
                        op4.innerHTML = prioridad;
                        op4.setAttribute('selected','selected');
                    }
        
                    var tr8 = document.createElement('tr');
                    var td1tr8 = document.createElement('td');
                    td1tr8.innerHTML = 'Estado:';
                    var td2tr8 = document.createElement('td');
                    var inputEst = document.createElement('select');
                    inputEst.setAttribute('type','text');
                    inputEst.setAttribute('name','estado');
        
                    if (estado == 'ABIERTA') {
                        op5 = document.createElement('option');
                        op5.setAttribute('value',estado);
                        op5.setAttribute('selected','selected');
                        op5.innerHTML = estado;
                        op6 = document.createElement('option');
                        op6.setAttribute('value','EN ESPERA');
                        op6.innerHTML = 'EN ESPERA';
                        op7 = document.createElement('option');
                        op7.setAttribute('value','CERRADA');
                        op7.innerHTML = 'CERRADA';
                    } 
                    else if (estado == 'EN ESPERA') {
                        op5 = document.createElement('option');
                        op5.setAttribute('value','ABIERTA');
                        op5.innerHTML = 'ABIERTA';
                        op6 = document.createElement('option');
                        op6.setAttribute('value',estado);
                        op6.setAttribute('selected','selected');
                        op6.innerHTML = estado;
                        op7 = document.createElement('option');
                        op7.setAttribute('value','CERRADA');
                        op7.innerHTML = 'CERRADA';
                    }
                    else if (estado == 'CERRADA') {
                        op5 = document.createElement('option');
                        op5.setAttribute('value','ABIERTA');
                        op5.innerHTML = 'ABIERTA';
                        op6 = document.createElement('option');
                        op6.setAttribute('value','EN ESPERA');
                        op6.innerHTML = 'EN ESPERA';
                        op7 = document.createElement('option');
                        op7.setAttribute('value',estado);
                        op7.setAttribute('selected','selected');
                        op7.innerHTML = estado;
                    }";
                
            } else {

                echo "var inputFecha = document.createElement('input');
                    inputFecha.setAttribute('type','hidden');
                    inputFecha.setAttribute('name','fecha');
                    inputFecha.setAttribute('value',fecha);

                    var inputUsu = document.createElement('input');
                    inputUsu.setAttribute('type','hidden');
                    inputUsu.setAttribute('name','usuario');
                    inputUsu.setAttribute('value',idUsuario);

                    var inputPri = document.createElement('input');
                    inputPri.setAttribute('type','hidden');
                    inputPri.setAttribute('name','prioridad');
                    inputPri.setAttribute('value',prioridad);
                
                    var tr8 = document.createElement('tr');
                    var td1tr8 = document.createElement('td');
                    td1tr8.innerHTML = 'Estado:';
                    var td2tr8 = document.createElement('td');
                    var inputEst = document.createElement('select');
                    inputEst.setAttribute('name','estado');
        
                    if (estado == 'ABIERTA') {
                        op5 = document.createElement('option');
                        op5.setAttribute('value',estado);
                        op5.setAttribute('selected','selected');
                        op5.innerHTML = estado;
                        op6 = document.createElement('option');
                        op7 = document.createElement('option');
                        op7.setAttribute('value','CERRADA');
                        op7.innerHTML = 'CERRADA';
                    } 
                    else if (estado == 'EN ESPERA') {
                        op5 = document.createElement('option');
                        op6 = document.createElement('option');
                        op6.setAttribute('value',estado);
                        op6.setAttribute('selected','selected');
                        op6.innerHTML = estado;
                        op7 = document.createElement('option');
                        op7.setAttribute('value','CERRADA');
                        op7.innerHTML = 'CERRADA';
                    }
                    else if (estado == 'CERRADA') {
                        op5 = document.createElement('option');
                        op6 = document.createElement('option');
                        op7 = document.createElement('option');
                        op7.setAttribute('value',estado);
                        op7.setAttribute('selected','selected');
                        op7.innerHTML = estado;
                    }";

            }

            echo "var boton1 = document.createElement('button');
            boton1.innerHTML = 'Guardar';
            boton1.setAttribute('id', 'botonConfirmar');
            boton1.setAttribute('style','top:80px');

            var boton2 = document.createElement('button');
            boton2.innerHTML = 'Cancelar';
            boton2.setAttribute('onclick','document.getElementById(\"fondo\").remove(); document.getElementById(\"divModificarIncidencia\").remove()');
            boton2.setAttribute('id', 'botonCancelar');
            boton2.setAttribute('style','top:80px');

            

            

            document.body.appendChild(fondo);
            document.body.appendChild(div);
            div.appendChild(span);
            div.appendChild(document.createElement('br'));
            div.appendChild(form);
                form.appendChild(table);
                    table.appendChild(tr2);
                        tr2.appendChild(td1tr2);
                        tr2.appendChild(td2tr2);
                            td2tr2.appendChild(inputLugar); 
                    table.appendChild(tr3);
                        tr3.appendChild(td1tr3);
                        tr3.appendChild(td2tr3);
                            td2tr3.appendChild(inputEquipo); 
                    table.appendChild(tr4);
                        tr4.appendChild(td1tr4);
                        tr4.appendChild(td2tr4);
                            td2tr4.appendChild(inputDesc); 
                    table.appendChild(tr5);
                        tr5.appendChild(td1tr5);
                        tr5.appendChild(td2tr5);
                            td2tr5.appendChild(inputObs); ";
    if ($data["rolUsuario"] == "admin") {

        echo        "table.appendChild(tr1);
                        tr1.appendChild(td1tr1);
                        tr1.appendChild(td2tr1);
                            td2tr1.appendChild(inputFecha); 
                    table.appendChild(tr6);
                        tr6.appendChild(td1tr6);
                        tr6.appendChild(td2tr6);
                            td2tr6.appendChild(inputUsu); 
                    table.appendChild(tr7);
                        tr7.appendChild(td1tr7);
                        tr7.appendChild(td2tr7);
                            td2tr7.appendChild(inputPri);
                                inputPri.appendChild(op1);
                                inputPri.appendChild(op2);
                                inputPri.appendChild(op3);
                                inputPri.appendChild(op4);";

    } else {

        echo "form.appendChild(inputFecha);
            form.appendChild(inputUsu);
            form.appendChild(inputPri);";

    }
                    
    echo            "table.appendChild(tr8);
                        tr8.appendChild(td1tr8);
                        tr8.appendChild(td2tr8);
                            td2tr8.appendChild(inputEst);
                                inputEst.appendChild(op5);
                                inputEst.appendChild(op6);
                                inputEst.appendChild(op7);
                
                form.appendChild(inputId);
                form.appendChild(inputAction);
                form.appendChild(boton1);
                form.appendChild(boton2);

        }
        ";



        echo "function nuevaIncidencia() {

            var fondo = document.createElement('div');
            fondo.setAttribute('id', 'fondo');

            var div = document.createElement('div');
            div.setAttribute('id','divModificarIncidencia');";

            if ($data["rolUsuario"] == "admin") {

                echo "div.setAttribute('style','height: 470px');";

            } else {

                echo "div.setAttribute('style','height: 390px');";

            }

            echo "var span = document.createElement('span');
            span.innerHTML = 'Vas a crear una nueva incidencia:';

            var form = document.createElement('form');
            form.setAttribute('method', 'post');";

            if ($data["rolUsuario"] == "admin") {

                echo "form.setAttribute('action', 'index.php');";

            } else {

                echo "form.setAttribute('action', 'index.php');";

            }

            echo "var table = document.createElement('table');
            table.setAttribute('id', 'tablaModificar');

            var tr2 = document.createElement('tr');
            var td1tr2 = document.createElement('td');
            td1tr2.innerHTML = 'Lugar:';
            var td2tr2 = document.createElement('td');
            var inputLugar = document.createElement('input');
            inputLugar.setAttribute('type','text');
            inputLugar.setAttribute('name','lugar');

            var tr3 = document.createElement('tr');
            var td1tr3 = document.createElement('td');
            td1tr3.innerHTML = 'Equipo:';
            var td2tr3 = document.createElement('td');
            var inputEquipo = document.createElement('input');
            inputEquipo.setAttribute('type','text');
            inputEquipo.setAttribute('name','equipo');

            var tr4 = document.createElement('tr');
            var td1tr4 = document.createElement('td');
            td1tr4.innerHTML = 'Descripción:';
            var td2tr4 = document.createElement('td');
            var inputDesc = document.createElement('textarea');
            inputDesc.setAttribute('type','text');
            inputDesc.setAttribute('name','descripcion');

            var tr5 = document.createElement('tr');
            var td1tr5 = document.createElement('td');
            td1tr5.innerHTML = 'Observaciones:';
            var td2tr5 = document.createElement('td');
            var inputObs = document.createElement('textarea');
            inputObs.setAttribute('type','text');
            inputObs.setAttribute('name','observaciones');

            var inputAction = document.createElement('input');
            inputAction.setAttribute('type','hidden');
            inputAction.setAttribute('value','insertarIncidencia')
            inputAction.setAttribute('name','action');

            var inputId = document.createElement('input');
            inputId.setAttribute('type','hidden');
            inputId.setAttribute('name','id');";

            if ($data["rolUsuario"] == "admin") {

                echo "var tr1 = document.createElement('tr');
                    var td1tr1 = document.createElement('td');
                    td1tr1.innerHTML = 'Fecha y hora:';
                    var td2tr1 = document.createElement('td');
                    var inputFecha = document.createElement('input');
                    inputFecha.setAttribute('type','text');
                    inputFecha.setAttribute('name','fecha');
        
                    var tr6 = document.createElement('tr');
                    var td1tr6 = document.createElement('td');
                    td1tr6.innerHTML = 'Usuario:';
                    var td2tr6 = document.createElement('td');
                    var inputUsu = document.createElement('input');
                    inputUsu.setAttribute('type','text');
                    inputUsu.setAttribute('name','usuario');
                    inputUsu.setAttribute('value'," . $_SESSION['idUsuario'] . ");
        
                    var tr7 = document.createElement('tr');
                    var td1tr7 = document.createElement('td');
                    td1tr7.innerHTML = 'Prioridad:';
                    var td2tr7 = document.createElement('td');
                    var inputPri = document.createElement('select');
                    inputPri.setAttribute('type','text');
                    inputPri.setAttribute('name','prioridad');
        
                    op1 = document.createElement('option');
                    op1.setAttribute('selected','selected');
                    op1.setAttribute('value','MAXIMA');
                    op1.innerHTML = 'MAXIMA'
                    op2 = document.createElement('option');
                    op2.setAttribute('value','MEDIA');
                    op2.innerHTML = 'MEDIA'
                    op3 = document.createElement('option');
                    op3.setAttribute('value','BAJA');
                    op3.innerHTML = 'BAJA';
                    op4 = document.createElement('option');
                    op4.setAttribute('value','NINGUNA');
                    op4.innerHTML = 'NINGUNA';
        
                    var tr8 = document.createElement('tr');
                    var td1tr8 = document.createElement('td');
                    td1tr8.innerHTML = 'Estado:';
                    var td2tr8 = document.createElement('td');
                    var inputEst = document.createElement('select');
                    inputEst.setAttribute('type','text');
                    inputEst.setAttribute('name','estado');
        
                    op5 = document.createElement('option');
                    op5.setAttribute('selected','selected');
                    op5.setAttribute('value','ABIERTA');
                    op5.innerHTML = 'ABIERTA';
                    op6 = document.createElement('option');
                    op6.setAttribute('value','EN ESPERA');
                    op6.innerHTML = 'EN ESPERA';
                    op7 = document.createElement('option');
                    op7.setAttribute('value','CERRADA');
                    op7.innerHTML = 'CERRADA';";
                
            } else {

                echo "var inputUsu = document.createElement('input');
                    inputUsu.setAttribute('type','hidden');
                    inputUsu.setAttribute('name','usuario');
                    inputUsu.setAttribute('value'," . $_SESSION['idUsuario'] . ");

                    var inputPri = document.createElement('input');
                    inputPri.setAttribute('type','hidden');
                    inputPri.setAttribute('name','prioridad');
                    inputPri.setAttribute('value','BAJA');
                
                    var tr8 = document.createElement('tr');
                    var td1tr8 = document.createElement('td');
                    td1tr8.innerHTML = 'Estado:';
                    var td2tr8 = document.createElement('td');
                    var inputEst = document.createElement('input');
                    inputEst.setAttribute('type','hidden');
                    inputEst.setAttribute('name','estado');
                    inputEst.setAttribute('value','ABIERTA');";

            }

            echo "var boton1 = document.createElement('button');
            boton1.innerHTML = 'Guardar';
            boton1.setAttribute('id', 'botonConfirmar');
            boton1.setAttribute('style','top:80px');

            var boton2 = document.createElement('button');
            boton2.innerHTML = 'Cancelar';
            boton2.setAttribute('onclick','document.getElementById(\"fondo\").remove(); document.getElementById(\"divModificarIncidencia\").remove()');
            boton2.setAttribute('id', 'botonCancelar');
            boton2.setAttribute('style','top:80px');

            

            

            document.body.appendChild(fondo);
            document.body.appendChild(div);
            div.appendChild(span);
            div.appendChild(document.createElement('br'));
            div.appendChild(form);
                form.appendChild(table);
                    table.appendChild(tr2);
                        tr2.appendChild(td1tr2);
                        tr2.appendChild(td2tr2);
                            td2tr2.appendChild(inputLugar); 
                    table.appendChild(tr3);
                        tr3.appendChild(td1tr3);
                        tr3.appendChild(td2tr3);
                            td2tr3.appendChild(inputEquipo); 
                    table.appendChild(tr4);
                        tr4.appendChild(td1tr4);
                        tr4.appendChild(td2tr4);
                            td2tr4.appendChild(inputDesc); 
                    table.appendChild(tr5);
                        tr5.appendChild(td1tr5);
                        tr5.appendChild(td2tr5);
                            td2tr5.appendChild(inputObs); ";
    if ($data["rolUsuario"] == "admin") {

        echo        "table.appendChild(tr1);
                        tr1.appendChild(td1tr1);
                        tr1.appendChild(td2tr1);
                            td2tr1.appendChild(inputFecha); 
                    table.appendChild(tr6);
                        tr6.appendChild(td1tr6);
                        tr6.appendChild(td2tr6);
                            td2tr6.appendChild(inputUsu); 
                    table.appendChild(tr7);
                        tr7.appendChild(td1tr7);
                        tr7.appendChild(td2tr7);
                            td2tr7.appendChild(inputPri);
                                inputPri.appendChild(op1);
                                inputPri.appendChild(op2);
                                inputPri.appendChild(op3);
                                inputPri.appendChild(op4);
                    table.appendChild(tr8);
                        tr8.appendChild(td1tr8);
                        tr8.appendChild(td2tr8);
                            td2tr8.appendChild(inputEst);
                                inputEst.appendChild(op5);
                                inputEst.appendChild(op6);
                                inputEst.appendChild(op7);";

    } else {

        echo "
            form.appendChild(inputUsu);
            form.appendChild(inputPri);
            table.appendChild(tr8);
                        tr8.appendChild(td2tr8);
                            td2tr8.appendChild(inputEst);";

    }
                    
    echo            "
                
                form.appendChild(inputId);
                form.appendChild(inputAction);
                form.appendChild(boton1);
                form.appendChild(boton2);

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

