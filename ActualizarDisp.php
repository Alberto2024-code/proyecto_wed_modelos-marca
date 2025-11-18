<?php
require_once "conexion.php";


if (!isset($_GET['id'])) {
    die("Error: No se recibió ID.");
}

$id = $_GET['id'];


$sql = $conexion->query("SELECT * FROM tipodispositivo WHERE idTipoDispositivo = $id");

if ($sql->num_rows == 0) {
    die("Error: El dispositivo no existe.");
}

$datos = $sql->fetch_assoc();


if (isset($_POST["editar"])) {

    $tipoDispositivo = $_POST["tipoDispositivo"];

    if (!empty($tipoDispositivo)) {

        $conexion->query("
            UPDATE tipodispositivo 
            SET tipoDispositivo = '$tipoDispositivo'
            WHERE idTipoDispositivo = $id
        ");

        header("Location: RegistroDisp.php"); // Regresar a la lista
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dispositivos Registrados</title>
    <link rel="stylesheet" href="dispositivos.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="img/3a9737f7-0db2-4014-9c08-de5db4e5a5f5.jpg" alt="Logo" />
    </div>

    <h1>DISPOSITIVOS REGISTRADOS</h1>

    <nav>
        <a href="Mapa_de_sitio.php">MAPA DE SITIO</a>
        <a href="Modelo.php">MODELO</a>
        <a href="Dispositivos.php">DISPOSITIVOS</a>
        <a href="Usuarios">USUARIOS</a>
        <a href="Menu.php">MENU PRINCIPAL</a>
        <a href="Dispositivos.php">dis</a>
    </nav>
</header>

<h2>Lista de dispositivos</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $datos['idTipoDispositivo'] ?>">

    <label>Tipo de dispositivo:</label>
    <input type="text" name="tipoDispositivo" value="<?= $datos['tipoDispositivo'] ?>" required>

    <button type="submit" name="editar">Actualizar</button>
    <a href="RegistroDisp.php">Cancelar</a>
</form>

<footer>
        <p>Derechos de autor @2025 mantenimiento de computo todos los de rechos reservados</p>
        
</footer>
</body>
</html>

