
<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

  
    if (isset($_GET['visualitza'])) {
        $visualitza = $_GET['visualitza'];
    } else {
        $visualitza = "false";
    }

    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];
    }

    if (isset($_GET['restaurar'])) {
        $restaurar = $_GET['restaurar'];
    } else {
        $restaurar = "";
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/usuari_registrat.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <title>REGISTRAT</title>
</head>

<body>

    <h1 style="font-size: 35px;">DAVID_HOSTING LOGIN USER</h1>

    <nav class="navbar navbar-light bg-light">
        <div class="container">
        <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/index.php">Inici</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/plantilles/login.php">Registrat</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/admin.php">Admin</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/registre.php">Registrarse</a></li>
        </div>
    </nav>

    <br>
    
    <?php
    

    if (isset($_SESSION['correu']) ) { 
        include("dadesUsuari.php");
        if ($visualitza == "true") {
            ?>
            <h1 style="background-color: greenyellow ;color: #1E2425;">LogOut <?php echo $correu ?> </h1><br>
            <?php
            include("visualitzaLog.php");
        }
    } elseif ($restaurar == 'restaurar') {
        include("restaura.php");
        
    } else {
        include("login.php");
    }

    ?>

    <br>
 
</body>

</html>
