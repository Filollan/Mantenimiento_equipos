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

// Definimos un Query SQL para obtener todos los equipos registrados junto con el nombre de la marca y el nombre de la sede correspondiente
$sql_equipos =
    "SELECT 
    equipos.id, 
    equipos.codigo, 
    equipos.tipo, 
    marcas.nombre AS nombre_marca, 
    salas.nombre AS nombre_sala, 
    sedes.nombre AS nombre_sede, 
    equipos.fechaingreso AS fecha_ingreso, 
    COALESCE(MAX(mantenimientos.fechainicio), '') AS 'ultimo mantenimiento', 
    CASE
        WHEN MAX(mantenimientos.fechainicio) IS NOT NULL THEN DATE_ADD(MAX(mantenimientos.fechainicio), INTERVAL 6 MONTH)
        ELSE ''
    END AS 'siguiente mantenimiento', 
    equipos.estado 
FROM 
    equipos 
LEFT JOIN 
    salas ON equipos.id_sala = salas.id 
LEFT JOIN 
    sedes ON salas.id_sedes = sedes.id 
LEFT JOIN 
    mantenimientos ON equipos.id = mantenimientos.id_equipo
LEFT JOIN
    marcas ON equipos.id_marca = marcas.id
GROUP BY
    equipos.id;";

$query_equipos = mysqli_query($conect, $sql_equipos);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar Equipos</title>
</head>

<body class="container">
    <?php include('../nav.php'); ?>

    <div class="tabla-form">
        <h2>Equipos Registrados</h2>

        <table>
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Sala</th>
                    <th>Sede</th>
                    <th>Fecha ingreso</th>
                    <th>Ultimo mantenimiento</th>
                    <th>Siguiente mantenimiento</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Por cada equipo registrado, mostramos la información en la tabla
                if ($query_equipos) {
                    // Por cada equipo registrado, mostramos la información en la tabla
                    while ($row_equipo = mysqli_fetch_array($query_equipos)) :
                        $estadoIcono = $row_equipo['estado'] == 1 ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>';
                ?>
                        <tr>
                            <th><?= $row_equipo['codigo'] ?></th>
                            <th><?= $row_equipo['tipo'] ?></th>
                            <th><?= $row_equipo['nombre_marca'] ?></th>
                            <th><?= $row_equipo['nombre_sala'] ?></th>
                            <th><?= $row_equipo['nombre_sede'] ?></th>
                            <th><?= $row_equipo['fecha_ingreso'] ?></th>
                            <th><?= $row_equipo['ultimo mantenimiento'] ?></th>
                            <th><?= $row_equipo['siguiente mantenimiento'] ?></th>
                            <th><?= $estadoIcono ?></th>
                            <th>
                                <a href="editar_equipo.php?id=<?= $row_equipo['id'] ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </th>
                            <th>
                                <a href="eliminar_equipo.php?id=<?= $row_equipo['id'] ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </th>

                            <th>
                                <a href="listar_mantenimientos.php?id_equipo=<?= $row_equipo['id'] ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Mantenimientos
                                </a>
                            </th>
                        </tr>
                <?php
                    endwhile;
                } else {
                    echo "Error al ejecutar la consulta: " . mysqli_error($conect);
                } ?>
            </tbody>
        </table>
    </div>

    <div class="users-form">
        <form action="insertar_equipo.php" method="POST">
            <h1> Ingresar equipo </h1>
            <label for="nombre" class="title"> Codigo del equipo:</label>
            <input type="text" name="codigo" placeholder="252201" class="input-field">

            <label for="nombre" class="title"> Tipo de equipo:</label>
            <select name="tipo">
                <option value="Portátil">Portátil</option>
                <option value="PC">PC</option>
            </select>

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

            <label for="nombre" class="title">Fecha de ingreso :</label>
            <input type="date" name="fechaingreso" placeholder="fechaingreso ">

            <div class="form-check firm-switch">
                <input type="checkbox" name="estado" class="input-field" id="flexSwitchCheckDeafult">
                <label for="nombre" class="title" for="flexSwitchCheckDeafult">Estado</label>
            </div>

            <input type="submit" value="Agregar equipo">
        </form>
    </div>
</body>

</html>
