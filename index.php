<?php include('bd/connection.php'); $conect = connection(); ?>
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
<div>
   
    <nav class="navbar navbar-expand-lg navbar-dark  mb-4">
        
            <a class="navbar-brand" href="#">
                <img src="unimayor.png" alt="Logo" width="70" height="70" name="logo" onclick="reloadPage()">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="equipos/listar_equipo.php" class="nav-link btn btn-primary btn-lg btn-block glowbutton me-2 mb-2">Equipos</a>
                    </li>
                    <li class="nav-item">
                        <a href="mantenimientos/listar_mantenimientos.php" class="nav-link btn btn-primary btn-lg btn-block glowbutton me-2 mb-2">Mantenimientos</a>
                    </li>
                    <li class="nav-item">
                        <a href="sedes/listar_sedes.php" class="nav-link btn btn-primary btn-lg btn-block glowbutton me-2 mb-2">Sedes</a>
                    </li>
                    <li class="nav-item">
                        <a href="salas/listar_sala.php" class="nav-link btn btn-primary btn-lg btn-block glowbutton me-2 mb-2">Salas</a>
                    </li>
                    <li class="nav-item">
                        <a href="marcas/listar_marca.php" class="nav-link btn btn-primary btn-lg btn-block glowbutton me-2 mb-2">Marcas</a>
                    </li>
                    <li class="nav-item">
                        <a href="monitores/listar_monitores.php" class="nav-link btn btn-primary btn-lg btn-block glowbutton me-2 mb-2">Monitores</a>
                    </li>
                </ul>
          
        
       </nav>
      
       </div>  
    <script>
        function reloadPage() {
            location.reload();
        }
    </script>
    
</body>

</html>
