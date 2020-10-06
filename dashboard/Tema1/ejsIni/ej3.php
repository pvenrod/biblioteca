<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Resultado</title>
</head>
<body>
    <?php

        $num = (int) $_REQUEST["numero"];

        $contador = 1;

    ?>

        <?php 

            echo "<table border='1' cellpadding='10'>
                    <tr>
                        <td colspan='5' align='center'>
                            Tabla de multiplicar del número <strong>".$num."</strong>
                        </td>
                    </tr>";
        
            for ($i = 1; $i <= 25; $i++) {

                if ($i == 1 || $i ==  6 || $i == 11 || $i == 16 || $i == 21) {

                    echo "<tr>
                            <td>". $num . " * " . $i . " = " . $num*$i . 
                            "</td>";

                }
                else {
                    echo "<td>". $num . " * " . $i . " = " . $num*$i . 
                        "</td>";
                    if ($i == 5 || $i ==  10 || $i == 15 || $i == 20 || $i == 25) {

                        echo "</tr>";

                    }
                }
               
            }

            echo "</table>"

        ?>
    </table>
</body>
</html>