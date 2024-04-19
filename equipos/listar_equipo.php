<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Definimos un Query SQL para obtener todas las marcas disponibles
$sql_marcas = "SELECT * FROM marcas";
$query_marcas = mysqli_query($conect, $sql_marcas);

// Definimos un Query SQL para obtener todas las salas disponibles
$sql_salas = "SELECT * FROM salas";
$query_salas = mysqli_query($conect, $sql_salas);

// Definimos un Query SQL para obtener todos los equipos registrados
$sql_equipos = "SELECT * FROM equipos";
$query_equipos = mysqli_query($conect , $sql_equipos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar Equipos</title>
</head>
<body class="container">
    <div class="users-form">
        <form action="insertar_equipo.php" method ="POST">
            <h1> Ingresar equipo </h1>
            <label for="nombre" class="title"> Nombre del equipo:</label>
            <input type="text" name="tipo" placeholder="equipo 5">
            
            <!-- Select para elegir la marca del equipo -->
            <label for="nombre" class="title"> Marcas disponibles:</label>
            <select name="id_marca">
            <option value="">-----</option>
                <?php while ($row_marca = mysqli_fetch_array($query_marcas)) : ?>
                    <option value="<?= $row_marca['id'] ?>"><?= $row_marca['nombre'] ?></option>
                <?php endwhile; ?>
            </select>

            <!-- Select para elegir la sala del equipo -->
            <label for="nombre" class="title"> Salas disponibles:</label>
            <select name="id_sala">
            <option value="">-----</option>
                <?php while ($row_sala = mysqli_fetch_array($query_salas)) : ?>
                    <option value="<?= $row_sala['id'] ?>"><?= $row_sala['nombre'] ?></option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Agregar equipo">
        </form>
    </div>

    <div class="tabla-form">
        <h2>Equipos Registrados</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>ID_marca</th>
                    <th>ID_sala</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                // Por cada equipo registrado, mostramos la información en la tabla
                while($row_equipo = mysqli_fetch_array($query_equipos)): 
                ?>
                <tr>
                    <th><?= $row_equipo['id'] ?></td>
                    <th><?= $row_equipo['tipo'] ?></td>
                    <th><?= $row_equipo['id_marca'] ?></td>
                    <th><?= $row_equipo['id_sala'] ?></td>

                    <td><a href="editar_equipo.php?id=<?= $row_equipo['id'] ?>" class="users-table--edit">Editar</a></td>
                    <td><a href="eliminar_equipo.php?id=<?= $row_equipo['id'] ?>" class="users-table--edit">Eliminar</a></td>             
                </tr>  
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <a href="../index.php" class="users-table--edit">Menu principal</a>
    </div>
    <br/>
</body>
</html>
