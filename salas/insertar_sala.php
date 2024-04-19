<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

//Obtenemos los datos en variables con le metodo POST
$id = null;
$name = $_POST["nombre"];
$id_sedes = $_POST["id_sedes"];


//Validamos que las casillas esten llenas
if ($name == "") {
    echo '<script language="javascript">alert("Falta dato Nombre");window.location.href="listar_sala.php"</script>';
}elseif ($id_sedes == "") {
    echo '<script language="javascript">alert("Falta el id de la sede");window.location.href="listar_sala.php"</script>';
}else 
{
    //Si todo se cumple Insertamos los valores obtenidos en la tabla
    $sql = "INSERT INTO salas VALUES ('$id','$name','$id_sedes')";
    //Ejecutamos el Query
    $query = mysqli_query($conect , $sql);

    //Header, una vez se inserten los datos, redirecciona al usuario al index o a recargar archivo  
    if ($query) {
    //Header("Location: index.php");
    echo '<script language="javascript">alert("Sala agregada con Exito");window.location.href="listar_sala.php"</script>';
}

}
?>