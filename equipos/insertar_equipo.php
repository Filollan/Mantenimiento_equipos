<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

//Obtenemos los datos en variables con le metodo POST
$id = null;
$tipo = $_POST["tipo"];
$id_marca = $_POST["id_marca"];
$id_sala = $_POST["id_sala"];

//Validamos que las casillas esten llenas
if ($tipo == "") {
    echo '<script language="javascript">alert("Falta dato tipo");window.location.href="listar_equipo.php"</script>';
}elseif ($id_marca == "") {
    echo '<script language="javascript">alert("Falta el id de la marca");window.location.href="listar_equipo.php"</script>';
}elseif ($id_sala == "") {
    echo '<script language="javascript">alert("Falta el id de la sala");window.location.href="listar_equipo.php"</script>';
}else 
{
    //Si todo se cumple Insertamos los valores obtenidos en la tabla
    $sql = "INSERT INTO equipos VALUES ('$id','$tipo','$id_marca','$id_sala')";
    //Ejecutamos el Query
    $query = mysqli_query($conect , $sql);

    //Header, una vez se inserten los datos, redirecciona al usuario al index o a recargar archivo  
    if ($query) {
        echo '<script language="javascript">alert("equipo agregada con Exito ");window.location.href="listar_equipo.php"</script>';

    } else {
        echo '<script language="javascript">alert("Error al ejecutar inserción: {$connection->error}");window.location.href="listar_equipo.php"</script>';

    }
    $conexion->close();
    
}
?>