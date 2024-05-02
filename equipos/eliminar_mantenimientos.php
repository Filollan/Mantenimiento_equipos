<?php
// Incluimos el archivo connection
include('../bd/connection.php');
$conect = connection();

// Obtenemos el ID del mantenimiento desde la URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Definimos una variable para almacenar el ID del equipo
$id_equipo = null;

// Verificar si se proporcionó un ID válido
if ($id !== null) {
    // Escapar el ID para evitar inyección de código SQL
    $id = mysqli_real_escape_string($conect, $id);

    // Preparar la consulta SQL para obtener el ID del equipo asociado al mantenimiento
    $sql_get_equipo_id = "SELECT id_equipo FROM mantenimientos WHERE id = ?";
    $stmt_get_equipo_id = mysqli_prepare($conect, $sql_get_equipo_id);
    mysqli_stmt_bind_param($stmt_get_equipo_id, "i", $id);
    mysqli_stmt_execute($stmt_get_equipo_id);
    mysqli_stmt_bind_result($stmt_get_equipo_id, $id_equipo);
    mysqli_stmt_fetch($stmt_get_equipo_id);
    mysqli_stmt_close($stmt_get_equipo_id);

    // Preparar la consulta SQL para eliminar el mantenimiento
    $sql_delete_mantenimiento = "DELETE FROM mantenimientos WHERE id = ?";
    $stmt_delete_mantenimiento = mysqli_prepare($conect, $sql_delete_mantenimiento);

    // Vincular el parámetro
    mysqli_stmt_bind_param($stmt_delete_mantenimiento, "i", $id);

    // Ejecutar la consulta
    $query_delete_mantenimiento = mysqli_stmt_execute($stmt_delete_mantenimiento);

    // Verificar si la eliminación fue exitosa
    if ($query_delete_mantenimiento) {
        echo '<script language="javascript">alert("Mantenimiento eliminado con éxito");window.location.href="listar_mantenimientos.php?id_equipo=' . $id_equipo . '"</script>';
    } else {
        echo '<script language="javascript">alert("Error al eliminar el mantenimiento: ' . mysqli_error($conect) . '");window.location.href="listar_mantenimientos.php?id_equipo=' . $id_equipo . '"</script>';
    }

    // Cerrar la declaración preparada
    mysqli_stmt_close($stmt_delete_mantenimiento);
} else {
    // Manejar el caso cuando no se proporcionó un ID
    echo '<script language="javascript">alert("ID de mantenimiento no proporcionado");window.location.href="listar_mantenimientos.php?id_equipo=' . $id_equipo . '"</script>';
}
?>
