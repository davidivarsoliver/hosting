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
       
        $_SESSION['correu'] = $correu;


        if($fp=fopen("logs/admin.log","a")){
           					
            fputs($fp,"Usuari accedix al sistema –  Correu: " .$correu. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
            
            fclose($fp);

        } else { 
            echo "No s'ha pogut obrir el fitxer... <br/>";
        }

      
        header('Location: admin.php');

    } else { 
        header('Location: login.php?email_no_trobat=email_no_trobat');
        header('Location: login.php?contraseña_no_troba=contraseña_no_troba');
        include("admin.php?primer_login=1");
    }

?>