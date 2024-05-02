<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');

$conect = connection();

// Verificamos si se ha enviado el formulario para actualizar la sede
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos los datos del formulario
    $id = $_POST["id"];
    $name = $_POST["nombre"];

    // Verificamos si el nombre de la sede está vacío
    if (empty($name)) {
        echo '<script language="javascript">alert("Falta ingresar el nombre de la sede");window.location.href="listar_sedes.php"</script>';
    } else {
        // Consultamos si la sede ya existe en la base de datos
        $sql_check = "SELECT * FROM sedes WHERE nombre = '$name' AND id != '$id'";
        $query_check = mysqli_query($conect, $sql_check);

        // Verificamos si la consulta fue exitosa
        if ($query_check) {
            // Verificamos si ya existe una sede con ese nombre (excluyendo la sede que se está editando)
            if (mysqli_num_rows($query_check) > 0) {
                echo '<script language="javascript">alert("Ya existe una sede con ese nombre");window.location.href="listar_sedes.php"</script>';
            } else {
                // Realizamos la actualización en la base de datos
                $sql_update = "UPDATE sedes SET nombre='$name' WHERE id='$id'";
                $query_update = mysqli_query($conect, $sql_update);

                // Verificamos si la actualización fue exitosa
                if ($query_update) {
                    echo '<script language="javascript">alert("Sede actualizada con éxito");window.location.href="listar_sedes.php"</script>';
                } else {
                    echo "Error al actualizar la sede: " . mysqli_error($conect);
                }
            }
        } else {
            echo "Error al verificar la existencia de la sede: " . mysqli_error($conect);
        }
    }
}

// Obtenemos el ID de la sede a editar
$id = $_GET['id'];

// Obtenemos los datos de la sede a editar
$sql = "SELECT * FROM sedes WHERE id=$id";
$query = mysqli_query($conect, $sql);
$row = mysqli_fetch_array($query);
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
