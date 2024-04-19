<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Definimos un Query SQL para obtener las sedes disponibles
$sql_sedes = "SELECT * FROM sedes";
$query_sedes = mysqli_query($conect, $sql_sedes);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar salas</title>
</head>

<body class="container">
    <div class="users-form">

        <form action="insertar_sala.php" method="POST">
            <h1> Ingresar sala </h1>

            <label for="nombre" class="title"> Nombre de la sala:</label>
            <input type="text" name="nombre" placeholder="101">
            
            <!-- Mostrar las sedes disponibles en un select -->
            <label for="nombre" class="title"> Sedes disponibles:</label>
            <select name="id_sedes" >
            <option value="">-----</option>
                <?php

                // Por cada sede disponible, mostramos una opción en el select
                while ($row_sede = mysqli_fetch_array($query_sedes)) :
                ?>
                    <option value="<?= $row_sede['id'] ?>"><?= $row_sede['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
            

            <input type="submit" value="Agregar sala">

        </form>
    </div>

    <div class="tabla-form">
        <h2>Salas Registradas</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>ID_sedes</th>

                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Definimos un Query SQL para obtener las salas registradas
                $sql_salas = "SELECT * FROM salas";
                $query_salas = mysqli_query($conect, $sql_salas);
                
                // Por cada sala registrada, mostramos la información en la tabla
                while ($row = mysqli_fetch_array($query_salas)) :
                ?>
                    <tr>
                        <th><?= $row['id'] ?></th>
                        <th><?= $row['nombre'] ?></th>
                        <th><?= $row['id_sedes'] ?></th>


                        <th><a href="editar_sala.php?id=<?= $row['id'] ?>" class="users-table--edit">Editar</a></th>
                        <th><a href="eliminar_sala.php?id=<?= $row['id'] ?>" class="users-table--edit">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <a href="../index.php" class="users-table--edit">Menu principal</a>
    </div>
    <br />
</body>

</html>
