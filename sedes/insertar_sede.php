<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos el nombre de la sede del formulario
    $name = $_POST["nombre"];

    // Verificamos si el nombre de la sede está vacío
    if (empty($name)) {
        echo '<script language="javascript">alert("Falta ingresar el nombre de la sede");window.location.href="listar_sedes.php"</script>';
    } else {
        // Consultamos si la sede ya existe en la base de datos
        $sql_check = "SELECT * FROM sedes WHERE nombre = '$name'";
        $query_check = mysqli_query($conect, $sql_check);

        // Verificamos si la consulta fue exitosa
        if ($query_check) {
            // Verificamos si ya existe una sede con ese nombre
            if (mysqli_num_rows($query_check) > 0) {
                echo '<script language="javascript">alert("La sede ya existe en la base de datos");window.location.href="listar_sedes.php"</script>';
            } else {
                // Insertamos la nueva sede en la base de datos
                $sql_insert = "INSERT INTO sedes (nombre) VALUES ('$name')";
                $query_insert = mysqli_query($conect, $sql_insert);

                // Verificamos si la inserción fue exitosa
                if ($query_insert) {
                    echo '<script language="javascript">alert("Sede agregada con éxito");window.location.href="listar_sedes.php"</script>';
                } else {
                    echo "Error al insertar la sede: " . mysqli_error($conect);
                }
            }
        } else {
            echo "Error al verificar la existencia de la sede: " . mysqli_error($conect);
        }
    }
} else {
    echo "Acceso denegado";
}
?>
