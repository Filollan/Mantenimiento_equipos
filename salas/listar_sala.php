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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar salas</title>
</head>

<body class="container">
<?php include('../nav.php'); ?>
<div class="tabla-form">
        <h2>Salas Registradas</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Sede</th>

                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Definimos un Query SQL para obtener las salas registradas junto con el nombre de su sede correspondiente
                $sql_salas = "SELECT salas.id, salas.nombre AS nombre_sala, sedes.nombre AS nombre_sede FROM salas INNER JOIN sedes ON salas.id_sedes = sedes.id";
                $query_salas = mysqli_query($conect, $sql_salas);
                
                // Por cada sala registrada, mostramos la información en la tabla
                while ($row = mysqli_fetch_array($query_salas)) :
                ?>
                    <tr>
                        <th><?= $row['id'] ?></th>
                        <th><?= $row['nombre_sala'] ?></th>
                        <th><?= $row['nombre_sede'] ?></th>


                        <th><a href="editar_sala.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        <th><a href="eliminar_sala.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
   
    </div>
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
</body>

</html>
