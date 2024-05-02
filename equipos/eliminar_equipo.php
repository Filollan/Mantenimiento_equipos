<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');

$conect = connection();

// Verificamos si se recibió el ID del equipo a eliminar
if(isset($_GET['id'])) {
    // Obtenemos el ID del equipo a eliminar desde la URL
    $id = $_GET['id'];

    // Eliminamos primero los registros relacionados en la tabla de mantenimientos
    $sql_delete_mantenimientos = "DELETE FROM mantenimientos WHERE id_equipo=?";
    $stmt_delete_mantenimientos = mysqli_prepare($conect, $sql_delete_mantenimientos);
    mysqli_stmt_bind_param($stmt_delete_mantenimientos, "i", $id);
    $query_delete_mantenimientos = mysqli_stmt_execute($stmt_delete_mantenimientos);

    if ($query_delete_mantenimientos) {
        // Luego eliminamos el equipo
        $sql_delete_equipo = "DELETE FROM equipos WHERE id=?";
        $stmt_delete_equipo = mysqli_prepare($conect, $sql_delete_equipo);
        mysqli_stmt_bind_param($stmt_delete_equipo, "i", $id);
        $query_delete_equipo = mysqli_stmt_execute($stmt_delete_equipo);

        if ($query_delete_equipo) {
            echo '<script language="javascript">alert("Equipo eliminado con éxito");window.location.href="listar_equipo.php"</script>';
        } else {
            echo '<script language="javascript">alert("Error al eliminar equipo: ' . mysqli_error($conect) . '");window.location.href="listar_equipo.php"</script>';
        }
    } else {
        echo '<script language="javascript">alert("Error al eliminar los mantenimientos asociados al equipo: ' . mysqli_error($conect) . '");window.location.href="listar_equipo.php"</script>';
    }

    // Cerramos las consultas preparadas
    mysqli_stmt_close($stmt_delete_mantenimientos);
    mysqli_stmt_close($stmt_delete_equipo);
} else {
    // Si no se recibió el ID del equipo a eliminar, redireccionamos al usuario
    echo '<script language="javascript">alert("No se ha proporcionado el ID del equipo a eliminar");window.location.href="listar_equipo.php"</script>';
}

// Cerramos la conexión
mysqli_close($conect);
?>
