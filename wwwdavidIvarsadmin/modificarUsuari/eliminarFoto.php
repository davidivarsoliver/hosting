<?php

    $correu = $_GET['correu'];
    $id = $_GET['id'];

    
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


    $sql_nom1="SELECT imatgeperfil FROM hosting_davidIvars WHERE idUsuari = '$id'"; 
    $resultat1 = mysqli_query($connexio, $sql_nom1);  
    while ($mostrar1=mysqli_fetch_array($resultat1)) { 
        $foto=$mostrar1['imatgeperfil'];
    }

    $consulta_sql="UPDATE hosting_davidIvars SET imatgeperfil = '' WHERE correu = '$correu'"; 

    mysqli_query($connexio, $consulta_sql); 

  
    mysqli_close($connexio);

    echo $foto;
    
    
    $ruta = "../../../wwwdavidIvars/img/img_perfil/$foto";
    if (!unlink($ruta)) {
        echo "You have an error";
    } else {
        echo "Photo deleted";
    }


    header('Location: ../modificarUsuari/modificaDadesUsuari.php?id1='.$id);    



?>