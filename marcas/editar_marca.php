<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar los datos del formulario y actualizar la marca en la base de datos
     $id = $_POST["id"];
    $name = $_POST["nombre"];

    // Verificamos si el nombre de la marca está vacío
    if (empty($name)) {
        echo '<script language="javascript">alert("Falta ingresar el nombre de la marca");window.location.href="editar_marca.php?id='.$id.'"</script>';
    } else {
        // Consultamos si la marca ya existe en la base de datos, excluyendo la marca que se está editando
        $sql_check = "SELECT * FROM marcas WHERE nombre = '$name' AND id != '$id'";
        $query_check = mysqli_query($conect, $sql_check);

        // Verificamos si la consulta fue exitosa
        if ($query_check) {
            // Verificamos si ya existe una marca con ese nombre (excluyendo la marca que se está editando)
            if (mysqli_num_rows($query_check) > 0) {
                echo '<script language="javascript">alert("Ya existe una marca con ese nombre");window.location.href="editar_marca.php?id='.$id.'"</script>';
            } else {
                // Actualizamos la marca en la base de datos
                $sql_update = "UPDATE marcas SET nombre='$name' WHERE id='$id'";
                $query_update = mysqli_query($conect, $sql_update);

                // Verificamos si la actualización fue exitosa
                if ($query_update) {
                    echo '<script language="javascript">alert("Marca actualizada con éxito");window.location.href="listar_marca.php"</script>';
                } else {
                    echo "Error al actualizar la marca: " . mysqli_error($conect);
                }
            }
        } else {
            echo "Error al verificar la existencia de la marca: " . mysqli_error($conect);
        }
    }
}
// Obtenemos el ID de la sede a editar
$id = $_GET['id'];

// Obtenemos los datos de la sede a editar
$sql = "SELECT * FROM marcas WHERE id=$id";
$query = mysqli_query($conect, $sql);
$row = mysqli_fetch_array($query);
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
        <form action="editar_marca.php" method ="POST">
            <h1> Editar marca </h1>
            <!-- Reasignamos todos los datos para que solo se actualice lo que se desea modificar --> 
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <label for="nombre" class="title"> Nombre de la marca:</label>
            <input type="text" name="nombre" placeholder="Nombre" value="<?= $row['nombre'] ?>" >
            <input type="submit" value="Actualizar marca" class="users-table--edit">
        </form>
    </div>
</body>
</html>

