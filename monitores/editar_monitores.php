<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

$cc=$_GET['cc'];

$sql = "SELECT * FROM monitores WHERE cc=$cc";
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
    <title>Editar Monitor</title>
</head>
<body class="container">
    <div class="users-form">
        <form action="edit_monitores.php" method ="POST">
            <h1> Editar Monitor </h1>
            <!-- Reasignamos todos los datos para que solo se actualice lo que se desea modificar --> 
            <label for="nombre" class="title"> Cedula del monitor:</label>
            <input type="number" name="cc" placeholder="cedula"value="<?= $row['cc'] ?>">
            <label for="nombre" class="title"> Nombre del monitor:</label>
    
            <input type="text" name="nombre" placeholder="Nombre"value="<?= $row['nombre'] ?>" >
           

            <input type="submit" value="Actualizar monitor" class="users-table--edit">


        </form>
    </div>
    
</body>
</html>