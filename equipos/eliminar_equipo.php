<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

$id=$_GET['id'];

$sql = "DELETE FROM equipos WHERE id='$id'";
//Ejecutamos el Query
$query = mysqli_query($conect , $sql);

if ($query) {
    //Header("Location: index.php");
    echo '<script language="javascript">alert("equipo eliminado con exito");window.location.href="listar_equipo.php"</script>';
}

?>