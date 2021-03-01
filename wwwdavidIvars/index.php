<?php
    session_start();

    $servidor = "ticsimarro.org";
    $usuari = "2daw10_daw";
    $contrasenya = "10261690";
    $basedades = "2daw10_daw";
   
    $connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
  
    if (!$connexio) {
            die ("Error de connexió: ".mysqli_connect_error ());
    } else {
        ?>
     
        <?php
    }

    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];

        $sql_nom1="SELECT * FROM hosting_davidIvars WHERE correu = '$correu'"; 
        $resultat1 = mysqli_query($connexio, $sql_nom1);  
        while ($mostrar1=mysqli_fetch_array($resultat1)) {  
   
            $nom_foto=$mostrar1['imatgeperfil'];
        }
       

        if ($nom_foto == "") { 
            $nom_foto = "imatge_per_defecte.png";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/index.css">
    <title>HOSTING</title>
</head>
<body>
    
    <h1>DAVID_HOSTING</h1>

  

    <nav class="navbar navbar-light bg-light">
        <div class="container">
        <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/index.php">Inici</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/main/registrat/login.php">Registrat</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/admin.php">Admin</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/main/registrarse/registre.php">Registrarse</a></li>
        </div>
    </nav>

    <div class="contenedor">
    
        <div class="div_izq">
            <h2><a href="main/registrat/registrat.php">LOGIN</a></h2>
            <a title="Usuari registrat" href="main/registrat/registrat.php"><img src="img/puerta.png" alt="usuari" width="250" height="250"></a>
        </div>

        <div class="div_cen">
            <h2><a href="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/login.php">ADMINISTRACIÓ</a></h2>
            <a title="Usuari registrat" href="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/login.php"><img src="img/admin.png" alt="usuari" width="250" height="250"></a>
        </div>


        <div class="div_der">
            <h2><a href="main/registrarse/registre.php">REGISTRAT</a></h2>
            <a title="Usuari registrat" href="main/registrarse/registre.php"><img src="img/registro.png" alt="usuari" width="250" height="250"></a>
        </div>

    </div>
    
    <h3>IES SIMARRO <br> DAW <br> CURS 2020/2021</h3>
    
</body>
</html>
