<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM monitores WHERE id=$id";
//Ejecutamos el Query para obtener los datos del monitor a editar
$query = mysqli_query($conect, $sql);
$row = mysqli_fetch_array($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Obtenemos los datos actualizados desde el formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];

    //Actualizamos los datos en la base de datos
    $sql = "UPDATE monitores SET nombre='$nombre' WHERE id='$id' ";
    $query = mysqli_query($conect, $sql);

    if ($query) {
        // Redireccionamos a la página de listar monitores después de la actualización
        echo '<script language="javascript">alert("Monitor actualizado con éxito");window.location.href="listar_monitores.php"</script>';
    }
}
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
        <form action="" method="POST">
            <h1> Editar Monitor </h1>
            <!-- Mostramos los datos del monitor a editar -->
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <label for="nombre" class="title">Nombre del monitor:</label>
            <input type="text" name="nombre" placeholder="Nombre" value="<?= $row['nombre'] ?>">
            <input type="submit" value="Actualizar monitor" class="users-table--edit">
        </form>
    </div>
</body>
</html>
