<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../bd/base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM ventas WHERE id = ?;");
$resultado = $sentencia->execute([$id]);
if($resultado === TRUE){
	header("Location: ../listados/ventas contado.php");
	exit;
}
else echo "Algo salió mal";
?>