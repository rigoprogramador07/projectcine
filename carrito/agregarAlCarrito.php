<?php
session_start(); // Inicia la sesión antes de intentar acceder a $_SESSION

if (!isset($_POST["codigo"])) {
    return;
}
 
$codigo = $_POST["codigo"];
include_once "../bd/base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE nombre  = ? LIMIT 1;");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ./vender.php?status=4");
    exit;
}
# Si no hay existencia...
if ($producto->existencia < 1) {
    header("Location: ./vender.php?status=5");
    exit;
}

# Inicializa $_SESSION['carrito'] si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

# Buscar producto dentro del carrito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->codigo === $codigo) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->cantidad = 1;
    $producto->total = $producto->precioVenta;
    array_push($_SESSION["carrito"], $producto);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + 1 > $producto->existencia) {
        header("Location: ./vender.php?status=5");
        exit;
    }
    $_SESSION["carrito"][$indice]->cantidad++;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precioVenta;
}
header("Location: ./vender.php");
?>
