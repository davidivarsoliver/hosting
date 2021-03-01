<?php
    
    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];
    } elseif (isset($_GET['correu'])) {
        $correu = $_GET['correu'];
    } 

    echo $correu;

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
        
   
    $dia = date('jnY').date('_His');
    echo "backup_$dia.txt";
    
    $cadena = "idUsuari::nom::cognom::correu::clauusuari::tipuscompte::fecha::imatgeperfil \n";
    $frase = "";

    
    $archivo = fopen("backups/backup_$dia.txt", "w");
    fwrite($archivo, $cadena); 
    
    $sql_nom1="SELECT * FROM hosting_davidIvars "; 
    $resultat1 = mysqli_query($connexio, $sql_nom1); 
    while ($mostrar1=mysqli_fetch_array($resultat1)) { 
        $idusuari1=$mostrar1['idUsuari'];
        $nom1=$mostrar1['nom'];
        $cognom1=$mostrar1['cognoms'];
        $correu1=$mostrar1['correu'];
        $clauusuari=$mostrar1['clauusuari'];
        $tipuscompte1=$mostrar1['tipuscompte'];
        $fecha1=$mostrar1['fecha'];
        $imatgeperfil1=$mostrar1['imatgeperfil'];

       
        $frase = $idusuari1."::".$nom1."::".$cognom1."::".$correu1."::".$clauusuari."::".$tipuscompte1."::".$fecha1."::".$imatgeperfil1." \n";

        
        fwrite($archivo, $frase); 
    }
    fclose($archivo);

    if($fp=fopen("./logs/admin.log","a")){
      
        fputs($fp,"Backup realitzat per –  Correu: " .$correu. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
        fclose($fp);
        
    } else { 
        echo "No s'ha pogut obrir el fitxer... <br/>";
    }


    header('Location: https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/admin.php');

?>