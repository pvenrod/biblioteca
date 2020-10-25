<?php 

    echo "<div class='divFondoBorrar'></div>";

    echo "<div class='formularios'>
        <h1>Formulario de inicio de sesión</h1>
        <table>
            <form action = 'index.php' method = 'post'>
                <tr>
                    <td class='tdTexto'>Usuario:</td>
                    <td width='60%'><input type='text' name='usuario' required></td>
                </tr>
                <tr>
                    <td class='tdTexto'>Contraseña:</td>
                    <td width='60%'><input type='password' name='contrasenya' required></td>
                </tr>
                <tr>
                    <td colspan='2'><input type='submit' value='Iniciar sesión' class='botonSesion iniciarSesion botonFormulario'></td>
                </tr>
                <tr style='height: 20px'></tr>";

    echo "<tr>" 

    if (isset($data['msjError'])) {

        echo "<p style='color:red'>".$data['msjError']."</p>";

    }

    if (isset($data['msjInfo'])) {

        echo "<p style='color:blue'>".$data['msjInfo']."</p>";

    }

    echo "</tr>";

    echo "<tr style='height: 10px'></tr>
            <tr>
                <td colspan='2'>¿No tienes una cuenta? <a href='index.php?action=formularioRegistrarse'>¡Regístrate!</a> </td>
            </tr>
            <input type='hidden' name='action' value='iniciarSesion'>
        </form>
    </table>
</div>";
