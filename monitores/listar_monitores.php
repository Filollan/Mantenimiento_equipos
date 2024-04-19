<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

//Definimos un Query SQL
$sql = "SELECT * FROM monitores";
//Ejecutamos el Query
$query = mysqli_query($conect , $sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar monitores</title>
</head>
<body class="container">
    <div class="users-form">

        <form action="insertar_monitores.php" method ="POST">
            <h1> Ingresar monitor </h1>

            <label for="nombre" class="title"> Cedula del monitor:</label>
            <input type="number" name="cc" placeholder="100242...">
            <label for="nombre" class="title"> Nombre del monitor:</label>
            <input type="text" name="nombre" placeholder="Camilo">
            <input type="submit" value="Agregar monitor">

        </form>
    </div>

    <div class="tabla-form">
        <h2>Monitores Registradas</h2>

        <table>
            <thead>
                <tr>
                    <th>CC</th>
                    <th>Nombre</th>
        
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                //Por cada monitor nuevo que se encuentre en la base de datos imprime la infomracion
                while($row = mysqli_fetch_array($query)): 
                ?>
                <tr>
                <th><?= $row['cc'] ?></th>
                <th><?= $row['nombre'] ?></th>
               

                <th><a href="editar_monitores.php?cc=<?= $row['cc'] ?>" class="users-table--edit">Editar</a></th>
                <th><a href="eliminar_monitores.php?cc=<?= $row['cc'] ?>" class="users-table--edit">Eliminar</a></th>             
                </tr>  
                <?php 
                //Finalizamos el ciclo While
                endwhile;
                ?>                          
            </tbody>
        </table>
        <br>
        <a href="../index.php" class="users-table--edit">Menu principal</a>
    </div>
    <br/>
</body>
</html>