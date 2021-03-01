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
        <span style="color: white;">Conexio amb exit</span> <?php
    }

    $correu = $_POST["correu"];
    $contrassenya_usuari = $_POST["contra"];

    $sql1="SELECT correu FROM hosting_davidIvars WHERE correu = '$correu'"; 
    $resultat = mysqli_query($connexio, $sql1); 

    $sql2="SELECT clauusuari FROM hosting_davidIvars WHERE correu = '$correu'";
    $resultat2 = mysqli_query($connexio, $sql2); 

    
    if (mysqli_num_rows($resultat) > 0 && password_verify($contrassenya_usuari , mysqli_fetch_array($resultat2)['clauusuari']) ) { 
       
        
       
        $sql_nom1="SELECT * FROM hosting_davidIvars WHERE correu = '$correu'"; 
        $resultat1 = mysqli_query($connexio, $sql_nom1); 
        while ($mostrar1=mysqli_fetch_array($resultat1)) { 
            $nom1=$mostrar1['nom'];
            $cognom1=$mostrar1['cognoms'];
            $correu1=$mostrar1['correu'];
            $tipuscompte1=$mostrar1['tipuscompte'];
        }

        
        $_SESSION['correu'] = $correu;

        
        header('Location: registrat.php');

    } else { 
        header('Location: login.php?email_no_trobat=email_no_trobat');
        header('Location: login.php?contraseña_no_troba=contraseña_no_troba');
        include("registrat.php");
    }

?>