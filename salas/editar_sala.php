<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Obtener el ID de la sala a editar desde la URL
$id = $_GET['id'];

// Consulta SQL para obtener los datos de la sala específica
$sql_sala = "SELECT * FROM salas WHERE id=$id";
$query_sala = mysqli_query($conect, $sql_sala);
$row_sala = mysqli_fetch_array($query_sala);

// Consulta SQL para obtener todas las sedes disponibles
$sql_sedes = "SELECT * FROM sedes";
$query_sedes = mysqli_query($conect, $sql_sedes);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Editar sala</title>
</head>

<body class="container">
    <div class="users-form">
        <form action="edit_sala.php" method="POST">
            <h1> Editar sala </h1>
            <!-- Reasignamos todos los datos para que solo se actualice lo que se desea modificar -->
            <input type="hidden" name="id" value="<?= $row_sala['id'] ?>">
            <label for="nombre" class="title"> Nombre de la sala:</label>
            <input type="text" name="nombre" placeholder="Nombre" value="<?= $row_sala['nombre'] ?>">
            
            <!-- Mostrar las sedes disponibles en un select -->
            <label for="nombre" class="title"> Sedes disponibles:</label>
            <select name="id_sedes">
                
                <?php
                // Por cada sede disponible, mostramos una opción en el select
                while ($row_sede = mysqli_fetch_array($query_sedes)) :
                    $selected = ($row_sede['id'] == $row_sala['id_sedes']) ? 'selected' : '';
                ?>
                    <option value="<?= $row_sede['id'] ?>" <?= $selected ?>><?= $row_sede['nombre'] ?></option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Actualizar sala" class="users-table--edit">
        </form>
    </div>

</body>

</html>
