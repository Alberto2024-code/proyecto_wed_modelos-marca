<?php
require_once "conexion.php";

if (isset($_POST["guardar"])) {
    $tipo = $_POST["tipoDispositivo"];

    if (!empty($tipo)) {
        $conexion->query("INSERT INTO tipodispositivo (tipoDispositivo) 
                          VALUES ('$tipo')");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Dispositivo</title>
     <link rel="stylesheet" href="dispositivos.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="img/3a9737f7-0db2-4014-9c08-de5db4e5a5f5.jpg" alt="Logo" />
    </div>

    <h1>REGISTRAR DISPOSITIVO</h1>

    <nav>
        <a href="Mapa_de_sitio.php">MAPA DE SITIO</a>
        <a href="Modelo.php">MODELO</a>
        <a href="Dispositivos.php">DISPOSITIVOS</a>
        <a href="Usuarios">USUARIOS</a>
        <a href="Menu.php">MENU PRINCIPAL</a>
        <a href="Dispositivos.php">dis</a>
        <a href="RegistroDisp.php">registro</a>
    </nav>
</header>
<h2>Formulario de Registro</h2>

<form method="POST">
    <label>Tipo de dispositivo:</label>
    <input type="text" 
           name="tipoDispositivo" 
           placeholder="Ingresa el tipo de dispositivo" 
           required>

    <button type="submit" name="guardar">Guardar</button>
    <button type="reset">Cancelar</button>
</form>

<footer>
        <p>Derechos de autor @2025 mantenimiento de computo todos los de rechos reservados</p>
        
</footer>

</body>
</html>

