<?php
include('bd/connection.php');

$conect = connection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">

    <title>Mantenimiento de Equipos</title>
</head>

<body class="container">

    <header class="text-center mb-5">
        <h1 class="text-white">Mantenimiento de Equipos</h1>
    </header>

    <div class="d-flex align-content-start flex-wrap  ">
        <div class="col-md-2 col-sm-3">
            <a href="sedes/listar_sedes.php" class="btn btn-primary btn-lg btn-block glowbutton">Sedes</a>
        </div>
        <div class="col-md-2 col-sm-3">
            <a href="salas/listar_sala.php" class="btn btn-primary btn-lg btn-block glowbutton">Salas</a>
        </div>
        <div class="col-md-2 col-sm-3">
            <a href="marcas/listar_marca.php" class="btn btn-primary btn-lg btn-block glowbutton">Marcas</a>
        </div>
        <div class="col-md-2 col-sm-3">
            <a href="equipos/listar_equipo.php" class="btn btn-primary btn-lg btn-block glowbutton">Equipos</a>
        </div>
        <div class="col-md-2 col-sm-3">
            <a href="monitores/listar_monitores.php" class="btn btn-primary btn-lg btn-block glowbutton">Monitores</a>
        </div>
        <div class="col-md-2 col-sm-3">
            <a href="mantenimientos/listar_mantenimientos.php" class="btn btn-primary btn-lg btn-block glowbutton">Mantenimientos</a>

        </div>


       

</body>

</html>