<?php
require_once "conexion.php";

// GUARDAR
if (isset($_POST["guardar"])) {
    $marca = $_POST["marcas"];
    if (!empty($marca)) {
        $conexion->query("INSERT INTO marca (marcas) VALUES ('$marca')");
    }
}

// CONSULTAR
$resultado = $conexion->query("SELECT idMarcas, marcas FROM marca");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Marca</title>

    <!-- TU CSS ORIGINAL -->
    <link rel="stylesheet" href="Modelo.css">
</head>
<body>

    <!-- HEADER ORIGINAL -->
    <header>
        <div class="logo">
            <img src="img/3a9737f7-0db2-4014-9c08-de5db4e5a5f5.jpg" alt="Logo" />
        </div>

        <h1>Registrar Marca</h1>

        <nav>
            <a href="index.php">Inicio</a>
            <a href="Marca.php">Marcas</a>
            <a href="#">Historial</a>
        </nav>
    </header>

    <!-- CONTENIDO EN CAJAS COMO LO TENÍAS -->
    <main>

        <!-- FORMULARIO -->
        <section class="form-box">
            <h2>Registrar Marca</h2>

            <form method="POST">
                <label>Nombre de la marca:</label>
                <input type="text" name="marcas" placeholder="Ingresa el nombre de la marca" required>

                <div class="botones">
                    <button type="submit" name="guardar">Guardar</button>
                    <button type="reset">Cancelar</button>
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
                    </tr>
                </thead>

                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= $fila['idMarcas'] ?></td>
                            <td><?= $fila['marcas'] ?></td>
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



