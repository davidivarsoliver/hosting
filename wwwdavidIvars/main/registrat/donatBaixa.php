<?php
	session_start();

    if (isset($_GET['correu1'])) {
        $correu_a_borrar = $_GET['correu1'];
    }

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
		
    $consulta_sql="DELETE FROM hosting_davidIvars WHERE correu = '$correu_a_borrar'"; 

	mysqli_query($connexio, $consulta_sql);  
    mysqli_close($connexio);

	

	if($fp=fopen("../../logs/usuaris.log","a")){
		fputs($fp,"Usuari donat de baixa –  Correu: " .$correu_a_borrar. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
		fclose($fp);

	} else { 
		echo "No s'ha pogut obrir el fitxer... <br/>";
	}


	session_unset();
	session_destroy();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);

	header("Location: ../../index.php");
	die();
?>