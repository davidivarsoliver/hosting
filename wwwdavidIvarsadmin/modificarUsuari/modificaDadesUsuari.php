<?php
    session_start();

    if (isset($_GET['correu1'])) {
        $correu_modifica = $_GET['correu1'];
    }

    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];
    } elseif (isset($_GET['correu1'])) {
        $correu = $_GET['correu1']; 
    }

    if (isset($_SESSION['id1'])) {
        $id1 = $_SESSION["id1"];
    } elseif (isset($_GET['id1'])) {
        $id1 = $_GET["id1"];
    }

    $error="";
    if(isset($_GET['error'])) {
        $error=$_GET['error'];
    }

    $contra_coincidixen="";
    if (isset($_GET['contra_coincidixen'])) {
        $contra_coincidixen=$_GET['contra_coincidixen'];
    }

    $imatge_gran="";
    if (isset($_GET['imatge_gran'])) {
        $imatge_gran=$_GET['imatge_gran'];
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

    $sql_nom1="SELECT * FROM hosting_davidIvars WHERE idUsuari = '$id1'"; 
    $resultat1 = mysqli_query($connexio, $sql_nom1);  
    while ($mostrar1=mysqli_fetch_array($resultat1)) { 
     
        $nom1=$mostrar1['nom'];
        $cognom1=$mostrar1['cognoms'];
        $correu1=$mostrar1['correu'];
        $tipuscompte1=$mostrar1['tipuscompte'];
        $foto=$mostrar1['imatgeperfil'];
    }

    
    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];

        $sql_nom1="SELECT * FROM hosting_davidIvars WHERE correu = '$correu'"; 
        $resultat1 = mysqli_query($connexio, $sql_nom1);
        while ($mostrar1=mysqli_fetch_array($resultat1)) { 
            $foto=$mostrar1['imatgeperfil'];
        }
   

        if ($foto == "") { 
            $foto = "imatge_per_defecte.png";
        }
    }
  
    $sql_nom2="SELECT * FROM hosting_davidIvars WHERE  idUsuari = '$id1'"; 
    $resultat2 = mysqli_query($connexio, $sql_nom2);  
    while ($mostrar2=mysqli_fetch_array($resultat2)) { 
        $nom_foto=$mostrar2['imatgeperfil'];
    }


    if ($nom_foto == "") { 
        $nom_foto = "imatge_per_defecte.png";
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
    
    <link rel="stylesheet" href="css/dades.css">
    
    <title>MODIFICAR DADES USUARI</title>
</head>
<body>

    <h1 style="font-size: 30px; background-color: lightpurple">MODIFICAR USUARI</h1>

    <nav class="navbar navbar-light bg-light">
        <div class="container">
        <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/index.php">Inici</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/main/registrat/login.php">Registrat</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/admin.php">Admin</a></li>
  <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/main/registrarse/registre.php">Registrarse</a></li>
        </div>
    </nav>

   
   
    <h1>DADES A MODIFICAR </h1>

    <div class="div_formulario">
    <form action="processaModificaDadesUsuari.php"  enctype="multipart/form-data"  method="post" class="formulario">

        <div style="display: flex; ">
            <fieldset>
                <label for="fname">NOM </label>
            </fieldset>
            <fieldset>
                <input type="text" id="fname" name="nom" value="<?php echo $nom1 ?>"><br><br>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">COGNOMS </label>
            </fieldset>
            <fieldset>
                <input type="text" id="lname" name="cognoms" value="<?php echo $cognom1 ?>"><br><br>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">EMAIL </label>
            </fieldset>
            <fieldset>
                <input type="email"  disabled="disabled" id="lname" name="correu" value="<?php echo $correu1 ?>" readonly> <span style="color: red;"> No es pot modificar!!</span> <br>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">TIPUS DE COMPTE </label>
            </fieldset>
            <fieldset>
                <select name="tipus_compte" size="1" value="<?php echo $tipuscompte1 ?>" required>
                    <option>Normal</option>
                    <option>Premium</option>
                </select>
            </fieldset>
        </div>

        <div style="display: flex; ">
            <fieldset>
                <label for="lname">CONTRASENYA </label>
            </fieldset>
            <fieldset>
                <input type="password" id="lname" name="contra1" minlength="6" ><?php 
                if ($contra_coincidixen == "contra_coincidixen"){ 
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
                <input type="password" id="lname" name="contra2" minlength="6" ><br><br>
            </fieldset>
        </div>


       
        <div style="display: flex; ">
            <fieldset>
                <label for="lname">Imagen de perfil (maxim 200KB)</label>
                <br>
                <label>Tria una nova imatge per a cambiar l'actual:</label>
            </fieldset>
            <fieldset>
                <input type="file" name="imagen" accept="image/png,image/gif,image/jpeg,image/jpg" />
                <br><img src="https://2daw10.ticsimarro.org/wwwdavidIvars/img/img_perfil/<?php echo $nom_foto ?>" alt="foto" width="50" height="50">
                <?php
                if ($imatge_gran == "gran"){ 
                    ?>
                    
                    <span style="font-family: monospace; color: red">Imatge superior a 200kb!!</span> 
                    
                    <?php
                }?>

       
            <a href="eliminarFoto.php?correu=<?php echo $correu1 ?>&id=<?php echo $id1 ?>" style="color: red;"> Eliminar Foto</a>
            </fieldset>
        </div>
        

        <br><br>
        <input type="submit" style="font-family: monospace;" value="TRAMITAR">

    <br><br><br>

    <h2> <a href="../admin.php">Cancelar</a> </h2> <br>

    <h3>IES SIMARRO <br> DAW <br> CURS 2020/2021</h3>

</body>
</html>

