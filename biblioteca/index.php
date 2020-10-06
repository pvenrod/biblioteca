<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="estilos.css">
  </head>
  <body>
    <?php
    if (!isset($_REQUEST["action"])) {
        $db = new mysqli("localhost","root","","biblioteca");
            $consulta = $db->query("SELECT libros.idLibro as idLibro,titulo,genero,pais,anyo,numPaginas,nombre,apellidos
                                    FROM libros
                                    INNER JOIN escriben
                                        ON libros.idLibro = escriben.idLibro
                                    INNER JOIN personas
                                        ON escriben.idPersona = personas.idPersona
                                    ORDER BY libros.idLibro ASC");

            if ($consulta->num_rows > 0) {

                echo "<table class='tablaResultados'>
                        <tr>
                            <th colspan='9'>
                                LIBROS GUARDADOS
                            </th>
                        </tr>
                        <tr style='height: 10px'></tr>
                        <tr class='filaArriba'>
                            <td>ID</td>
                            <td>Título</td>
                            <td>Género</td>
                            <td>País</td>
                            <td>Año</td>
                            <td>Páginas</td>
                            <td>Escritor/a</td>
                        </tr>
                        <tr style='height: 5px'></tr>";

                while ($fila = $consulta->fetch_object()) {
                    echo "<tr><td>" . $fila->idLibro . "</td><td>" . $fila->titulo . "</td><td>" . $fila->genero . 
                        "</td><td>" . $fila->pais . "</td><td>" . $fila->anyo . "</td><td>" . $fila->numPaginas . 
                        "</td><td>" . $fila->nombre . " " . $fila->apellidos . "</td><td><a class='eliminar' onclick='borrar($fila->idLibro)'>Eliminar</a></td>\n
                        <td><a class='modificar' onclick='modificar($fila->idLibro)'>Modificar</a></td></tr>";
                }

                echo "</table>";
            }
            else {
                echo "Ha ocurrido un error. Inténtelo de nuevo más tarde.";
            }
    }
    else {

        switch($_REQUEST["action"]) {

        case "consultarLista":
        
            
        break;

        case "formularioAltaLibros":
            echo "<button class='volverAtras' onclick='location.href=\"index.php\"'>Menú principal</button>";
            
            echo "<div class='menu'>
                    <h1>Formulario de alta de libros</h1>
                    <form action = 'index.php' method = 'get'>
                        <table>
                            <tr>
                                <td>Título</td>
                                <td width='30%'><input type='text' name='titulo'></td>
                            </tr>
                            <tr>
                                <td>Género</td>
                                <td><input type='text' name='genero'></td>
                            </tr>
                            <tr>
                                <td>País</td>
                                <td><input type='text' name='pais'></td>
                            </tr>
                            <tr>
                                <td>Año</td>
                                <td><input type='text' name='anyo'></td>
                            </tr>
                            <tr>
                                <td>Número de páginas</td>
                                <td><input type='text' name='numPaginas'></td>
                            </tr>
                            <tr>
                                <td>ID escritor/a</td>
                                <td><input type='text' name='idEscritor'></td>
                            </tr>
                            <tr style='height: 20px'></tr>
                            <tr>
                                <td colspan='2'>
                                    <input type='submit' value='Guardar libro'>    
                                </td>
                            </tr>
                        </table>
                        <input type='hidden' name='action' value='insertarLibro'>
                    </form>
                </div>";
            break;

        case "insertarLibro":
            $titulo = $_REQUEST["titulo"];
            $genero = $_REQUEST["genero"];
            $pais = $_REQUEST["pais"];
            $anyo = $_REQUEST["anyo"];
            $numPaginas = $_REQUEST["numPaginas"];
            $idEscritor = $_REQUEST["idEscritor"];
            $idLibro;
            
            $db = new mysqli("localhost","root","","biblioteca");

            $consulta0 = $db->query("SELECT max(idLibro) + 1 as 'id'
                                    FROM libros");
            while ($fila = $consulta0->fetch_object()) {
                $idLibro = $fila->id;
            }

            $consulta1 = $db->query("INSERT INTO libros
                                    VALUES ('$idLibro','$titulo','$genero','$pais','$anyo','$numPaginas')");

            $consulta2 = $db->query("INSERT INTO escriben
                                    VALUES ('$idLibro', '$idEscritor')");

            header('Location: index.php?action=exito');

            break;

            case "formularioBajaLibros":
                echo "<button class='volverAtras' onclick='location.href=\"index.php\"'>Menú principal</button>";
                
                echo "<div class='menu'>
                        <h1>Formulario de baja de libros</h1>
                        <form action = 'index.php' method = 'get'>
                            <table>
                                <tr>
                                    <td width='50%'>ID del libro</td>
                                    <td><input type='text' name='idLibro'></td>
                                </tr>
                                <tr style='height: 20px'></tr>
                                <tr>
                                    <td colspan='2'>
                                        <input type='submit' value='Eliminar libro'>    
                                    </td>
                                </tr>
                            </table>
                            <input type='hidden' name='action' value='eliminarLibro'>
                        </form>
                    </div>";
                break;
            
            case "eliminarLibro":
                $idLibro = $_REQUEST["idLibro"];
                
                $db = new mysqli("localhost","root","","biblioteca");

                $consulta0 = $db->query("DELETE FROM libros
                                        WHERE idLibro = $idLibro");
                
                $consulta1 = $db->query("DELETE FROM escriben
                                        WHERE idLibro = $idLibro");

                header('Location: index.php');
            break;

            case "formularioModificar1":
                echo "<button class='volverAtras' onclick='location.href=\"index.php\"'>Menú principal</button>";
                
                echo "<div class='menu'>
                        <h1>Formulario de modificación</h1>
                        <form action = 'index.php' method = 'get'>
                            <table>
                                <tr>
                                    <td width='50%'>ID del libro a modificar</td>
                                    <td><input type='text' name='idLibro'></td>
                                </tr>
                                <tr style='height: 20px'></tr>
                                <tr>
                                    <td colspan='2'>
                                        <input type='submit' value='Eliminar libro'>    
                                    </td>
                                </tr>
                            </table>
                            <input type='hidden' name='action' value='formularioModificar2'>
                        </form>
                    </div>";
                break;

                case "formularioModificar2":

                    echo "<button class='volverAtras' onclick='location.href=\"index.php\"'>Menú principal</button>";

                    $idLibro = $_REQUEST["idLibro"];

                    $db = new mysqli("localhost","root","","biblioteca");

                    $consulta0 = $db->query("SELECT idPersona, titulo, genero, pais, anyo, numPaginas
                                            FROM libros
                                            INNER JOIN escriben
                                                ON libros.idLibro = escriben.idLibro
                                            WHERE libros.idLibro = $idLibro");
                    while ($fila = $consulta0->fetch_object()) {
                        echo "<div class='menu'>
                            <h1>Formulario de modificación</h1>
                            <form action = 'index.php' method = 'get'>
                                <table>
                                    <tr>
                                        <td>Título</td>
                                        <td width='30%'><input type='text' name='titulo' value='$fila->titulo'></td>
                                    </tr>
                                    <tr>
                                        <td>Género</td>
                                        <td><input type='text' name='genero' value='$fila->genero'></td>
                                    </tr>
                                    <tr>
                                        <td>País</td>
                                        <td><input type='text' name='pais' value='$fila->pais'></td>
                                    </tr>
                                    <tr>
                                        <td>Año</td>
                                        <td><input type='text' name='anyo' value='$fila->anyo'></td>
                                    </tr>
                                    <tr>
                                        <td>Número de páginas</td>
                                        <td><input type='text' name='numPaginas' value='$fila->numPaginas'></td>
                                    </tr>
                                    <tr>
                                        <td>ID escritor/a</td>
                                        <td><input type='text' name='idEscritor' value='$fila->idPersona'></td>
                                    </tr>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <td colspan='2'>
                                            <input type='submit' value='Guardar libro'>    
                                        </td>
                                    </tr>
                                </table>
                                <input type='hidden' name='action' value='modificarLibro'>
                                <input type='hidden' name='idLibro' value='$idLibro'>
                            </form>
                        </div>";
                    }
                    
                    break;

                    case "modificarLibro":
                        $titulo = $_REQUEST["titulo"];
                        $genero = $_REQUEST["genero"];
                        $pais = $_REQUEST["pais"];
                        $anyo = $_REQUEST["anyo"];
                        $numPaginas = $_REQUEST["numPaginas"];
                        $idEscritor = $_REQUEST["idEscritor"];
                        $idLibro = $_REQUEST["idLibro"];
                        
                        $db = new mysqli("localhost","root","","biblioteca");
            
                        $consulta1 = $db->query("UPDATE libros
                                                SET 
                                                    titulo = '$titulo',
                                                    genero = '$genero',
                                                    pais = '$pais',
                                                    anyo = '$anyo',
                                                    numPaginas = '$numPaginas'
                                                WHERE idLibro = $idLibro");
                        
                        $consulta2 = $db->query("UPDATE escriben
                                                SET idPersona = '$idEscritor'
                                                WHERE idLibro = $idLibro");
            
                        header('Location: index.php?action=exito');
            
                        break;

        case "formularioBuscarLibro":

            echo "<button class='volverAtras' onclick='location.href=\"index.php\"'>Menú principal</button>";
                
            echo "<div class='menu'>
                    <h1>Formulario de búsqueda</h1>
                    <form action = 'index.php' method = 'get'>
                        <table>
                            <tr>
                                <td width='50%'>Título (o parte del título) del libro</td>
                                <td><input type='text' name='titulo'></td>
                            </tr>
                            <tr style='height: 20px'></tr>
                            <tr>
                                <td colspan='2'>
                                    <input type='submit' value='Buscar libro(s)'>    
                                </td>
                            </tr>
                        </table>
                        <input type='hidden' name='action' value='buscarLibros'>
                    </form>
                </div>";
            break;

            case "buscarLibros":
                $titulo = $_REQUEST["titulo"];

                $db = new mysqli("localhost","root","","biblioteca");
                $consulta = $db->query("SELECT libros.idLibro as idLibro,titulo,genero,pais,anyo,numPaginas,nombre,apellidos
                                        FROM libros
                                        INNER JOIN escriben
                                            ON libros.idLibro = escriben.idLibro
                                        INNER JOIN personas
                                            ON escriben.idPersona = personas.idPersona
                                        WHERE titulo LIKE '%$titulo%'
                                        ORDER BY libros.idLibro ASC");
    
                if ($consulta->num_rows > 0) {
    
                    echo "<button class='volverAtras' onclick='location.href=\"index.php\"'>Menú principal</button>";
    
                    echo "<table class='tablaResultados'>
                            <tr>
                                <th colspan='7'>
                                    RESULTADO DE LA BÚSQUEDA
                                </th>
                            </tr>
                            <tr style='height: 10px'></tr>
                            <tr class='filaArriba'>
                                <td>ID</td>
                                <td>Título</td>
                                <td>Género</td>
                                <td>País</td>
                                <td>Año</td>
                                <td>Páginas</td>
                                <td>Escritor/a</td>
                            </tr>
                            <tr style='height: 5px'></tr>";
    
                    while ($fila = $consulta->fetch_object()) {
                        echo "<tr><td>" . $fila->idLibro . "</td><td>" . $fila->titulo . "</td><td>" . $fila->genero . "</td><td>" . $fila->pais . "</td><td>" . $fila->anyo . "</td><td>" . $fila->numPaginas . "</td><td>" . $fila->nombre . " " . $fila->apellidos . "</td></tr>";
                    }
    
                    echo "</table>";
                }
                else {
                    header('Location: index.php?action=sinResultados');
                }
            break;
        
        case "exito":
            echo "<button class='volverAtras' onclick='location.href=\"index.php\"'>Menú principal</button>";

            echo "<div class='exito'>
                Operación realizada con éxito
            </div>";
        break;

        case "sinResultados":
            echo "<button class='volverAtras' onclick='location.href=\"index.php\"'>Menú principal</button>";

            echo "<div class='exito'>
                No se ha encontrado ningún libro con ese título.
            </div>";
        break;


        default: echo "Error 404: página no encontrada";
            break;
        } // switch

        
    } // else

    ?>

  </body>
  <script>
      function borrar(idLibro) {
          if (confirm("¿Estás seguro?")) {
              location.href = "index.php?action=eliminarLibro&idLibro=" + idLibro;
          }
      }

      function modificar(idLibro) {
          location.href = "index.php?action=formularioModificar2&idLibro=" + idLibro;
      }
</script>   
</html>

