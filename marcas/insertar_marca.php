<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

//Obtenemos los datos en variables con le metodo POST
$id = null;
$name = $_POST["nombre"];


//Validamos que las casillas esten llenas
if ($name == "") {
    echo '<script language="javascript">alert("Falta dato Nombre");window.location.href="index.php"</script>';
}else 
{
    //Si todo se cumple Insertamos los valores obtenidos en la tabla
    $sql = "INSERT INTO marcas VALUES ('$id','$name')";
    //Ejecutamos el Query
    $query = mysqli_query($conect , $sql);

    //Header, una vez se inserten los datos, redirecciona al usuario al index o a recargar archivo  
    if ($query) {
    //Header("Location: index.php");
    echo '<script language="javascript">alert("marca agregada con Exito");window.location.href="listar_marca.php"</script>';
}

}
?>