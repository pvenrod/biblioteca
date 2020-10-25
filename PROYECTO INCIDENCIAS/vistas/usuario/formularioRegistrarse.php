<form action='index.php' method='post' id='formularioIniciarSesion' style="height: 410px">
    <span>REGISTRARSE</SPAN><br>
    <input type='text' name='usuario' placeholder='Usuario' required><br>
    <input type='text' name='email' placeholder='Email' required><br>
    <input type='password' name='contrasenya1' placeholder='Contraseña' required><br>
    <input type='password' name='contrasenya2' placeholder='Repita contraseña' required><br>
    <input type='hidden' name='action' value='procesarRegistro'>
    <input type='submit' value='Registrarse'>
    <p><a href="index.php?action=mostrarFormularioIniciarSesion">¿Ya tienes una cuenta? ¡Inicia sesión!</a></p>

<?php
    if (isset($data["msjError"])) {

        echo "<p style='color: red'>" . $data["msjError"] . "</p>";

    }
?>

</form>