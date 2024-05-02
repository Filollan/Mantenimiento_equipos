<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');

$conect = connection();

// Obtenemos los datos en variables mediante el método POST
$codigo = $_POST["codigo"]; 
$tipo = $_POST["tipo"];
$id_marca = $_POST["id_marca"];
$id_sala = $_POST["id_sala"];
$fecha = $_POST["fechaingreso"];
$estado = isset($_POST["estado"]) ? 1 : 0; 

// Validamos que las casillas estén llenas
if (empty($codigo) || empty($tipo) || empty($id_marca) || empty($id_sala) || empty($fecha)) {
    echo '<script language="javascript">alert("Todos los campos son obligatorios");window.location.href="listar_equipo.php"</script>';
} else {
    // Si todo se cumple, insertamos los valores obtenidos en la tabla
    $sql = "INSERT INTO equipos (codigo, tipo, id_marca, id_sala, fechaingreso, estado) 
            VALUES ('$codigo', '$tipo', '$id_marca', '$id_sala', '$fecha', '$estado')";

    // Ejecutamos el Query
    if (mysqli_query($conect, $sql)) {
        echo '<script language="javascript">alert("Equipo agregado con éxito");window.location.href="listar_equipo.php"</script>';
    } else {
        echo '<script language="javascript">alert("Error al ejecutar inserción: ' . mysqli_error($conect) . '");window.location.href="listar_equipo.php"</script>';
    }
}

// Cerramos la conexión
mysqli_close($conect);
?>
