<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM mantenimientos WHERE id=$id";
// Ejecutamos el Query para la actualización de datos
$query = mysqli_query($conect, $sql);
$row = mysqli_fetch_array($query);

// Definimos un Query SQL para obtener las salas disponibles
$sql_salas = "SELECT id, nombre FROM salas";
// Ejecutamos el Query para las salas
$query_salas = mysqli_query($conect, $sql_salas);

// Definimos un Query SQL para obtener los monitores disponibles
$sql_monitores = "SELECT cc, nombre FROM monitores";
// Ejecutamos el Query para los monitores
$query_monitores = mysqli_query($conect, $sql_monitores);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Editar mantenimiento</title>
</head>
<body class="container">
<div class="users-form">
    <form action="edit_mantenimientos.php" method="POST">
        <h1> Editar mantenimiento </h1>
        <!-- Reasignamos todos los datos para que solo se actualice lo que se desea modificar -->
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <label for="nombre" class="title"> Tipo de mantenimiento:</label>
        <input type="text" name="tipo_mantenimiento" placeholder="Tipo" value="<?= $row['tipo_mantenimiento'] ?>">
        <label for="nombre" class="title"> Problema:</label>    
        <input type="text" name="problema" placeholder="Problema" value="<?= $row['problema'] ?>">
        <label for="nombre" class="title"> Descripción :</label>
        <input type="text" name="descripcion" placeholder="Descripción" value="<?= $row['descripcion'] ?>">
        <label for="nombre" class="title">Fecha :</label>
        <input type="text" name="fecha" placeholder="Fecha" value="<?= $row['fecha'] ?>">

        <!-- Selección de id_equipo -->
        <label for="nombre" class="title"> Equipos disponibles:</label>
        <select name="id_equipo">
            <?php while ($row_sala = mysqli_fetch_array($query_salas)): ?>
                <option value="<?= $row_sala['id'] ?>" <?= ($row_sala['id'] == $row['id_equipo']) ? 'selected' : '' ?>>
                    <?= $row_sala['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Selección de quien_cc -->
        <label for="nombre" class="title"> Monitores disponibles:</label>
        <select name="quien_cc">
            <?php while ($row_monitor = mysqli_fetch_array($query_monitores)): ?>
                <option value="<?= $row_monitor['cc'] ?>" <?= ($row_monitor['cc'] == $row['quien_cc']) ? 'selected' : '' ?>>
                    <?= $row_monitor['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="submit" value="Actualizar mantenimiento" class="users-table--edit">
    </form>
</div>

</body>
</html>
