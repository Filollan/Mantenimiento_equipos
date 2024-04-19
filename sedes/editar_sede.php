<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

$id=$_GET['id'];

$sql = "SELECT * FROM sedes WHERE id=$id";
//Ejecutamos el Query para la actualizacion de datos
$query = mysqli_query($conect , $sql);
$row = mysqli_fetch_array($query)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Editar Sede</title>
</head>
<body class="container">
    <div class="users-form">
        <form action="edit_sede.php" method ="POST">
            <h1> Editar sede </h1>
            <div class="form-group">
            <label for="nombre" class="title"> Nombre de la sede:</label>
            <!-- Reasignamos todos los datos para que solo se actualice lo que se desea modificar --> 
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="input-field" value="<?= $row['nombre'] ?>" >
            </div>

            <input type="submit" value="Actualizar sede" class="users-table--edit">


        </form>
    </div>
    
</body>
</html>