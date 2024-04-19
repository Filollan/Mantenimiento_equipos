<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

//Obtenemos los datos en variables con le metodo POST
$cc = $_POST["cc"];
$name = $_POST["nombre"];


//Si todo se cumple Insertamos los valores obtenidos en la tabla
$sql = "UPDATE monitores SET nombre='$name'  WHERE cc='$cc' ";
//Ejecutamos el Query
$query = mysqli_query($conect , $sql);

if ($query) {
    //Header("Location: index.php");
    echo '<script language="javascript">alert("monitor actualizado con exito");window.location.href="listar_monitores.php"</script>';
}

?>