<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

//Obtenemos los datos en variables con le metodo POST
$id = $_POST["id"];
$name = $_POST["nombre"];
$id_sedes = $_POST["id_sedes"];


//Si todo se cumple Insertamos los valores obtenidos en la tabla
$sql = "UPDATE salas SET nombre='$name' WHERE id='$id' ";
//Ejecutamos el Query
$query = mysqli_query($conect , $sql);

if ($query) {
    //Header("Location: index.php");
    echo '<script language="javascript">alert("sala actualizada con exito");window.location.href="listar_sala.php"</script>';
}

?>