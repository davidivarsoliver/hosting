<?php
    $error="";
    if(isset($_GET['error'])) {
        $error=$_GET['error'];
    }

    $email_repetit="";
    if (isset($_GET['email_repetit'])) {
        $email_repetit=$_GET['email_repetit'];
    }

    $imatge_gran="";
    if (isset($_GET['imatge_gran'])) {
        $imatge_gran=$_GET['imatge_gran'];
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
    
    <link rel="stylesheet" href="css/registre.css">
    <title>Registrar Usuario</title>
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
    <h2>REGISTRE DE NOU USUARI</h2>

    <div class="div_formulario">
    <form action="processaRegistre.php" enctype="multipart/form-data" method="post" class="formulario">

        <div style="display: flex; ">
            <fieldset>
                <label for="fname">NOM </label>
            </fieldset>
            <fieldset>
                <input type="text" id="fname" name="nom" required><br><br>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">COGNOMS </label>
            </fieldset>
            <fieldset>
                <input type="text" id="lname" name="cognom" required><br><br>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">EMAIL </label>
            </fieldset>
            <fieldset>
                <input type="email" id="lname" name="email" required ><br><br>
                <?php
                if ($email_repetit == "repetit"){ 
                    ?>
                    
                    <span style="font-family: monospace; color: red">Email ja existent !</span> 
                    
                    <?php
                }?>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">CONTRASENYA </label>
            </fieldset>
            <fieldset>
                <input type="password" id="lname" name="contra1" minlength="6" required ><?php 
              
                
                if ($error == "password"){ 
                    ?>
                    
                    <span style="font-family: monospace; color: red">Contrasenyes no coincideixen</span> 
                    
                    <?php
                }
                ?> 
            </fieldset>
        </div>
        
        <div style="display: flex; ">
            <fieldset>
                <label for="lname">CONFIRMAR CONTRASENYA </label>
            </fieldset>
            <fieldset>
                <input type="password" id="lname" name="contra2" minlength="6" required><br><br>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">TIPUS DE COMPTE </label>
            </fieldset>
            <fieldset>
                <select name="tipus_compte" size="1" required>
                    <option>Normal</option>
                    <option>Premium</option>
                </select>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">Imagen de perfil (màxim 200KB)</label>
            </fieldset>
            <fieldset>
                <input type="file" name="imagen" accept="image/png,image/gif,image/jpeg,image/jpg" />
                <?php
                if ($imatge_gran == "gran"){ 
                    ?>
                    
                    <span style="font-family: monospace; color: red">Imatge superior a 200kb!!!</span> 
                    
                    <?php
                }?>
            </fieldset>
        </div>

        <br><br>
        <input type="submit" style="font-family: monospace;" value="TRAMITAR">

    </form>
    </div>

    <h3 style="font-size: 30px;"><a href="../../index.php">TORNAR AL INICI</a></h3>
    
    <h3>IES SIMARRO <br> DAW <br> CURS 2020/2021</h3>

    
    
</body>
</html>
