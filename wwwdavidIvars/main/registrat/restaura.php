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
    <title>RESTAURA CONTRASENYA</title>
</head>
<body>
    <h1 style="font-size: 35px;">RESTAURAR CONTRASENYA</h1>

    <div class="div_formulario">
    <form action="processaRestaura.php" method="post" class="formulario">

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

        <br>
        <input type="submit" style="font-family: monospace;" value="TRAMITAR">
    </form>

    </div>

    <br><br>
    
    <h2><a href="../../index.php">TORNAR AL INICI</a></h2>

    <h3>IES SIMARRO <br> DAW <br> CURS 2020/2021</h3>

</body>
</html>