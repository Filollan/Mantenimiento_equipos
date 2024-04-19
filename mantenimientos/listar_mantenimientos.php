<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Definimos un Query SQL para obtener los equipos disponibles
$sql_equipos = "SELECT id, tipo FROM equipos";
// Ejecutamos el Query para los equipos
$query_equipos = mysqli_query($conect, $sql_equipos);

// Definimos un Query SQL para obtener los monitores disponibles
$sql_monitores = "SELECT cc, nombre FROM monitores";
// Ejecutamos el Query para los monitores
$query_monitores = mysqli_query($conect, $sql_monitores);

// Definimos un Query SQL para obtener los mantenimientos
$sql_mantenimientos = "SELECT * FROM mantenimientos";
// Ejecutamos el Query
$query_mantenimientos = mysqli_query($conect, $sql_mantenimientos);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar Mantenimientos</title>
</head>

<body class="container">
    <div class="users-form">

        <form action="insertar_mantenimientos.php" method="POST">
            <h1> Ingresar mantenimiento </h1>
            
            <label for="nombre" class="title"> Tipo de mantenimiento:</label>
            <input type="text" name="tipo_mantenimiento" placeholder="Correctivo...">
           
            <label for="nombre" class="title"> Problema:</label>    
            <input type="text" name="problema" placeholder="Problema">

            <label for="nombre" class="title"> Descripción :</label>
            <input type="text" name="descripcion" placeholder="Descripción">

            <label for="nombre" class="title">Fecha :</label>
            <input type="date" name="fecha" placeholder="Fecha">

            <!-- Selección de id_equipo -->
            <label for="nombre" class="title"> Equipos disponibles:</label>
            <select name="id_equipo">
            <option value="">-----</option>
                <?php while ($row_equipo = mysqli_fetch_array($query_equipos)) : ?>
                    <option value="<?= $row_equipo['id'] ?>"><?= $row_equipo['tipo'] ?></option>
                <?php endwhile; ?>
            </select>

            <!-- Selección de quien_cc -->
            <label for="nombre" class="title"> Monitores disponibles:</label>
            <select name="quien_cc">
            <option value="">-----</option>
                <?php while ($row_monitor = mysqli_fetch_array($query_monitores)) : ?>
                    <option value="<?= $row_monitor['cc'] ?>"><?= $row_monitor['nombre'] ?></option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Agregar mantenimiento">

        </form>
    </div>

    <div class="tabla-form">
        <h2>Mantenimientos Registrados</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo Mantenimiento</th>
                    <th>Problema</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>ID Equipo</th>
                    <th>Cédula Monitor</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Por cada mantenimiento nuevo que se encuentre en la base de datos, imprime la información
                while ($row = mysqli_fetch_array($query_mantenimientos)) :
                ?>
                    <tr>
                        <th><?= $row['id'] ?></th>
                        <th><?= $row['tipo_mantenimiento'] ?></th>
                        <th><?= $row['problema'] ?></th>
                        <th><?= $row['descripcion'] ?></th>
                        <th><?= $row['fecha'] ?></th>
                        <th><?= $row['id_equipo'] ?></th>
                        <th><?= $row['quien_cc'] ?></th>

                        <th><a href="editar_mantenimientos.php?id=<?= $row['id'] ?>" class="users-table--edit">Editar</a></th>
                        <th><a href="eliminar_mantenimientos.php?id=<?= $row['id'] ?>" class="users-table--edit">Eliminar</a></th>
                    </tr>
                <?php
                // Finalizamos el ciclo While
                endwhile;
                ?>
            </tbody>
        </table>
        <br>
        <a href="../index.php" class="users-table--edit">Menu principal</a>
    </div>
    <br />
</body>

</html>
