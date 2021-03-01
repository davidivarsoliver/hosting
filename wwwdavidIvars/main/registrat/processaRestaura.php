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

    $sql1="SELECT correu FROM hosting_davidIvars WHERE correu = '$correu'"; 
    $resultat = mysqli_query($connexio, $sql1);  

    
    if (mysqli_num_rows($resultat) > 0) { 
        
        
        function generar_contra($num) {
            $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            return substr(str_shuffle($data), 0, $num);
        }

        $contra_nova = generar_contra(6);
        $clau_encripta1 = password_hash($contra_nova, PASSWORD_BCRYPT);
        $consulta_sql="UPDATE hosting_davidIvars SET clauusuari = '$clau_encripta1' WHERE correu = '$correu'"; 

        
        $connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
        
        if (!$connexio) {
                die ("Error de connexió: ".mysqli_connect_error ());
        } else {
            ?>
            
            <?php
        }

        mysqli_query($connexio, $consulta_sql);  

        
        mysqli_close($connexio);

       
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

        $mail->isHTML(true);
        $contingut = '
        <div>
        <p>Estimat/da usuaria '.$correu.' <br>
        Hem rebut la teua sol·licitud de canvi de contrasenya. <br>
        La teua nova contrasenya és: '.$contra_nova.' <br>
        Ja pots accedir al teu hosting.
        Salutacions</p>
        </div>
        ';


        $mail->Subject = 'Bienvenido A TicSimarro David Ivars Oliver'; 
        $mail->From = "davidivars9@gmail.com"; 
        $mail->FromName = "David Empire"; 
        $mail->Sender = $correu; 
        $mail->AddReplyTo("davidivars9@gmail.com","David Empire");
        $mail->AddAddress("davidivars9@gmail.com", "$nom $cognom");
        $mail->AddBCC("davidivars9@gmail.com");
        $mail->AddBCC($correu);
        $mail->MsgHTML($contingut);
        $mail->AltBody = "Nueva contraseña";

        if(!$mail->Send()) {
            echo '<p>Error a l\'enviament del correu '.$mail->ErrorInfo.' </p>';
        } else {
            echo '<p style="color: white;">Correu correctament enviat.</p>';
        }
                   
        if($fp=fopen("../../logs/usuaris.log","a")){
            fputs($fp,"Usuari Restaura Contrasenya: " .$correu. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
            fclose($fp);
        
        } else { 
            echo "No s'ha pogut obrir el fitxer... <br/>";
        }

        
        header('Location: registrat.php');

    } else {
        header('Location: restaura.php?email_no_trobat=email_no_trobat');
        include("registrat.php");
    }

?>