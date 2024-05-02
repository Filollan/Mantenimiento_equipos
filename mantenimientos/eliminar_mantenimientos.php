<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');
$conect = connection();

// Obtenemos el ID del mantenimiento desde la URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Verificar si se proporcionó un ID válido
if ($id !== null) {
    // Escapar el ID para evitar inyección de código SQL
    $id = mysqli_real_escape_string($conect, $id);

    // Preparar la consulta SQL para eliminar el mantenimiento
    $sql_delete_mantenimiento = "DELETE FROM mantenimientos WHERE id = ?";
    $stmt_delete_mantenimiento = mysqli_prepare($conect, $sql_delete_mantenimiento);

    // Vincular el parámetro
    mysqli_stmt_bind_param($stmt_delete_mantenimiento, "i", $id);

    // Ejecutar la consulta
    $query_delete_mantenimiento = mysqli_stmt_execute($stmt_delete_mantenimiento);

    // Verificar si la eliminación fue exitosa
    if ($query_delete_mantenimiento) {
        echo '<script>alert("Mantenimiento eliminado con éxito");window.location.href="listar_mantenimientos.php"</script>';
    } else {
        echo '<script>alert("Error al eliminar el mantenimiento: ' . mysqli_error($conect) . '");window.location.href="listar_mantenimientos.php"</script>';
    }

    // Cerrar la declaración preparada
    mysqli_stmt_close($stmt_delete_mantenimiento);
} else {
    // Manejar el caso cuando no se proporcionó un ID
    echo '<script>alert("ID de mantenimiento no proporcionado");window.location.href="listar_mantenimientos.php"</script>';
}
?>
