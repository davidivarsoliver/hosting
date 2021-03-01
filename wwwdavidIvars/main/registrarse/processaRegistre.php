<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
    require('PHPMailer/src/PHPMailer.php');
    require('PHPMailer/src/Exception.php');
    require('PHPMailer/src/SMTP.php');

    include("credencials.php");
    use credencials;


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
                        
                header('Location: registre.php?email_repetit=repetit');
                die();
                        
            } else {

                if ($tamaño_imagen == 0) { 
                    $nom_foto = NULL;
    
                } else { 
                    $extensio_imatge=explode("/",$tipo_imagen); 
                    $nom_foto = $email.".".$extensio_imatge[1]; 
                            
                    $carpeta_destino='../../img/img_perfil/';
     
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino. $nom_foto); 
                }
                
                $sql = "INSERT INTO hosting_davidIvars (nom, cognoms, correu, clauusuari, tipuscompte, fecha, imatgeperfil)
                VALUES ('$nom', '$cognom', '$email', '$clau_encripta', '$tipuscompte', now(), '$nom_foto')";
            
                if (mysqli_query($connexio, $sql)) { 
                    $ultim_id = mysqli_insert_id($connexio); 
                } else {  
                    echo "Error: ". $sql . "<br/>" . mysqli_error ($connexio);
                }
                        
                if($fp=fopen("../../logs/usuaris.log","a")){
                    fputs($fp,"Nou usuari creat –  Correu: " .$email. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
                    fclose($fp);
                            
                } else { 
                    echo "No s'ha pogut obrir el fitxer <br/>";
                }

               
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Mailer = "smtp"; 
                
        

                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $host = credencials::HOST;
                $user = credencials::USER;
                $password = credencials::PASSWORD;

                $mail->Host = $host;
                $mail->Username = $user;
                $mail->Password = $password;

             
                $mail->CharSet="utf-8";

             
                if ($_POST["tipus_compte"] == "Normal") {
                    $mail->AddEmbeddedImage('img/bobesponja_normal.jpg', 'imatgeBob', 'bobesponja_normal.jpg');
                } else {
                    $mail->AddEmbeddedImage('img/bobesponja_fuerte.png', 'imatgeBob', 'bobesponja_fuerte.png');
                }

                $mail->isHTML(true);
                $contingut = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                
                    <style>
                        body {
                            font-weight: 300;
                            line-height: 1.42em;
                            color: #A7A1AE;
                            background-color: white;
                        }
                
                        h1 {
                            font-size: 2em;
                            font-weight: 300;
                            line-height: 1em;
                            text-align: center;
                            color: #000000;
                        }
                
                        .container th h1 {
                            font-weight: bold;
                            font-size: 1em;
                            text-align: left;
                            color: #69cf15;
                        }
                
                        .container {
                            text-align: left;
                            overflow: hidden;
                            width: 80%;
                            margin: 0 auto;
                            display: table;
                        }
                
                        .container td,
                        .container th {
                            padding-bottom: 2%;
                            padding-top: 2%;
                            padding-left: 2%;
                        }
                
                    </style>
                </head>
                
                <body>
                    <table class="container">
                        <tbody>
                            <tr>
                                <td colspan="5"><img src="https://ieslluissimarro.org/wp-content/uploads/2010/01/logo.jpg" width="200px"></td>
                                <td style="text-align: center;">NUEVO USUARIO HOSTING</td>
                            </tr>
                        </tbody>
                    </table>
                
                    <h1>PROJECTE DAW 2021 <br> DATA INSCRIPCIO <br> '.date("j-n-Y")." - ". date("H:i:s").'</h1>
                    <hr>
                
                    <h1>DADES</h1>
                    <table class="container">
                        <tbody>
                            <tr>
                                <td style="text-align: center;">NOMBRE</td>
                                <td style="text-align: center;">APELLIDOS</td>
                                <td style="text-align: center;">CORREO</td>
                                <td style="text-align: center;">CONTRASEÑA</td>
                                <td style="text-align: center;">CUENTA</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">'.$nom.'</td>
                                <td style="text-align: center;">'.$cognom.'</td>
                                <td style="text-align: center;">'.$email.'</td>
                                <td style="text-align: center;">'.$clauusuari.'</td>
                                <td style="text-align: center;">'.$tipuscompte.'</td>
                            </tr>
                            <tr>
                                <td colspan="5"><img style="display:block; margin:auto;" src="cid:imatgeBob"></td>
                            </tr>
                        </tbody>
                    </table>
                
                </body>
                </html>
                ';


              
                $mail->Subject = 'Bienvenido A TicSimarro David';
                $mail->From = "davidivars9@gmail.com"; 
                $mail->FromName = "David Empire";
                $mail->Sender = $email;
                $mail->AddReplyTo("davidivars9@gmail.com","David Empire"); 
                $mail->AddAddress("davidivars9@gmail.com", "David Empire");
                $mail->AddBCC("davidivars9@gmail.com");
                $mail->AddBCC($email);
                $mail->MsgHTML($contingut);
                $mail->AltBody = "Datos del nuevo usuario";

                if(!$mail->Send()) {
                    echo '<p>Error a l\'enviament del correu '.$mail->ErrorInfo.' </p>';
                } else {
                    echo '<p style="color: white;">Correu correctament enviat.</p>';
                }
                   
            }
            

        } else { 
            header('Location: registre.php?imatge_gran=gran');
        }
        

        mysqli_close($connexio);

    } else {
        header('Location: registre.php?error=password');
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/registre2.css">
    <title>Formulari Registrat</title>
</head>

<body>

    <h1>DAVID_HOSTING</h1>
    
    <nav class="navbar navbar-light bg-light">
        <div class="container">
        <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/index.php">Inici</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/main/registrat/login.php">Registrat</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/admin.php">Admin</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/main/registrarse/registre.php">Registrarse</a></li>
        </div>
    </nav>

    <br>
    <h2>DATA DEL USUARI REGISTRAT</h2>

    <div class="mostrar_datos">

        <ul>
            <li type="disc">NOM: <?php echo $_POST["nom"]; ?></li>

            <li type="disc">COGNOM: <?php echo $_POST["cognom"]; ?></li>

            <li type="disc">EMAIL: <?php echo $_POST["email"]; ?></li>

            <li type="disc">CONTRASEÑA 01: <?php echo $_POST["contra1"]; ?></li>

            <li type="disc">CONTRASEÑA 02: <?php echo $_POST["contra2"]; ?></li>

            <li type="disc">TIPUS DE COMPTE: <?php echo $_POST["tipus_compte"]; ?></li>

            <?php
            if ($_POST["tipus_compte"] == "Normal") {
            ?>
                <br>
                <span style="font-size: 25px; font-family: monospace">Compte Normal</span>
                <li>5Gb d'espai al disc dur.</li>
                <li>3 bases de dades.</li>
                <li>1 nom de domini.</li>
                <br>
                <img src="img/bobesponja_normal.jpg" alt="foto_normal" width="250px">

            <?php
            } else {
            ?>
                <br>
                <span style="font-size: 25px; font-family: monospace">Compte Premium</span>
                <li>10Gb d'espai al disc dur.</li>
                <li>5 bases de dades.</li>
                <li>2 nom de domini.</li>
                <br>
                <img src="img/bobesponja_fuerte.png" alt="foto_normal" width="250px">

            <?php
            }
            ?>

            <ul>
    </div>

    <br><br><br>

    <div class="nom_caracters">
        <?php
        foreach (str_split(explode("@", $_POST["email"])[0]) as $char) {
            $ext = ".jpg";
            if (is_numeric($char)) { 
                $ext = ".png";
            }
            echo "<img class='nom_caracters1' src='caracters/" . $char . $ext . "' alt='" . $char . "'>";
        }
        ?>
    </div>

    <h3>
        <a href="registre.php">TORNAR AL REGISTRE</a>
        <br><br>
        <a href="../../index.php">TORNAR AL INICI</a>
    </h3>



</body>

</html>
