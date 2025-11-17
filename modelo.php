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
/* -----------------------se carga los modelo para que sean editados----------------------- */
$idEditar = "";
$modeloEditar = "";
$marcaEditar = "";

if (isset($_GET["actualizar"])) {
    $idEditar = $_GET["actualizar"];

    $busqueda = $conexion->query("SELECT * FROM modelos WHERE idModelo = $idEditar");
    $datos = $busqueda->fetch_assoc();

    if ($datos) {
        $modeloEditar = $datos["modelos"];
        $marcaEditar = $datos["idMarca"];
    }
}

/* ----------------------- se actualzan los modelos ----------------------- */
if (isset($_POST["editar"])) {
    $id = $_POST["idEditar"];
    $modelo = $_POST["modelo"];
    $marca = $_POST["marca"];

   $conexion->query("UPDATE modelos 
                  SET modelos='$modelo', idMarca='$marca'
                  WHERE idModelo=$id");

    header("Location: modelo.php");
    exit;
}

/* ----------------------- se condultan los modelos ----------------------- */
$sql = "
    SELECT 
        modelos.idModelo, 
        modelos.modelos AS nombreModelo, 
        marca.marcas AS nombreMarca
    FROM modelos
    LEFT JOIN marca ON modelos.idMarca = marca.idMarcas
";
$resultado = $conexion->query($sql);

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
    <input type="hidden" name="idEditar" value="<?= $idEditar ?>">

    <label>Nombre del modelo:</label>
    <input 
        type="text" 
        name="modelo" 
        value="<?= $modeloEditar ?>" 
        placeholder="Ingresa el nombre del modelo" 
        required
    >

    <label>Marca:</label>
    <select name="marca" required>
        <option value="">Seleccione una marca</option>

        <?php
        $marcas2 = $conexion->query("SELECT idMarcas, marcas FROM marca");
        while ($fila = $marcas2->fetch_assoc()):
        ?>
            <option value="<?= $fila['idMarcas'] ?>"
                <?= ($fila['idMarcas'] == $marcaEditar) ? 'selected' : '' ?>>
                <?= $fila['marcas'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <div class="botones">
        <?php if ($idEditar != ""): ?>
            <button type="submit" name="editar">Actualizar</button>
        <?php else: ?>
            <button type="submit" name="guardar">Guardar</button>
        <?php endif; ?>

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
                            <a href="modelo.php?actualizar=<?= $fila['idModelo'] ?>"> Actualizar</a> 
                            <a href="modelo.php?eliminar=<?= $fila['idModelo'] ?>" onclick="return confirm('¿Eliminar modelo?')"> Eliminar</a>
                            
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