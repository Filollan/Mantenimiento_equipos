<?php


function connection(){

    //creamos variables para la conexion con la base de satos
    $host = "localhost:3308";
    $user = "root";
    $password = "";
    $bd = "mantenimientoss";

    //Generamos la conexion
    $connect = mysqli_connect($host,$user,$password );

    //Seleccionamos la base de datos y conexion
    mysqli_select_db($connect,$bd);

    return $connect;  
}


?>