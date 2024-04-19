<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Obtenemos los datos en variables con el método POST
$id = $_POST["id"];
$tipo = $_POST["tipo"];
$id_marca = $_POST["id_marca"];
$id_sala = $_POST["id_sala"];

// Si todo se cumple, actualizamos los valores en la tabla
$sql = "UPDATE equipos SET tipo='$tipo', id_marca='$id_marca', id_sala='$id_sala' WHERE id='$id'";
// Ejecutamos el Query
$query = mysqli_query($conect , $sql);

if ($query) {
    echo '<script language="javascript">alert("Equipo actualizado con éxito");window.location.href="listar_equipo.php"</script>';
} else {
    echo '<script language="javascript">alert("Error al actualizar equipo");window.location.href="listar_equipo.php"</script>';
}
?>
