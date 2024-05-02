<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');
$conect = connection();

// Obtenemos los datos en variables con el método POST
$id = $_POST["id"];
$tipo_mantenimiento = $_POST["tipo_mantenimiento"];
$problema = $_POST["problema"];
$descripcion = $_POST["descripcion"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"]; // Agregamos la fecha_fin
$id_equipo = $_POST["id_equipo"];
$quien_cc = $_POST["quien_cc"];

// Escapar los valores ingresados por el usuario
$id = mysqli_real_escape_string($conect, $id);
$tipo_mantenimiento = mysqli_real_escape_string($conect, $tipo_mantenimiento);
$problema = mysqli_real_escape_string($conect, $problema);
$descripcion = mysqli_real_escape_string($conect, $descripcion);
$fecha_inicio = mysqli_real_escape_string($conect, $fecha_inicio);
$fecha_fin = mysqli_real_escape_string($conect, $fecha_fin);
$id_equipo = mysqli_real_escape_string($conect, $id_equipo);
$quien_cc = mysqli_real_escape_string($conect, $quien_cc);

// Si todo se cumple, actualizamos los valores en la tabla
$sql = "UPDATE mantenimientos SET tipo_mantenimiento=?, problema=?, descripcion=?, fechainicio=?, fechafin=?, id_equipo=?, quien_cc=? WHERE id=?";
$stmt = mysqli_prepare($conect, $sql);
mysqli_stmt_bind_param($stmt, "sssssiis", $tipo_mantenimiento, $problema, $descripcion, $fecha_inicio, $fecha_fin, $id_equipo, $quien_cc, $id);
$query = mysqli_stmt_execute($stmt);

if ($query) {
    // Redirigimos de vuelta a la página listar_mantenimientos.php con el id del equipo
    header("Location: listar_mantenimientos.php?id_equipo=$id_equipo");
    exit(); // Asegúrate de salir después de la redirección
} else {
    // En caso de error, mostramos un mensaje y redirigimos a la página listar_mantenimientos.php
    echo '<script language="javascript">alert("Error al actualizar el mantenimiento: ' . mysqli_error($conect) . '");window.location.href="listar_mantenimientos.php?id_equipo=' . $id_equipo . '"</script>';
}

// Cerrar la declaración preparada
mysqli_stmt_close($stmt);
?>