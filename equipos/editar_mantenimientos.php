<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM mantenimientos WHERE id=$id";
// Ejecutamos el Query para la actualización de datos
$query = mysqli_query($conect, $sql);
$row = mysqli_fetch_array($query);

// Definimos un Query SQL para obtener los equipos disponibles
$sql_equipos = "SELECT id, codigo FROM equipos";
// Ejecutamos el Query para los equipos
$query_equipos = mysqli_query($conect, $sql_equipos);

// Definimos un Query SQL para obtener todos los monitores disponibles
$sql_monitores = "SELECT id, nombre FROM monitores";
// Ejecutamos el Query para los monitores
$query_monitores = mysqli_query($conect, $sql_monitores);

// Verificar si la consulta para obtener los monitores fue exitosa
if (!$query_monitores) {
    echo "Error al obtener los monitores: " . mysqli_error($conect);
    exit;
}

// Verificar si se encontraron monitores
$num_rows = mysqli_num_rows($query_monitores);
if ($num_rows == 0) {
    echo "No se encontraron monitores.";
}
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

        <!-- Selección de id_equipo -->
        <label for="id_equipo" class="title"> Equipos:</label>
        <select name="id_equipo">
            <?php while ($row_equipo = mysqli_fetch_array($query_equipos)): ?>
                <option value="<?= $row_equipo['id'] ?>" <?= ($row_equipo['id'] == $row['id_equipo']) ? 'selected' : '' ?>>
                    <?= $row_equipo['codigo'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Selección del tipo de mantenimiento -->
        <label for="tipo_mantenimiento" class="title"> Tipo de Mantenimiento:</label>
        <select name="tipo_mantenimiento">
            <option value="Correctivo" <?= ($row['tipo_mantenimiento'] == 'Correctivo') ? 'selected' : '' ?>>Correctivo</option>
            <option value="Preventivo" <?= ($row['tipo_mantenimiento'] == 'Preventivo') ? 'selected' : '' ?>>Preventivo</option>
        </select>

        <!-- Descripción del problema -->
        <label for="problema" class="title"> Problema:</label>
        <textarea name="problema" placeholder="Problema"><?= $row['problema'] ?></textarea>

        <!-- Fecha inicio -->
        <label for="fecha_inicio" class="title">Fecha inicio:</label>
        <input type="date" name="fecha_inicio" value="<?= $row['fechainicio'] ?>">

        <!-- Selección de quien_cc -->
        <label for="quien_cc" class="title"> Monitor encargado:</label>
        <select name="quien_cc">
            <option value="" disabled selected>Seleccione un monitor</option>
            <?php while ($row_monitor = mysqli_fetch_array($query_monitores)): ?>
                <option value="<?= $row_monitor['id'] ?>" <?= ($row_monitor['id'] == $row['quien_cc']) ? 'selected' : '' ?>>
                    <?= $row_monitor['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Fecha fin -->
        <label for="fecha_fin" class="title">Fecha fin:</label>
        <input type="date" name="fecha_fin" value="<?= $row['fechafin'] ?>">

        <!-- Descripción -->
        <label for="descripcion" class="title"> Descripción :</label>
        <textarea name="descripcion" placeholder="Descripción" value="<?= $row['descripcion'] ?>"> </textarea>

        <input type="submit" value="Actualizar mantenimiento" class="users-table--edit">
    </form>
</div>

</body>
</html>