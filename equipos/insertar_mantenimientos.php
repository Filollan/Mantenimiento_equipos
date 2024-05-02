<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');

$conect = connection();

// Obtener los datos del formulario
$id_equipo = $_POST['id_equipo'];
$tipo_mantenimiento = $_POST['tipo_mantenimiento'];
$problema = $_POST['problema'];
$fecha_inicio = $_POST['fecha'];
$quien_cc = $_POST['quien_cc'];

// Validar que todos los campos requeridos estén presentes
if (empty($id_equipo) || empty($tipo_mantenimiento) || empty($problema) || empty($fecha_inicio) || empty($quien_cc)) {
    echo '<script language="javascript">alert("Por favor, complete todos los campos requeridos");window.location:listar_mantenimientos.php?id_equipo=$id_equipo"</script>';
    exit();
}

// Escapar los valores ingresados por el usuario
$id_equipo = mysqli_real_escape_string($conect, $id_equipo);
$tipo_mantenimiento = mysqli_real_escape_string($conect, $tipo_mantenimiento);
$problema = mysqli_real_escape_string($conect, $problema);
$fecha_inicio = mysqli_real_escape_string($conect, $fecha_inicio);
$quien_cc = mysqli_real_escape_string($conect, $quien_cc);

// Insertar el nuevo mantenimiento en la tabla 'mantenimientos'
$sql_insert_mantenimiento = "INSERT INTO mantenimientos (tipo_mantenimiento, problema, fechainicio, quien_cc, id_equipo) VALUES (?, ?, ?, ?, ?)";
$stmt_insert_mantenimiento = mysqli_prepare($conect, $sql_insert_mantenimiento);
mysqli_stmt_bind_param($stmt_insert_mantenimiento, "ssssi", $tipo_mantenimiento, $problema, $fecha_inicio, $quien_cc, $id_equipo);
$query_insert_mantenimiento = mysqli_stmt_execute($stmt_insert_mantenimiento);
mysqli_stmt_close($stmt_insert_mantenimiento);

// Verificar si la inserción fue exitosa
if ($query_insert_mantenimiento) {
    // Redireccionar a listar_mantenimientos.php con el id_equipo correspondiente
    header("Location: listar_mantenimientos.php?id_equipo=$id_equipo");
    exit(); // Asegúrate de salir después de la redirección
} else {
    echo '<script language="javascript">alert("Error al registrar el mantenimiento");window.location:listar_mantenimientos.php?id_equipo=$id_equipo"</script>';
}

// Cerramos la conexión
mysqli_close($conect);
?>
