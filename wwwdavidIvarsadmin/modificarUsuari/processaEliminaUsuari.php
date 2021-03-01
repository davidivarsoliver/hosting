<?php
	session_start();

	if (isset($_GET['correu1'])) {
		$correu_a_borrar = $_GET['correu1'];
	}


    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];
    } elseif (isset($_GET['correu'])) {
        $correu = $_GET['correu']; 
	} 
	
	$id1 = $_GET["id1"];

	?>
	
	<span style="color: white;"><?php echo $id ?></span>
	
	<?php
	
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
		
    $consulta_sql="DELETE FROM hosting_davidIvars WHERE idUsuari = '$id1'"; 

   
	$sql_nom1="SELECT imatgeperfil FROM hosting_davidIvars WHERE idUsuari = '$id1'"; 
	$resultat1 = mysqli_query($connexio, $sql_nom1); 
	while ($mostrar1=mysqli_fetch_array($resultat1)) { 
		$foto=$mostrar1['imatgeperfil'];
	}
	

	$ruta = "/var/www/html/wwwdavidIvars/img/img_perfil/$foto";
	if (!unlink($ruta)) {
		echo "You have an error";
	} else {
		echo "Photo deleted";
	}
	
	if($fp=fopen("../logs/admin.log","a")){
							
		fputs($fp,"Usuari donat de baixa per –  Correu: " .$correu. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
		fclose($fp);

	} else { 
		echo "Error Obrint el fitxer <br/>";
	}


	mysqli_query($connexio, $consulta_sql);  
 
	mysqli_close($connexio);
	
	
	header('Location: https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/admin.php');

?>