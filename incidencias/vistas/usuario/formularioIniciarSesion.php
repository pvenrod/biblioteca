<form action='index.php' method='post' id='formularioIniciarSesion'>
    <span>INICIAR SESIÓN</SPAN><br>
    <input type='text' name='usuario' placeholder='Usuario' required><br>
    <input type='password' name='contrasenya' placeholder='Contraseña' required><br>
    <input type='hidden' name='action' value='procesarLogin'>
    <input type='submit' value='Iniciar sesión'>
    <p><a href="index.php?action=mostrarFormularioRegistrarse">¿No tienes una cuenta? ¡Regístrate!</a></p>

<?php
    if (isset($data["msjError"])) {

        echo "<p style='color: red'>" . $data["msjError"] . "</p>";

    }

    if (isset($data["msjInfo"])) {

        echo "<p style='color: blue'>" . $data["msjError"] . "</p>";

    }
?>

</form>