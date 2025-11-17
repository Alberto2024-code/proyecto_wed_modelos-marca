<?php
require_once "conexion.php";

// GUARDAR
if (isset($_POST["guardar"])) {
    $marca = $_POST["marcas"];
    if (!empty($marca)) {
        $conexion->query("INSERT INTO marca (marcas) VALUES ('$marca')");
    }
}
/* ----------------------- CARGAR DATOS PARA EDITAR ----------------------- */
$idEditar = "";
$marcaEditar = "";

if (isset($_GET["actualizar"])) {
    $idEditar = $_GET["actualizar"];

    $busqueda = $conexion->query("SELECT * FROM marca WHERE idMarcas = $idEditar");
    $datos = $busqueda->fetch_assoc();

    $marcaEditar = $datos["marcas"];
}

/* ----------------------- ACTUALIZAR MARCA ----------------------- */
if (isset($_POST["editar"])) {
    $id = $_POST["idEditar"];
    $marca = $_POST["marcas"];

    $conexion->query("UPDATE marca 
                      SET marcas='$marca' 
                      WHERE idMarcas=$id");

    header("Location: Marca.php");
    exit;
}

// CONSULTAR
$resultado = $conexion->query("SELECT idMarcas, marcas FROM marca");
if (isset($_GET["eliminar"])) {
    $id = $_GET["eliminar"];
    $conexion->query("DELETE FROM marca WHERE idMarcas = $id");
    header("Location: Marca.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Marca</title>

    
    <link rel="stylesheet" href="Marca.css">
</head>
<body>

  
    <header>
        <div class="logo">
            <img src="img/3a9737f7-0db2-4014-9c08-de5db4e5a5f5.jpg" alt="Logo" />
        </div>

        <h1>Registrar Marca</h1>

        <nav>
            <a href="modelo.php">Modelo</a>
            <a href="Marca.php">Marcas</a>
            <a href="#">Historial</a>
        </nav>
    </header>

   
    <main>

        <!-- FORMULARIO -->
        <section class="form-box">
    <h2><?= $idEditar ? "Editar Marca" : "Registrar Marca" ?></h2>

    <form method="POST">

        <input type="hidden" name="idEditar" value="<?= $idEditar ?>">

        <label>Nombre de la marca:</label>
        <input type="text" name="marcas" 
               value="<?= $marcaEditar ?>" 
               placeholder="Ingresa el nombre de la marca" required>

        <div class="botones">

            <?php if ($idEditar): ?>
                <button type="submit" name="editar">Actualizar</button>
                <a href="Marca.php">Cancelar</a>
            <?php else: ?>
                <button type="submit" name="guardar">Guardar</button>
                <button type="reset">Cancelar</button>
            <?php endif; ?>

        </div>
        
    </form>
</section>

        <!-- TABLA -->
        <section class="tabla-box">
            <h2>Tabla de Marcas</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= $fila['idMarcas'] ?></td>
                            <td><?= $fila['marcas'] ?></td>
                             <td>
                         <a href="Marca.php?actualizar=<?= $fila['idMarcas'] ?>">Actualizar</a>
                            <a href="Marca.php?eliminar=<?= $fila['idMarcas'] ?>" onclick="return confirm('¿Eliminar marcas?')"> Eliminar</a>
                        </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>

            </table>
        </section>
         
    </main>
<button class="boton-mapa" onclick="location.href='mapa.php'">
    Mapa de navegación
</button>
    <!-- FOOTER -->
    <footer>
        <p>Carretera Huejutla - Chalmahuivapa S/N, C.P. 43000, Huejutla de Reyes, Hidalgo.</p>
        <p>E-mail: rectoria@uthh.edu.mx</p>
        <p>Universidad Tecnológica de la Huasteca Hidalguense</p>
    </footer>
 

</body>
</html>



