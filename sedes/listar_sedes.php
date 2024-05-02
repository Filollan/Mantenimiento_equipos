<?php
//Incluimos el archivo connection
include('../bd/connection.php');
$conect = connection();

//Definimos un Query SQL
$sql = "SELECT * FROM sedes";

//Ejecutamos el Query
$query = mysqli_query($conect, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../style/style.css">
    <title>Gestionar sedes</title>
    <style>
        .users-form {
            display: none;
        }
    </style>
</head>
<body class="container">
    <?php include('../nav.php'); ?>
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
                while ($row = mysqli_fetch_array($query)) :
                ?>
                    <tr>
                        <th><?= $row['id'] ?></th>
                        <th><?= $row['nombre'] ?></th>
                        <th><a href="editar_sede.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </th>
                        <th><a href="eliminar_sede.php?id=<?= $row['id'] ?>"  class="btn btn-danger btn-sm">
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
    <button id="toggleFormButton" class="users-table--edit">Ingresar sede</button>


    <div class="users-form">
        <form action="insertar_sede.php" method="POST">
            <h1>Ingresar sede</h1>
            <!-- Utiliza CSS para alinear el label y el input en la misma línea -->
            <label for="nombre" class="title">Nombre de la sede:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Sede obando..." class="input-field">
            <input type="submit" value="Agregar sede" class="btn-submit">
        </form>
    </div>

    <script>
    const toggleFormButton = document.getElementById('toggleFormButton');
    const usersForm = document.querySelector('.users-form');

    toggleFormButton.addEventListener('click', function() {
        usersForm.style.display = usersForm.style.display === 'none' ? 'block' : 'none';
    });
</script>

</body>
</html>