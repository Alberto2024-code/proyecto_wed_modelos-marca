<?php
require_once "conexion.php";

/* -----------------------------------------
   VALIDAR ID
----------------------------------------- */
if (!isset($_GET['id'])) {
    die("Error: No se recibió ID.");
}

$id = intval($_GET['id']);

/* -----------------------------------------
   OBTENER DATOS DEL DISPOSITIVO
----------------------------------------- */
$sql = $conexion->query("
SELECT * FROM dispositivos 
WHERE idDispositivo = $id
");

if ($sql->num_rows == 0) {
    die("Error: El dispositivo no existe.");
}

$datos = $sql->fetch_assoc();

/* -----------------------------------------
   ACTUALIZAR DATOS
----------------------------------------- */
if (isset($_POST["editar"])) {

    $nombre = $_POST["nombreDispositivo"];
    $inventario = $_POST["numeroInventario"];
    $tipo = $_POST["tipoDispositivo"];
    $modelo = $_POST["modelo"];
    $lab = $_POST["laboratorios"];

    if (!empty($nombre) && !empty($inventario)) {

        $conexion->query("
            UPDATE dispositivos SET 
                nombreDispositivo = '$nombre',
                numeroInventario = '$inventario',
                idTipoDispositivo = $tipo,
                idModelo = $modelo,
                idLaboratorio = $lab
            WHERE idDispositivo = $id
        ");

        header("Location: Dispositivos.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar dispositivo</title>
    <link rel="stylesheet" href="actulizar.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="img/3a9737f7-0db2-4014-9c08-de5db4e5a5f5.jpg" alt="Logo">
    </div>

    <h1>ACTUALIZAR DISPOSITIVO</h1>
</header>

<form method="POST">

    <label>Nombre del dispositivo:</label>
    <input type="text" name="nombreDispositivo" value="<?= $datos['nombreDispositivo'] ?>" required>

    <label>Número de inventario:</label>
    <input type="text" name="numeroInventario" value="<?= $datos['numeroInventario'] ?>" required>

    <label>Tipo de dispositivo:</label>
    <select name="tipoDispositivo" required>
        <?php
        $tipos = $conexion->query("SELECT * FROM tipodispositivo");
        while ($t = $tipos->fetch_assoc()):
        ?>
        <option value="<?= $t['idTipoDispositivo'] ?>"
            <?= ($t['idTipoDispositivo'] == $datos['idTipoDispositivo']) ? 'selected' : '' ?>>
            <?= $t['tipoDispositivo'] ?>
        </option>
        <?php endwhile; ?>
    </select>

    <label>Modelo:</label>
    <select name="modelo" required>
        <?php
        $modelos = $conexion->query("SELECT * FROM modelos");
        while ($m = $modelos->fetch_assoc()):
        ?>
        <option value="<?= $m['idModelo'] ?>"
            <?= ($m['idModelo'] == $datos['idModelo']) ? 'selected' : '' ?>>
            <?= $m['modelos'] ?>
        </option>
        <?php endwhile; ?>
    </select>

    <label>Laboratorio:</label>
    <select name="laboratorios" required>
        <?php
        $labs = $conexion->query("SELECT * FROM laboratorios");
        while ($l = $labs->fetch_assoc()):
        ?>
        <option value="<?= $l['idLaboratorio'] ?>"
            <?= ($l['idLaboratorio'] == $datos['idLaboratorio']) ? 'selected' : '' ?>>
            <?= $l['laboratorios'] ?>
        </option>
        <?php endwhile; ?>
    </select>

    <button type="submit" name="editar">Actualizar</button>
    <a href="Dispositivos.php">Cancelar</a>

</form>

</body>
</html>


