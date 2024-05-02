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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar monitores</title>
</head>
<body class="container">
<?php include('../nav.php'); ?>
<div class="tabla-form">
        <h2>Monitores Registradas</h2>

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
                //Por cada monitor nuevo que se encuentre en la base de datos imprime la infomracion
                while($row = mysqli_fetch_array($query)): 
                ?>
                <tr>
                <th><?= $row['id'] ?></th>
                <th><?= $row['nombre'] ?></th>
               

                <th><a href="editar_monitores.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                <th><a href="eliminar_monitores.php?id=<?= $row['id'] ?>"   class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>             
                </tr>  
                <?php 
                //Finalizamos el ciclo While
                endwhile;
                ?>                          
            </tbody>
        </table>
        <br>
       
    </div>
    <div class="users-form">

        <form action="insertar_monitores.php" method ="POST">
            <h1> Ingresar monitor </h1>


            <label for="nombre" class="title"> Nombre del monitor:</label>
            <input type="text" name="nombre" placeholder="Camilo">
            <input type="submit" value="Agregar monitor">

        </form>
    </div>

  
    <br/>
</body>
</html>