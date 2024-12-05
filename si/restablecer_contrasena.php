<?php
session_start();
require 'bd/conexion_bd.php';
$obj = new BD_PDO();

if(isset($_POST['recuperar_contrasena'])) {
    $correo = $_POST['correo'];

    // Verificar si el correo electrónico existe en la base de datos
    $result = $obj->Ejecutar_Instruccion_parametros("SELECT pregunta_seguridad FROM usuarios WHERE correo=?", [$correo]);
    if ($result && count($result) > 0) {
        // Almacenar la pregunta de seguridad en la sesión
        $_SESSION['pregunta_seguridad'] = $result[0]['pregunta_seguridad'];
        $_SESSION['correo'] = $correo;
        // Redirigir a la página de restablecer contraseña
        header("Location: restablecer_contrasena.php");
        exit;
    } else {
        echo "<p style='color: #FFA500;'>El correo electrónico ingresado no está registrado.</p>";
    }
}

if(isset($_POST['verificar_respuesta'])) {
    $respuesta = $_POST['respuesta'];
    $correo = $_SESSION['correo'];

    // Verificar si la respuesta es correcta
    $result = $obj->Ejecutar_Instruccion_parametros("SELECT contrasena FROM usuarios WHERE correo=? AND respuesta_seguridad=?", [$correo, $respuesta]);
    if ($result && count($result) > 0) {
        // Permitir al usuario restablecer la contraseña
        echo "<p style='color: #FFA500;'>Verificación exitosa. Por favor, ingresa tu nueva contraseña.</p>";
        // Mostrar formulario para ingresar nueva contraseña
        $mostrar_formulario_nueva_contrasena = true;
    } else {
        // Si la respuesta es incorrecta, mostrar mensaje de error y permanecer en la misma página
        echo "<p style='color: #FFA500;'>La respuesta ingresada es incorrecta. Por favor, intenta de nuevo.</p>";
    }
}

if(isset($_POST['restablecer_contrasena'])) {
    // Procesar el restablecimiento de la contraseña
    $correo = $_SESSION['correo'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Verificar si las contraseñas coinciden
    if ($nueva_contrasena === $confirmar_contrasena) {
        // Actualizar la contraseña en la base de datos
        $obj->Ejecutar_Instruccion_parametros("UPDATE usuarios SET contrasena = ? WHERE correo = ?", [$nueva_contrasena, $correo]);
        // Informar al usuario sobre el éxito del restablecimiento de la contraseña
        echo "<p style='color: #FFA500;'>La contraseña se ha restablecido correctamente.</p>";
        // Eliminar las variables de sesión utilizadas para el proceso de restablecimiento de contraseña
        unset($_SESSION['pregunta_seguridad']);
        unset($_SESSION['correo']);
        // Redirigir al usuario al índice
        header("Location: index.php?contrasena_actualizada=true");
        exit;
    } else {
        // Si las contraseñas no coinciden, mostrar un mensaje de error
        echo "<p style='color: #FFA500;'>Las contraseñas no coinciden. Por favor, inténtalo de nuevo.</p>";
        // Volver a mostrar el formulario para ingresar nueva contraseña
        $mostrar_formulario_nueva_contrasena = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #FFA500;
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        input[type="email"],
        input[type="text"],
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #FFA500;
            color: #fff;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #FF8C00;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if(!isset($_SESSION['correo']) || (isset($_SESSION['correo']) && !isset($_POST['verificar_respuesta']) && !isset($_POST['restablecer_contrasena']))): ?>
            <!-- Formulario para recuperar contraseña -->
            <h1>Pregunta de Seguridad</h1>
            <form action="" method="post">
                <?php if(isset($_SESSION['pregunta_seguridad'])): ?>
                    <h2><?php echo $_SESSION['pregunta_seguridad']; ?></h2>
                    <input type="hidden" name="pregunta" value="<?php echo $_SESSION['pregunta_seguridad']; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="respuesta">Respuesta de seguridad:</label>
                    <input type="text" class="form-control" id="respuesta" name="respuesta" required>
                </div>
                <button type="submit" class="btn btn-primary" name="verificar_respuesta">Verificar Respuesta</button>
            </form>
        <?php endif; ?>
        <?php if(isset($mostrar_formulario_nueva_contrasena)): ?>
            <!-- Formulario para ingresar nueva contraseña -->
            <h1>Nueva Contraseña</h1>
            <form action="" method="post">
                <input type="hidden" name="correo" value="<?php echo $_SESSION['correo']; ?>">
                <div class="form-group">
                    <label for="nueva_contrasena">Nueva Contraseña:</label>
                    <input type="password" class="form-control" id="nueva_contrasena" name="nueva_contrasena" required>
                </div>
                <div class="form-group">
                    <label for="confirmar_contrasena">Confirmar Contraseña:</label>
                    <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" required>
                </div>
                <button type="submit" class="btn btn-primary" name="restablecer_contrasena">Restablecer Contraseña</button>
            </form>
        <?php endif; ?>
    </div>

    <!-- Script de la alerta de contraseña actualizada -->
    <?php if(isset($_GET['contrasena_actualizada']) && $_GET['contrasena_actualizada'] === 'true'): ?>
    <script>
        alert('La contraseña se ha actualizado correctamente.');
    </script>
    <?php endif; ?>
</body>
</html>
