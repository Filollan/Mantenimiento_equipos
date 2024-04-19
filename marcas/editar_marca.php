<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

$id=$_GET['id'];

$sql = "SELECT * FROM marcas WHERE id=$id";
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
    <title>Editar Marca</title>
</head>
<body class="container">
    <div class="users-form">
        <form action="edit_marca.php" method ="POST">
            <h1> Editar marca </h1>
            <!-- Reasignamos todos los datos para que solo se actualice lo que se desea modificar --> 
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <label for="nombre" class="title"> Nombre de la marca:</label>
            <input type="text" name="nombre" placeholder="Nombre"value="<?= $row['nombre'] ?>" >
           

            <input type="submit" value="Actualizar marca" class="users-table--edit">


        </form>
    </div>
    
</body>
</html>