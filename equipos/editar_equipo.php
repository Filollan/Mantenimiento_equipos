<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');

$conect = connection();

// Obtenemos el ID del equipo a editar desde la URL
$id = $_GET['id'];

// Consulta SQL para obtener los datos del equipo a editar
$sql_equipo = "SELECT * FROM equipos WHERE id=$id";
$query_equipo = mysqli_query($conect, $sql_equipo);
$row_equipo = mysqli_fetch_array($query_equipo);

// Consulta SQL para obtener las opciones de id_sala
$sql_salas = "SELECT * FROM salas";
$query_salas = mysqli_query($conect, $sql_salas);

// Consulta SQL para obtener las opciones de id_marca
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
            <!-- Input oculto para enviar el ID del equipo -->
            <input type="hidden" name="id" value="<?= $row_equipo['id'] ?>">

            <!-- Campo para editar el código del equipo -->
            <label for="codigo" class="title"> Código del equipo:</label>
            <input type="text" name="codigo" placeholder="Código" value="<?= $row_equipo['codigo'] ?>">

            <label for="tipo" class="title"> Tipo de equipo:</label>
            <select name="tipo">
                <option value="Portátil" <?= ($row_equipo['tipo'] == 'Portátil') ? 'selected' : '' ?>>Portátil</option>
                <option value="PC" <?= ($row_equipo['tipo'] == 'PC') ? 'selected' : '' ?>>PC</option>
                <!-- Agrega más opciones según tus necesidades -->
            </select>




            <!-- Select para seleccionar la marca del equipo -->
            <label for="id_marca" class="title"> Marcas disponibles:</label>
            <select name="id_marca">
                <?php while ($row_marca = mysqli_fetch_array($query_marcas)) : ?>
                    <option value="<?= $row_marca['id'] ?>" <?= ($row_marca['id'] == $row_equipo['id_marca']) ? 'selected' : '' ?>>
                        <?= $row_marca['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <!-- Select para seleccionar la sala del equipo -->
            <label for="id_sala" class="title"> Salas disponibles:</label>
            <select name="id_sala">
                <?php while ($row_sala = mysqli_fetch_array($query_salas)) : ?>
                    <option value="<?= $row_sala['id'] ?>" <?= ($row_sala['id'] == $row_equipo['id_sala']) ? 'selected' : '' ?>>
                        <?= $row_sala['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <!-- Campo para editar la fecha de ingreso del equipo -->
            <label for="fechaingreso" class="title">Fecha de ingreso:</label>
            <input type="date" name="fechaingreso" value="<?= $row_equipo['fechaingreso'] ?>">

            <div class="form-check firm-switch">
            <!-- Campo para editar el estado del equipo -->
            <label for="estado" class="title">Estado:</label>
            <input type="checkbox" name="estado" <?= ($row_equipo['estado'] == 1) ? 'checked' : '' ?>>
            </div>
            <!-- Botón para enviar el formulario -->
            <input type="submit" value="Actualizar Equipo" class="users-table--edit">
        </form>
    </div>
</body>

</html>