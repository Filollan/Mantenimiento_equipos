<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

//Definimos un Query SQL
$sql = "SELECT * FROM sedes";
//Ejecutamos el Query
$query = mysqli_query($conect , $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar sedes</title>
</head>
<body class="container">
<div class="users-form">
    <form action="insertar_sede.php" method="POST">
        <h1> Ingresar sede </h1>

        <!-- Utiliza CSS para alinear el label y el input en la misma línea -->
       
            <label for="nombre" class="title" > Nombre de la sede:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Sede obando..." class="input-field">
       

        <input type="submit" value="Agregar sede" class="btn-submit">
    </form>
</div>

<div class="tabla-form">
        <h2>Sedes Registradas</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
        
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                //Por cada sede nueva que se encuentre en la base de datos imprime la infomracion
                while($row = mysqli_fetch_array($query)): 
                ?>
                <tr>
                <th><?= $row['id'] ?></th>
                <th><?= $row['nombre'] ?></th>
               

                <th><a href="editar_sede.php?id=<?= $row['id'] ?>" class="users-table--edit">Editar</a></th>
                <th><a href="eliminar_sede.php?id=<?= $row['id'] ?>" class="users-table--edit">Eliminar</a></th>             
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