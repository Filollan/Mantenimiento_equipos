<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');

$conect = connection();

// Definimos el ID del equipo desde la URL
$id_equipo = isset($_GET['id_equipo']) ? $_GET['id_equipo'] : null;


// Si no se proporciona un ID de equipo, redirigir a otra página o mostrar un mensaje de error

// Definimos un Query SQL para obtener los equipos disponibles
$sql_equipos = "SELECT id, codigo FROM equipos";
$query_equipos = mysqli_query($conect, $sql_equipos);

// Definimos un Query SQL para obtener los monitores disponibles
$sql_monitores = "SELECT id, nombre FROM monitores";
$query_monitores = mysqli_query($conect, $sql_monitores);

// Definimos un Query SQL para obtener los mantenimientos del equipo
$sql_mantenimientos = "SELECT
mantenimientos.*,
monitores.nombre AS nombre_monitor,
equipos.codigo AS codigo_equipo
FROM
mantenimientos
LEFT JOIN
monitores ON mantenimientos.quien_cc = monitores.id
LEFT JOIN
equipos ON mantenimientos.id_equipo = equipos.id
WHERE
mantenimientos.id_equipo = '$id_equipo'";
$query_mantenimientos = mysqli_query($conect, $sql_mantenimientos);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar Mantenimientos</title>
</head>

<body class="container">
<?php include('../nav.php'); ?>
  
    <div class="tabla-form">
        <h2>Mantenimientos Registrados</h2>

        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Equipo</th>
                    <th>Tipo</th>
                    <th>Monitor</th>
                    <th>Fecha fin</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Por cada mantenimiento registrado, muestra la información en la tabla
                while ($row_mantenimiento = mysqli_fetch_array($query_mantenimientos)) :
                ?>
                    <tr>
                        <th><?= $row_mantenimiento['fechainicio'] ?></td>
                        <th><?= $row_mantenimiento['codigo_equipo'] ?></th>
                        <th><?= $row_mantenimiento['tipo_mantenimiento'] ?></th>
                        <th><?= $row_mantenimiento['nombre_monitor'] ?></th>
                        <th><?= $row_mantenimiento['fechafin'] ?></td>
                        

                        <td><a href="eliminar_mantenimientos.php?id=<?= $row_mantenimiento['id'] ?>"  class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        <th><a href="editar_mantenimientos.php?id=<?= $row_mantenimiento['id'] ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
       
    </div>
    <div class="users-form">
        <form action="insertar_mantenimientos.php" method="POST">
            <h1> Ingresar Mantenimiento</h1>

            <input type="hidden" name="id_equipo"  value="<?= $id_equipo ?>">


            <label for="id_equipo" class="title">Código del Equipo:</label>
<select name="id_equipo" disabled>
    <?php 
    // Obtener el código del equipo correspondiente al ID proporcionado en la URL
    $sql_codigo_equipo = "SELECT codigo FROM equipos WHERE id = $id_equipo";
    $query_codigo_equipo = mysqli_query($conect, $sql_codigo_equipo);
    $row_codigo_equipo = mysqli_fetch_assoc($query_codigo_equipo);
    $codigo_equipo = $row_codigo_equipo['codigo'];
    ?>
    <option value="<?= $id_equipo ?>"><?= $codigo_equipo ?></option>
</select>


            <!-- Selección del tipo de mantenimiento -->
            <label for="tipo_mantenimiento" class="title"> Tipo de Mantenimiento:</label>
            <select name="tipo_mantenimiento">
                <option value="Correctivo">Correctivo</option>
                <option value="Preventivo">Preventivo</option>
            </select>

            <!-- Descripción del problema -->
            <label for="problema" class="title"> Problema:</label>
            <textarea name="problema" placeholder="Problema"></textarea>

            <!-- Fecha de inicio -->
            <label for="fecha" class="title"> Fecha de Inicio:</label>
            <input type="date" name="fecha">

            <!-- Selección del monitor encargado -->
            <label for="quien_cc" class="title"> Monitor Encargado:</label>
            <select name="quien_cc">
                <option value="">-----</option>
                <?php while ($row_monitor = mysqli_fetch_array($query_monitores)) : ?>
                    <option value="<?= $row_monitor['id'] ?>"><?= $row_monitor['nombre'] ?></option>
                <?php endwhile; ?>
            </select>

       

            <!-- Botón para agregar mantenimiento -->
            <input type="submit" value="Agregar Mantenimiento">
        </form>
    </div>

</body>

</html>