<?php
require_once "conexion.php"; // Conexión a la base de datos

/* ----------------------- GUARDAR MODELO ----------------------- */
if (isset($_POST["guardar"])) {
    $nombreModelo = $_POST["modelo"];
    $idMarca = $_POST["marca"];

    if (!empty($nombreModelo) && !empty($idMarca)) {
        $conexion->query("INSERT INTO modelos (modelos, idMarca) VALUES ('$nombreModelo', '$idMarca')");
    }
}

/* ----------------------- CONSULTAR MODELOS ----------------------- */
$sql = "
    SELECT 
        modelos.idModelo, 
        modelos.modelos AS nombreModelo, 
        marca.marcas AS nombreMarca
    FROM modelos
    LEFT JOIN marca ON modelos.idMarca = marca.idMarcas
";
$resultado = $conexion->query($sql);

/* ----------------------- CONSULTAR MARCAS ----------------------- */
$marcas = $conexion->query("SELECT idMarcas, marcas FROM marca");

/* ----------------------- ELIMINAR MODELO ----------------------- */
if (isset($_GET["eliminar"])) {
    $id = $_GET["eliminar"];
    $conexion->query("DELETE FROM modelos WHERE idModelo = $id");
    header("Location: Modelos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Modelos</title>
    <link rel="stylesheet" href="Marca.css">
</head>
<body>

<!-- HEADER -->
<header>
    <div class="logo">
            <img src="img/3a9737f7-0db2-4014-9c08-de5db4e5a5f5.jpg" alt="Logo" />
        </div>

        <h1>Registrar Modelo</h1>

        <nav>
            <a href="index.php">Inicio</a>
            <a href="Marca.php">Marcas</a>
            <a href="#">Historial</a>
        </nav>
    
</header>

<main>

    <!-- FORMULARIO -->
    <section class="form-box">
        <h2>Registrar Modelo</h2>

        <form method="POST">
            <label>Nombre del modelo:</label>
            <input type="text" name="modelo" placeholder="Ingresa el nombre del modelo" required>

            <label>Marca:</label>
            <select name="marca" required>
                <option value="">Seleccione una marca</option>
                <?php while ($fila = $marcas->fetch_assoc()): ?>
                    <option value="<?= $fila['idMarcas'] ?>"><?= $fila['marcas'] ?></option>
                <?php endwhile; ?>
            </select>

            <div class="botones">
                <button type="submit" name="guardar">Guardar</button>
                <button type="reset">Cancelar</button>
            </div>
        </form>
    </section>

    <!-- TABLA -->
    <section class="tabla-box">
        <h2>Modelos Registrados</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $fila['idModelo'] ?></td>
                        <td><?= $fila['nombreModelo'] ?></td>
                        <td><?= $fila['nombreMarca'] ?></td>
                        <td>
                            <a href="Modelos.php?eliminar=<?= $fila['idModelo'] ?>" onclick="return confirm('¿Eliminar modelo?')"> Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

</main>

<!-- BOTÓN DEL MAPA -->
<button class="boton-mapa" onclick="location.href='mapa.php'">Mapa de navegación</button>
 
 <footer>
        <p>Carretera Huejutla - Chalmahuivapa S/N, C.P. 43000, Huejutla de Reyes, Hidalgo.</p>
        <p>E-mail: rectoria@uthh.edu.mx</p>
        <p>Universidad Tecnológica de la Huasteca Hidalguense</p>
</footer>
</body>
 
</html>