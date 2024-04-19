<?php
//Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

//Obtenemos los datos en variables con le metodo POST
$cc = $_POST["cc"];
$name = $_POST["nombre"];


//Validamos que las casillas esten llenas
if ($cc == "") {
    echo '<script language="javascript">alert("Falta la cedula");window.location.href="listar_monitores.php"</script>';
}elseif ($name == "") {
    echo '<script language="javascript">alert("Falta el nombre");window.location.href="listar_monitores.php"</script>';
}else 
{
    //Si todo se cumple Insertamos los valores obtenidos en la tabla
    $sql = "INSERT INTO monitores VALUES ('$cc','$name')";
    //Ejecutamos el Query
    $query = mysqli_query($conect , $sql);

    //Header, una vez se inserten los datos, redirecciona al usuario al index o a recargar archivo  
    if ($query) {
    //Header("Location: index.php");
    echo '<script language="javascript">alert("monitor agregado con Exito");window.location.href="listar_monitores.php"</script>';
}

}
?>