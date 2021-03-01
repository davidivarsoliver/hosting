<?php
	session_start();
	if (isset($_GET['correu_desconecta'])) {
        $correu_desconectar = $_GET['correu_desconecta'];
    }

    if($fp=fopen("logs/admin.log","a")){
					
        fputs($fp,"Usuari abandona el sistema –  Correu: " .$correu_desconectar. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
        fclose($fp);

    } else { 
        echo "No s'ha obert el fitxer <br/>";
    }

	session_unset();
	session_destroy();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
	header("Location: login.php");
	die();
?>