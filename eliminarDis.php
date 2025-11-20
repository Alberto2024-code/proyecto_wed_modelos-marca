<?php
require_once "conexion.php";


if (!isset($_GET['id'])) {
    die("Error: No se recibió el ID del dispositivo.");
}

$id = intval($_GET['id']);


$consulta = $conexion->query("SELECT * FROM dispositivos WHERE idDispositivo = $id");

if ($consulta->num_rows == 0) {
    die("Error: El dispositivo no existe.");
}


$conexion->query("DELETE FROM dispositivos WHERE idDispositivo = $id");


header("Location: Dispositivos.php");
exit();
?>
