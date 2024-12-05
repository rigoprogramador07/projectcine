<?php
session_start();
require 'bd/conexion_bd.php';
$obj = new BD_PDO();

if(isset($_POST['recuperar_contrasena'])) {
    $correo = $_POST['correo'];

    // Verificar si el correo electrónico existe en la base de datos
    $result = $obj->Ejecutar_Instruccion_parametros("SELECT pregunta_seguridad FROM usuarios WHERE correo=?", [$correo]);
    if ($result && count($result) > 0) {
        // Mostrar la pregunta de seguridad
        $pregunta_seguridad = $result[0]['pregunta_seguridad'];
        $_SESSION['correo'] = $correo;
        // Redirigir a la página de restablecer contraseña
        header("Location: restablecer_contrasena.php");
        exit;
    } else {
        echo "<p style='color: #FFA500;'>El correo electrónico ingresado no está registrado.</p>";
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
        <h1>Recuperar contraseña</h1>
        <form action="" method="post">
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <button type="submit" name="recuperar_contrasena">Recuperar contraseña</button>
        </form>

        <?php if(isset($pregunta_seguridad)): ?>
            <form action="restablecer_contrasena.php" method="post">
                <input type="hidden" name="correo" value="<?php echo $correo; ?>">
                <p style="color: #FFA500;">Pregunta de seguridad: <?php echo $pregunta_seguridad; ?></p>
                <input type="text" name="respuesta" placeholder="Respuesta" required>
                <button type="submit" name="verificar_respuesta">Verificar respuesta</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
