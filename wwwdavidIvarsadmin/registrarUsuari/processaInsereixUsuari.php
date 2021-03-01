
<?php
   	session_start();
    
	if (isset($_GET['correu_desconecta'])) {
        $correu_desconectar = $_GET['correu_desconecta'];
    }

    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];
    } elseif (isset($_GET['correu'])) {
        $correu = $_GET['correu']; 
    } 

    if ($_POST["contra1"] == $_POST["contra2"]) {
      
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

        $nom = $_POST["nom"];
        $cognom = $_POST["cognom"];
        $email = $_POST["email"];
        $clauusuari = $_POST["contra1"];
        $tipuscompte = $_POST["tipus_compte"];

        $nom_imagen = $_FILES['imagen']['name'];
        $tipo_imagen = $_FILES['imagen']['type'];
        $tamaño_imagen = $_FILES['imagen']['size'];
 
       
        if ($tamaño_imagen <= 200000 ) {

            $clau_encripta = password_hash($clauusuari, PASSWORD_BCRYPT);

            $sql1="SELECT correu FROM hosting_davidIvars WHERE correu = '$email'"; 
            $resultat = mysqli_query($connexio, $sql1);  

          
            if (mysqli_num_rows($resultat) > 0) { 

                header('Location: afegeixUsuari.php?email_repetit=repetit'); 
                die();

            } else { 
                if ($tamaño_imagen == 0) { 
                    $nom_foto = NULL;
    
                } else { 
                   
                    $extensio_imatge=explode("/",$tipo_imagen);
                    
                    $nom_foto = $email.".".$extensio_imatge[1]; 
                            
                
                    $carpeta_destino='https://2daw10.ticsimarro.org/wwwdavidIvars/img/img_perfil/';
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino. $nom_foto); 
                }

               
                $sql = "INSERT INTO hosting_davidIvars (nom, cognoms, correu, clauusuari, tipuscompte, fecha, imatgeperfil)
                VALUES ('$nom', '$cognom', '$email', '$clau_encripta', '$tipuscompte', now(), '$nom_foto')";

                if (mysqli_query($connexio, $sql)) { 
                    $ultim_id = mysqli_insert_id($connexio); 
                    echo "Nou registre creat amb èxit. Últim id: ".$ultim_id;
                } else {  
                    echo "Error: ". $sql . "<br/>" . mysqli_error ($connexio);
                }

            
                if($fp=fopen("../logs/admin.log","a")){
                						
                    fputs($fp,"Nou usuari creat per –  Correu: " .$correu. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
                    fclose($fp);

                } else { 
                    echo "Error Obrint el fitxer <br/>";
                }
            }

        } else {
            header('Location: afegeixUsuari.php?imatge_gran=gran');
        } 
      
        mysqli_close($connexio);

    } else {
      
        header('Location: afegeixUsuari.php?error=password');
    }

    header('Location: https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/admin.php?afegeixUsuari=true');

?>


