<?php
// Incluimos el archivo connection
include('../bd/connection.php');

$conect = connection();

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos el nombre de la marca del formulario
    $name = $_POST["nombre"];

    // Verificamos si el nombre de la marca está vacío
    if (empty($name)) {
        echo '<script language="javascript">alert("Falta ingresar el nombre de la marca");window.location.href="listar_marca.php"</script>';
    } else {
        // Consultamos si la marca ya existe en la base de datos
        $sql_check = "SELECT * FROM marcas WHERE nombre = '$name'";
        $query_check = mysqli_query($conect, $sql_check);

        // Verificamos si la consulta fue exitosa
        if ($query_check) {
            // Verificamos si ya existe una marca con ese nombre
            if (mysqli_num_rows($query_check) > 0) {
                echo '<script language="javascript">alert("La marca ya existe en la base de datos");window.location.href="listar_marca.php"</script>';
            } else {
                // Insertamos la nueva marca en la base de datos
                $sql_insert = "INSERT INTO marcas (nombre) VALUES ('$name')";
                $query_insert = mysqli_query($conect, $sql_insert);

                // Verificamos si la inserción fue exitosa
                if ($query_insert) {
                    echo '<script language="javascript">alert("Marca agregada con éxito");window.location.href="listar_marca.php"</script>';
                } else {
                    echo "Error al insertar la marca: " . mysqli_error($conect);
                }
            }
        } else {
            echo "Error al verificar la existencia de la marca: " . mysqli_error($conect);
        }
    }
} else {
    echo "Acceso denegado";
}
?>
