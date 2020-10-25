</body>
  <script>

      function borrar(idLibro, tituloLibro) {

            var divFondo = document.createElement("div");
            divFondo.setAttribute("class","divFondoBorrar");
            divFondo.setAttribute("id","divFondo")

            var div = document.createElement("div");
            div.setAttribute("class","divBorrar");
            div.setAttribute("id","div");

            var tabla = document.createElement("table");
            tabla.setAttribute("class","tablaBorrar");

            var tr1 = document.createElement("tr");

            var td1 = document.createElement("td");
            td1.setAttribute("colspan","2");

            var span1 = document.createElement("span");
            span1.setAttribute("class","spanBorrarAlerta");
            span1.innerHTML = '¡ATENCIÓN!';
        
            var tr2 = document.createElement("tr");

            var td2 = document.createElement("td");
            td2.setAttribute("colspan","2");

            var span2 = document.createElement("span");
            span2.setAttribute("class","spanBorrarMensaje");
            span2.innerHTML = "¿Estás seguro de que deseas borrar el libro '<strong>" + tituloLibro + "</strong>'?";

            var tr3 = document.createElement("tr");

            var td3 = document.createElement("td");
            
            var button1 = document.createElement("button");
            button1.setAttribute("class","botonBorrar");
            button1.setAttribute("onclick","location.href = 'index.php?action=eliminarLibro&idLibro=" + idLibro + "'");
            button1.innerHTML = "Confirmar";

            var td4 = document.createElement("td");

            var button2 = document.createElement("button");
            button2.setAttribute("class","botonCancelar");
            button2.setAttribute("onclick","cancelar()")
            button2.innerHTML = "Cancelar";

            document.body.appendChild(divFondo);
            document.body.appendChild(div);
            div.appendChild(tabla);
            tabla.appendChild(tr1);
            tr1.appendChild(td1);
            td1.appendChild(span1);
            tabla.appendChild(tr2);
            tr2.appendChild(td2);
            td2.appendChild(span2);
            tabla.appendChild(tr3);
            tr3.appendChild(td3);
            td3.appendChild(button1);
            tr3.appendChild(td4);
            td4.appendChild(button2);
            
        }



        function cancelar() {

            document.getElementById("divFondo").remove();
            document.getElementById("div").remove();

        }



        function modificar(idLibro) {

            location.href = "index.php?action=formularioModificar&idLibro=" + idLibro;

        }



        function volver() {

            location.href = "index.php";

        }


        
        function nuevoEscritor() {

            var tr = document.getElementById("trNuevoEscritor");
            var boton = document.getElementById("botonNuevoEscritor");

            tr.style.visibility = "visible";
            boton.removeAttribute("onclick");
            boton.style.cursor = "not-allowed";
            boton.style.backgroundColor = "grey";

        }

</script>   
</html>