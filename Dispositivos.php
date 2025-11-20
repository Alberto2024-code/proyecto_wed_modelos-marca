<?php
require_once "conexion.php";

if (isset($_POST["guardar"])) {

    $nombre = $_POST["nombre"];
    $numero = $_POST["numeroInventario"];
    $tipo = $_POST["tipodispositivo"];
    $modelo = $_POST["modelo"];
    $lab = $_POST["laboratorios"];

    if (!empty($nombre) && !empty($numero) && !empty($tipo) && !empty($modelo) && !empty($lab)) {

        $conexion->query("INSERT INTO dispositivos 
            (idLaboratorio, idModelo, idTipoDispositivo, nombreDispositivo, numeroInventario)
            VALUES ('$lab', '$modelo', '$tipo', '$nombre', '$numero')");
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
        <img src="img/3a9737f7-0db2-4014-9c08-de5db4e5a5f5.jpg" alt="Logo">
    </div>

    <h1>REGISTRAR DISPOSITIVO</h1>

    <nav>
        <a href="Mapa_de_sitio.php">MAPA DE SITIO</a>
        <a href="Modelo.php">MODELO</a>
        <a href="Dispositivos.php">DISPOSITIVOS</a>
        <a href="Usuarios.php">USUARIOS</a>
        <a href="Menu.php">MENU PRINCIPAL</a>
        <a href="Dispositivos.php">DIS</a>
        <a href="RegistroDisp.php">REGISTRO</a>
    </nav>
</header>

<main>
    <div class="form-box">
        <h2>Formulario de Registro</h2>

        <form method="POST">

            
            
       <label>Nombre dispositivo:</label>
         <input type= "text" name="nombre" placeholder="ingresa el nombre del dispositivo" required>
           
       <label>Numero de inventario:</label>
       <input type="text" name ="numeroInventario" placeholder="ingresa el numero de inventario" required>

        <label>Tipo dispositivo:</label>
            <select name="tipodispositivo" required>
          <option value="">Seleccione un dispositivo</option>

        <?php
        $tipodispositivo2 = $conexion->query("SELECT idTipoDispositivo, tipoDispositivo FROM tipoDispositivo");
        while ($fila = $tipodispositivo2->fetch_assoc()):
        ?>
        <option value="<?= $fila['idTipoDispositivo'] ?>"
        <?=isset($tipodispoitivieditar)&& $fila['idTipoDispositivo'] == ($tipodispoitivieditar)? 'selected' : '' ?>>
        <?= $fila['tipoDispositivo'] ?>
        </option>
        <?php endwhile; ?>
       </select>


        <label>Modelo:</label>
        <select name="modelo" required>
        <option value="">Seleccione una modelo</option>

        <?php
        $modelo2 = $conexion->query("SELECT 	idModelo , modelos FROM modelos");
        while ($fila = $modelo2->fetch_assoc()):
        ?>
        <option value="<?= $fila['idModelo'] ?>"
        <?=isset($modeloeditar) && $fila ['idModelo'] == ($modeloeditar)?  'selected' : '' ?>>
        <?=$fila['modelos'] ?>
        </option>
        
        <?php endwhile; ?>
       </select>
       
       
       <label>Laboratorio:</label>
        <select name="laboratorios" required>
        <option value="">Seleccione un laboratorio</option>

        <?php
        $laboratorio2 = $conexion->query("SELECT idLaboratorio , laboratorios FROM laboratorios");
        while ($fila = $laboratorio2->fetch_assoc()):
        ?>
        <option value="<?= $fila['idLaboratorio'] ?>"
        <?= isset($laboratorioeditar)&& $fila['idLaboratorio'] == ($laboratorioeditar)? 'selected' : '' ?>>
        <?= $fila['laboratorios'] ?>

        </option>
        <?php endwhile; ?>
       </select>
           
    <div class="botones">
                <button type="submit" name="guardar">Guardar</button>
                <button type="reset">Cancelar</button>
            </div>

        </form>
    </div>
</main>

<footer>
    <p>Derechos de autor © 2025 mantenimiento de cómputo — Todos los derechos reservados</p>
</footer>

</body>
</html>


