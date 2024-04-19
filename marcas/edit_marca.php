<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

//Obtenemos los datos en variables con le metodo POST
$id = $_POST["id"];
$name = $_POST["nombre"];


//Si todo se cumple Insertamos los valores obtenidos en la tabla
$sql = "UPDATE marcas SET nombre='$name' WHERE id='$id' ";
//Ejecutamos el Query
$query = mysqli_query($conect , $sql);

if ($query) {
    //Header("Location: index.php");
    echo '<script language="javascript">alert("marca actualizada con exito");window.location.href="listar_marca.php"</script>';
}

?>