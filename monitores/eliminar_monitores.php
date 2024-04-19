<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

$cc=$_GET['cc'];

$sql = "DELETE FROM monitores WHERE cc='$cc'";
//Ejecutamos el Query
$query = mysqli_query($conect , $sql);

if ($query) {
    //Header("Location: index.php");
    echo '<script language="javascript">alert("Monitor eliminado con exito");;window.location.href="listar_monitores.php"</script>';
}

?>