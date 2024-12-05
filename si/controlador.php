<?php
error_reporting(1);
session_start();
require 'bd/conexion_bd.php';
$obj = new BD_PDO();

// Registro
if (isset($_POST['btnregistrar'])) {  
    $correo = $_POST['correo'];
    // Verificar si el correo ya está registrado
    $sql = $obj->Ejecutar_Instruccion_parametros("SELECT * FROM usuarios WHERE correo=?", [$correo]);
    if ($sql && count($sql) > 0) {
        echo "<script>
            alert('El correo que ingresó ya existe, intenta uno nuevo');
            window.location= 'index.php';
        </script>";
    } else {
        // Filtrar y sanitizar los datos del formulario
        $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
        $contrasena = $_POST['contrasena']; // No se hashea la contraseña
        $pregunta = $_POST['pregunta']; // Pregunta de seguridad
        $respuesta = $_POST['respuesta']; // Respuesta de seguridad

        // Insertar el nuevo usuario en la base de datos
        $result = $obj->Ejecutar_Instruccion_parametros("INSERT INTO usuarios (correo, contrasena, pregunta_seguridad, respuesta_seguridad) VALUES (?, ?, ?, ?)", [$correo, $contrasena, $pregunta, $respuesta]);
        if (!$result) {
            echo "<script>
                alert('Error al registrar el usuario');
                window.location= 'index.php';
            </script>";
            exit; // Detiene la ejecución si hay un error
        }
        
        echo "<script>
            alert('Se registró correctamente, bienvenido');
            window.location= 'inicio.php';
        </script>";
    }
}  

// Iniciar sesión
if (isset($_POST['iniciar'])) {
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $contrasena = $_POST['contrasena']; // No se aplica filtrado ya que se comparará directamente con la contraseña en la base de datos

    $usuarios = $obj->Ejecutar_Instruccion_parametros("SELECT * FROM usuarios WHERE correo=?", [$correo]);

    if ($usuarios && count($usuarios) > 0 && $contrasena === $usuarios[0][2]) { // Comparar la contraseña directamente
        $_SESSION['correo'] = $correo;
        
        echo "<script>
            alert('¡Bienvenido ".$_SESSION['correo']."!');
            window.location= 'inicio.php';
        </script>";
    } else {
        echo "<script>
            alert('La contraseña es incorrecta o el usuario no existe');
            window.location= 'index.php';
        </script>";
    }
}
?>
