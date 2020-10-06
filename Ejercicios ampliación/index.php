<?php


    if (!isset($_REQUEST["numero"])) {

        if (isset($_REQUEST["numsecreto"])) {

            $numsecreto = $_REQUEST["numsecreto"];
		    $intentos = $_REQUEST["intentos"];

        } else {

            $numsecreto = rand(1,100);
		$intentos = 0;

        }

        //echo "Mi numero secreto es: $numsecreto<br>";

        

        echo'<form action="index.php" method="post">

                Escribe tu numero:

                <input type="text" name="numero">

		<input type="hidden" name="intentos" value="'.$intentos.'">

                <input type="hidden" name="numsecreto" value="'.$numsecreto.'">

                <input type="submit">

             </form>';

    }

    else {

        $num = $_REQUEST["numero"];

        $numsec = $_REQUEST["numsecreto"];

	$intentos = $_REQUEST["intentos"] + 1;


        echo "Tu numero es: ".$num."<br>";

        //echo "Mi numero secreto es: $numsec<br>";

        if ($numsec > $num) {

            echo "Mi numero es mayor. <a href='index.php?numsecreto=$numsec&intentos=$intentos'>Prueba otra vez</a>";

        }

        else if ($numsec < $num) {

            echo "Mi numero es menor. <a href='index.php?numsecreto=$numsec&intentos=$intentos'>Prueba otra vez</a>";

        }

        else {

            echo "ENHORABUENA, HAS ACERTADO (has necesitado " . $intentos . " intentos.)";

        }

            

    }
