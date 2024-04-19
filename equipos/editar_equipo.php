<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

$id = $_GET['id'];

$sql_equipo = "SELECT * FROM equipos WHERE id=$id";
// Ejecutamos el Query para obtener los datos del equipo
$query_equipo = mysqli_query($conect, $sql_equipo);
$row_equipo = mysqli_fetch_array($query_equipo);

// Query para obtener las opciones de id_sala
$sql_salas = "SELECT * FROM salas";
$query_salas = mysqli_query($conect, $sql_salas);

// Query para obtener las opciones de id_marca
$sql_marcas = "SELECT * FROM marcas";
$query_marcas = mysqli_query($conect, $sql_marcas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Editar Equipo</title>
</head>
<body class="container">
    <div class="users-form">
        <form action="edit_equipo.php" method="POST">
            <h1>Editar Equipo</h1>
            <!-- Reasignamos todos los datos para que solo se actualice lo que se desea modificar --> 
            <input type="hidden" name="id" value="<?= $row_equipo['id'] ?>">
            <label for="nombre" class="title"> Nombre del equipo:</label>
            <input type="text" name="tipo" placeholder="Tipo" value="<?= $row_equipo['tipo'] ?>">
            
            <!-- Select para id_marca -->
            <label for="nombre" class="title"> Marcas disponibles:</label>
            <select name="id_marca">
                <?php while ($row_marca = mysqli_fetch_array($query_marcas)) : ?>
                    <option value="<?= $row_marca['id'] ?>" <?= ($row_marca['id'] == $row_equipo['id_marca']) ? 'selected' : '' ?>>
                        <?= $row_marca['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
            
            <!-- Select para id_sala -->
            <label for="nombre" class="title"> Salas disponibles:</label>
            <select name="id_sala">
                <?php while ($row_sala = mysqli_fetch_array($query_salas)) : ?>
                    <option value="<?= $row_sala['id'] ?>" <?= ($row_sala['id'] == $row_equipo['id_sala']) ? 'selected' : '' ?>>
                        <?= $row_sala['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Actualizar Equipo" class="users-table--edit">
        </form>
    </div>
</body>
</html>
