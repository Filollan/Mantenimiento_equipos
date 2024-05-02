<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');

$conect = connection();

// Obtenemos los datos en variables con el método POST
$id = $_POST["id"];
$tipo = $_POST["tipo"];
$id_marca = $_POST["id_marca"];
$id_sala = $_POST["id_sala"];
$estado = isset($_POST["estado"]) ? 1 : 0; // Verificamos si el checkbox está marcado

// Si todo se cumple, actualizamos los valores en la tabla
$sql = "UPDATE equipos SET tipo=?, id_marca=?, id_sala=?, estado=? WHERE id=?";
// Preparamos la consulta
$stmt = mysqli_prepare($conect, $sql);
// Vinculamos los parámetros
mysqli_stmt_bind_param($stmt, "siiii", $tipo, $id_marca, $id_sala, $estado, $id);
// Ejecutamos la consulta
$query = mysqli_stmt_execute($stmt);

if ($query) {
    echo '<script language="javascript">alert("Equipo actualizado con éxito");window.location.href="listar_equipo.php"</script>';
} else {
    echo '<script language="javascript">alert("Error al actualizar equipo: ' . mysqli_error($conect) . '");window.location.href="listar_equipo.php"</script>';
}

// Cerramos la consulta preparada
mysqli_stmt_close($stmt);
// Cerramos la conexión
mysqli_close($conect);
?>
