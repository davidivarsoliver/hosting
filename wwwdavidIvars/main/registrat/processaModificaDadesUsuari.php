<?php
    session_start();

    $error="";
    if(isset($_GET['error'])) {
        $error=$_GET['error'];
    }
    
    $servidor = "ticsimarro.org";
    $usuari = "2daw10_daw";
    $contrasenya = "10261690";
    $basedades = "2daw10_daw";

    $nom = $_POST["nom"];
    $cognom = $_POST["cognom"];
    $email = $_POST["email"];
    $clauusuari = $_POST["contra1"];
    $clauusuari2 = $_POST["contra2"];
    $tipuscompte = $_POST["tipus_compte"];

    if ($clauusuari == "" && $clauusuari2 == "") { 
        $consulta_sql="UPDATE hosting_davidIvars SET nom = '$nom', cognoms = '$cognom', tipuscompte = '$tipuscompte' WHERE correu = '$email'"; 
        $dades_modificades = "false";

    } elseif ($clauusuari != $clauusuari2) {
        var_dump("Entra");
        header('Location: modificaDadesUsuari.php?contra_coincidixen=contra_coincidixen&correu1='.$email);
        die(); 
    
    } else { 
        $clau_encripta1 = password_hash($clauusuari, PASSWORD_BCRYPT);
        $consulta_sql="UPDATE hosting_davidIvars SET nom = '$nom', cognoms = '$cognom', clauusuari = '$clau_encripta1' ,tipuscompte = '$tipuscompte' WHERE correu = '$email'"; 
        $dades_modificades = "true"; 
       
    }

    $connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
    
    if (!$connexio) {
            die ("Error de connexió: ".mysqli_connect_error ());
    } else {
        ?>
        <?php
    }

    mysqli_query($connexio, $consulta_sql);  

    
    mysqli_close($connexio);

    if($fp=fopen("../../logs/usuaris.log","a")){
        fputs($fp,"Usuari modificat –  Correu: " .$email. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
        fclose($fp);
    
    } else { 
        echo "Error Obrint el fitxer <br/>";
    }

    header('Location: dadesUsuari.php?correu1='.$email.'&dades_modificades='.$dades_modificades);    

?>
