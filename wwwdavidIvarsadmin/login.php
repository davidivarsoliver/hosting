
<?php 


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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <title>LOGIN</title>
</head>
<body style="background-color: blue;">


<h1 style="font-size: 35px;">LOGIN ADMIN</h1>




    <div class="div_formulario">
    <form action="procesaLoginAdmin.php" method="post" class="formulario">

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
                <label for="lname">CONTRASENYA</label>
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
    
         

<h3>IES SIMARRO <br> DAW <br> CURS 2020/2021</h3>

</body>
</html>