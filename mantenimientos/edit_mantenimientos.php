<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Obtenemos los datos en variables con el método POST
$id = $_POST["id"];
$tipo_mantenimiento = $_POST["tipo_mantenimiento"];
$problema = $_POST["problema"];
$descripcion = $_POST["descripcion"];
$fecha = $_POST["fecha"];
$id_equipo = $_POST["id_equipo"];
$quien_cc = $_POST["quien_cc"];

// Si todo se cumple, actualizamos los valores en la tabla
$sql = "UPDATE mantenimientos 
        SET tipo_mantenimiento='$tipo_mantenimiento', problema='$problema', descripcion='$descripcion', fecha='$fecha', id_equipo='$id_equipo', quien_cc='$quien_cc'
        WHERE id='$id'";

// Ejecutamos el Query
$query = mysqli_query($conect, $sql);

if ($query) {
    //Header("Location: index.php");
    echo '<script language="javascript">alert("mantenimiento actualizado con éxito");window.location.href="listar_mantenimientos.php"</script>';
} else {
    echo '<script language="javascript">alert("Error al actualizar el mantenimiento: '.mysqli_error($conect).'");window.location.href="listar_mantenimientos.php"</script>';
}

?>
