<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Obtenemos los datos en variables con el método POST
$id = null;
$tipo_mantenimiento = $_POST["tipo_mantenimiento"];
$problema = $_POST["problema"];
$descripcion = $_POST["descripcion"];
$fecha = $_POST["fecha"];
$id_equipo = $_POST["id_equipo"];
$quien_cc = $_POST["quien_cc"];

// Validamos que las casillas estén llenas
if ($tipo_mantenimiento == "") {
    echo '<script language="javascript">alert("Falta el tipo de mantenimiento");window.location.href="listar_mantenimientos.php"</script>';
} elseif ($problema == "") {
    echo '<script language="javascript">alert("Falta el problema");window.location.href="listar_mantenimientos.php"</script>';
} elseif ($descripcion == "") {
    echo '<script language="javascript">alert("Falta la descripción");window.location.href="listar_mantenimientos.php"</script>';
} elseif ($fecha == "") {
    echo '<script language="javascript">alert("Falta la fecha");window.location.href="listar_mantenimientos.php"</script>';
} elseif ($id_equipo == "") {
    echo '<script language="javascript">alert("Falta el ID del equipo");window.location.href="listar_mantenimientos.php"</script>';
} elseif ($quien_cc == "") {
    echo '<script language="javascript">alert("Falta la cédula del monitor");window.location.href="listar_mantenimientos.php"</script>';
} else {
    // Si todo se cumple, insertamos los valores obtenidos en la tabla
    $sql = "INSERT INTO mantenimientos VALUES ('$id','$tipo_mantenimiento','$problema', '$descripcion', '$fecha', '$id_equipo', '$quien_cc')";
    // Ejecutamos el Query
    $query = mysqli_query($conect, $sql);

    // Si la consulta se ejecuta correctamente, redirecciona al usuario a la lista de mantenimientos
    if ($query) {
        echo '<script language="javascript">alert("Mantenimiento agregado con éxito");window.location.href="listar_mantenimientos.php"</script>';
    } else {
        echo '<script language="javascript">alert("Ha ocurrido un error al agregar el mantenimiento");window.location.href="listar_mantenimientos.php"</script>';
    }
}
?>
