<?php
    session_start();

    $error="";
    if(isset($_GET['error'])) {
        $error=$_GET['error'];
    }
    
    
  
    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];
    } elseif (isset($_GET['correu'])) {
        $correu = $_GET['correu']; 
    } 


    $servidor = "ticsimarro.org";
    $usuari = "2daw10_daw";
    $contrasenya = "10261690";
    $basedades = "2daw10_daw";

  
    $nom = $_POST["nom"];
    $cognoms = $_POST["cognoms"];
    $email = $_POST["correu"];
    $clauusuari = $_POST["contra1"];
    $clauusuari2 = $_POST["contra2"];
    $tipuscompte = $_POST["tipus_compte"];
    $id1 = $_POST["id"];

    $nom_imagen = $_FILES['imagen']['name'];
    $tipo_imagen = $_FILES['imagen']['type'];
    $tamaño_imagen = $_FILES['imagen']['size'];

    echo $nom_imagen;
    if ($tamaño_imagen <= 200000 ) {

        if ($tamaño_imagen == 0) {
        
            $nom_foto = NULL;
       
        } else { 
            $extensio_imatge=explode("/",$tipo_imagen); 
         
            $nom_foto = $email.".".$extensio_imatge[1];
                    
         
            $carpeta_destino='https://2daw10.ticsimarro.org/wwwdavidIvars/img/img_perfil/';
            move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino. $nom_foto);
        }

    } else { 
            header('Location: registre.php?imatge_gran=gran'); 
    }

    
    if ($clauusuari == "" && $clauusuari2 == "") { 
        $consulta_sql="UPDATE hosting_davidIvars SET nom = '$nom', cognoms = '$cognoms', tipuscompte = '$tipuscompte', imatgeperfil = '$nom_foto' WHERE correu = '$email'"; 
        $dades_modificades = "false";

    } elseif ($clauusuari != $clauusuari2) { 
        var_dump("Entra");
        header('Location: modificaDadesUsuari.php?contra_coincidixen=contra_coincidixen&id1='.$id1.'&correu='.$email);
        die(); 
    
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

    if($fp=fopen("../logs/admin.log","a")){
        fputs($fp,"Usuari modificat per –  Correu: " .$correu. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
        fclose($fp);
    
    } else {
        echo "No s' ha pogut obrir el fitxer <br/>";
    }

    header('Location: ../admin.php');
?>
