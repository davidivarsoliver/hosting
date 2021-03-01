
<?php 


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    

    $email_no_trobat="";
    if (isset($_GET['email_no_trobat'])) {
        $email_no_trobat=$_GET['email_no_trobat'];
    }

 
    $contraseña_no_troba="";
    if (isset($_GET['contraseña_no_troba'])) {
        $contraseña_no_troba=$_GET['contraseña_no_troba'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>LOGIN</title>
</head>
<body>
    

    <div class="div_formulario">
    <form action="procesaRegistre.php" method="post" class="formulario">

        <div style="display: flex; ">
            <fieldset>
                <label for="fname">CORREU</label>
            </fieldset>
            <fieldset>
                <input type="text" id="fname" name="correu" required><br><br>
                <?php
                if ($email_no_trobat == "email_no_trobat"){ 
                    ?>
                    
                    <span style="font-family: monospace; color: red">Correu no existent !</span> 
                    
                    <?php
                }?>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">CONTRASEÑA</label>
            </fieldset>
            <fieldset>
                <input type="password" id="lname" name="contra" required><br><br>
                <?php
                if ($contraseña_no_troba == "contraseña_no_troba"){ 
                    ?>
                    
                    <span style="font-family: monospace; color: red">Contraseña incorrecta !</span> 
                    
                    <?php
                }?>
            </fieldset>
        </div>

        <br>
        <input type="submit" style="font-family: monospace;" value="TRAMITAR">
    </form>

    </div>
    <br><br>
    
    <h2><a style="color: blue;" href="registrat.php?restaurar=restaurar">HE OLVIDAT LA CONTRASENYA</a></h2>

    <br><br>
    
    <h2><a href="../../index.php">TORNAR AL INICI</a></h2>

    <h3>IES SIMARRO <br> DAW <br> CURS 2020/2021</h3>

</body>
</html>