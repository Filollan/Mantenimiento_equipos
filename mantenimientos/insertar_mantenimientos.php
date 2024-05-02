<?php
// Incluimos el archivo de conexión
include('../bd/connection.php');

// Verificamos si se enviaron los datos del formulario mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conect = connection(); // Establecemos la conexión dentro del condicional para evitar errores si se envía el formulario

    // Obtenemos los datos del formulario
    $id_equipo = isset($_POST['id_equipo']) ? $_POST['id_equipo'] : null;
    $tipo_mantenimiento = isset($_POST['tipo_mantenimiento']) ? $_POST['tipo_mantenimiento'] : null;
    $problema = isset($_POST['problema']) ? $_POST['problema'] : null;
    $fecha_inicio = isset($_POST['fecha']) ? $_POST['fecha'] : null;
    $quien_cc = isset($_POST['quien_cc']) ? $_POST['quien_cc'] : null;

    // Validar que todos los campos requeridos estén presentes
    if (empty($id_equipo) || empty($tipo_mantenimiento) || empty($problema) || empty($fecha_inicio) || empty($quien_cc)) {
        echo '<script>alert("Por favor, complete todos los campos requeridos");window.location.href="listar_mantenimientos.php";</script>';
        exit();
    }

    // Escapar los valores ingresados por el usuario para evitar inyección SQL
    $id_equipo = mysqli_real_escape_string($conect, $id_equipo);
    $tipo_mantenimiento = mysqli_real_escape_string($conect, $tipo_mantenimiento);
    $problema = mysqli_real_escape_string($conect, $problema);
    $fecha_inicio = mysqli_real_escape_string($conect, $fecha_inicio);
    $quien_cc = mysqli_real_escape_string($conect, $quien_cc);

    // Insertar el nuevo mantenimiento en la tabla 'mantenimientos'
    $sql_insert_mantenimiento = "INSERT INTO mantenimientos (tipo_mantenimiento, problema, fechainicio, quien_cc, id_equipo) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert_mantenimiento = mysqli_prepare($conect, $sql_insert_mantenimiento);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt_insert_mantenimiento) {
        // Vincular parámetros y ejecutar la consulta
        mysqli_stmt_bind_param($stmt_insert_mantenimiento, "ssssi", $tipo_mantenimiento, $problema, $fecha_inicio, $quien_cc, $id_equipo);
        $query_insert_mantenimiento = mysqli_stmt_execute($stmt_insert_mantenimiento);

        // Verificar si la inserción fue exitosa
        if ($query_insert_mantenimiento) {
            // Redireccionar a listar_mantenimientos.php con el id_equipo correspondiente
            header("Location: listar_mantenimientos.php?id_equipo=$id_equipo");
            exit(); // Asegúrate de salir después de la redirección
        } else {
            echo '<script>alert("Error al registrar el mantenimiento");window.location.href="listar_mantenimientos.php";</script>';
        }

        // Cerrar la declaración preparada
        mysqli_stmt_close($stmt_insert_mantenimiento);
    } else {
        echo '<script>alert("Error al preparar la consulta");window.location.href="listar_mantenimientos.php";</script>';
    }

    // Cerramos la conexión
    mysqli_close($conect);
} else {
    // Si no se envió mediante POST, redirigir a la página listar_mantenimientos.php
    header("Location: listar_mantenimientos.php");
    exit();
}
?>
