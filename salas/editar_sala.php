<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Verificar si se ha enviado el formulario para actualizar la sala
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos los datos del formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $id_sedes = $_POST["id_sedes"];

    // Realizamos la actualización en la base de datos
    $sql = "UPDATE salas SET nombre='$nombre', id_sedes='$id_sedes' WHERE id='$id'";
    $query = mysqli_query($conect, $sql);

    // Verificamos si la actualización fue exitosa
    if ($query) {
        echo '<script language="javascript">alert("Sala actualizada con éxito");window.location.href="listar_sala.php"</script>';
    }
} else {
    // Si no se ha enviado el formulario, obtenemos el ID de la sala a editar desde la URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Consulta SQL para obtener los datos de la sala específica
        $sql_sala = "SELECT * FROM salas WHERE id=$id";
        $query_sala = mysqli_query($conect, $sql_sala);

        // Verificamos si la consulta fue exitosa
        if ($query_sala) {
            $row_sala = mysqli_fetch_array($query_sala);

            // Consulta SQL para obtener todas las sedes disponibles
            $sql_sedes = "SELECT * FROM sedes";
            $query_sedes = mysqli_query($conect, $sql_sedes);
        } else {
            echo "Error al obtener los datos de la sala.";
        }
    } else {
        echo "ID de la sala no proporcionado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Editar sala</title>
</head>

<body class="container">
    <div class="users-form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h1> Editar sala </h1>
            <!-- Reasignamos todos los datos para que solo se actualice lo que se desea modificar -->
            <input type="hidden" name="id" value="<?= isset($row_sala['id']) ? $row_sala['id'] : '' ?>">
            <label for="nombre" class="title"> Nombre de la sala:</label>
            <input type="text" name="nombre" placeholder="Nombre" value="<?= isset($row_sala['nombre']) ? $row_sala['nombre'] : '' ?>">
            
            <!-- Mostrar las sedes disponibles en un select -->
            <label for="nombre" class="title"> Sedes disponibles:</label>
            <select name="id_sedes">
                
                <?php
                // Por cada sede disponible, mostramos una opción en el select
                if (isset($query_sedes)) {
                    while ($row_sede = mysqli_fetch_array($query_sedes)) {
                        $selected = (isset($row_sala['id_sedes']) && $row_sede['id'] == $row_sala['id_sedes']) ? 'selected' : '';
                        echo "<option value='" . $row_sede['id'] . "' $selected>" . $row_sede['nombre'] . "</option>";
                    }
                }
                ?>
            </select>

            <input type="submit" value="Actualizar sala" class="users-table--edit">
        </form>
    </div>

</body>

</html>
