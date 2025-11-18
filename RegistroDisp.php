<?php
require_once "conexion.php";

$resultado = $conexion->query("SELECT * FROM tipodispositivo");

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

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Dispositivo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $fila['idTipoDispositivo'] ?></td>
                <td><?= $fila['tipoDispositivo'] ?></td>
                <td>
                    <a href="ActualizarDisp.php?id=<?= $fila['idTipoDispositivo'] ?>">Actualizar</a>
                    <a href="?id=<?= $fila['idTipoDispositivo'] ?>" onclick="return confirm('¿Eliminar dispositivo?')">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>

</table>
<footer>
        <p>Derechos de autor @2025 mantenimiento de computo todos los de rechos reservados</p>
        
</footer>
</body>
</html>
