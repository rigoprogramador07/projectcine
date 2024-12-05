<?php
session_start();
require 'bd/conexion_bd.php';
$obj = new BD_PDO();

if(isset($_POST['verificar_respuesta'])) {
    // Verificar si la respuesta es correcta
    $respuesta = $_POST['respuesta'];
    $correo = $_SESSION['correo'];

    $result = $obj->Ejecutar_Instruccion_parametros("SELECT contrasena FROM usuarios WHERE correo=? AND respuesta_seguridad=?", [$correo, $respuesta]);
    if ($result && count($result) > 0) {
        // Permitir al usuario restablecer la contraseña
        echo "<p style='color: #FFA500;'>Verificación exitosa. Por favor, ingresa tu nueva contraseña.</p>";
        // Formulario para ingresar nueva contraseña
        echo '<form action="actualizar_contrasena.php" method="post">';
        echo '<input type="hidden" name="correo" value="' . $correo . '">';
        echo '<div class="form-group">';
        echo '<label for="nueva_contrasena">Nueva Contraseña:</label>';
        echo '<input type="password" class="form-control rounded" id="nueva_contrasena" name="nueva_contrasena" required>';
        echo '</div>';
        // Agregar campo para confirmar contraseña
        echo '<div class="form-group mt-3">';
        echo '<label for="confirmar_contrasena">Confirmar Contraseña:</label>';
        echo '<input type="password" class="form-control rounded" id="confirmar_contrasena" name="confirmar_contrasena" required>';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary mt-3" name="restablecer_contrasena">Restablecer Contraseña</button>';
        echo '</form>';
    } else {
        // Si la respuesta es incorrecta, mostrar mensaje de error y permanecer en la misma página
        echo "<p style='color: #FFA500;'>La respuesta ingresada es incorrecta. Por favor, intenta de nuevo.</p>";
    }
}
 elseif (isset($_POST['restablecer_contrasena'])) {
    // Verificar si las contraseñas coinciden
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    if($nueva_contrasena === $confirmar_contrasena) {
        // Verificar si el correo está definido
        if (isset($_SESSION['correo'])) {
            $correo = $_SESSION['correo'];

            // Actualizar la contraseña del usuario en la base de datos
            $result = $obj->Ejecutar_Instruccion_parametros("UPDATE usuarios SET contrasena=? WHERE correo=?", [$nueva_contrasena, $correo]);

            // Verificar si la actualización fue exitosa
            if ($result && $result->rowCount() > 0) {
                // Mensaje de JavaScript y redirección si la contraseña se actualiza correctamente
                echo "<script>alert('¡Contraseña actualizada correctamente!'); window.location.href = 'index.php';</script>";
                exit; // Detener la ejecución del script después de la redirección
            } else {
                echo "<p style='color: red;'>¡Hubo un error al actualizar la contraseña!</p>";
                // Mensaje de depuración para identificar problemas
                // echo "<p>" . print_r($obj->errorInfo(), true) . "</p>";
            }
        } else {
            echo "<p style='color: red;'>Error: Sesión no iniciada. Por favor, intenta recuperar tu contraseña nuevamente.</p>";
        }
    } else {
        echo "<p style='color: red;'>Error: Las contraseñas no coinciden. Por favor, inténtalo de nuevo.</p>";
    }
}
?>

<form id="update-password-form" action="actualizar_contrasena.php" method="post">
    <div class="form-group">
        <label for="respuesta">Respuesta de seguridad:</label>
        <input type="text" class="form-control" id="respuesta" name="respuesta" required>
    </div>
    <button type="submit" class="btn btn-primary" name="verificar_respuesta">Verificar Respuesta</button>
</form>
