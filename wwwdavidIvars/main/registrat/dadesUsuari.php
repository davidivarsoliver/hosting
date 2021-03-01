<?php

    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];
    } elseif (isset($_GET['correu1'])) {
        $correu = $_GET['correu1']; 
    }

    if (isset($_GET['visualitza'])) {
        $visualitza = $_GET['visualitza'];
    } else {
        $visualitza = "false";
    }

    $dades = "";
    if (isset($_GET['dades_modificades'])) {
        $dades = $_GET['dades_modificades']; 
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

    $sql_nom1="SELECT * FROM hosting_davidIvars WHERE correu = '$correu'"; 
    $resultat1 = mysqli_query($connexio, $sql_nom1);
    while ($mostrar1=mysqli_fetch_array($resultat1)) { 
        $nom1=$mostrar1['nom'];
        $cognom1=$mostrar1['cognoms'];
        $correu1=$mostrar1['correu'];
        $tipuscompte1=$mostrar1['tipuscompte'];
    }

    if($fp=fopen("../../logs/usuaris.log","a")){
        fputs($fp,"Usuari accedix al sistema –  Correu: " .$correu. " – Dia: ". date('j/ n/ Y') ." – Hora: ".date('H:i:s').PHP_EOL);  
        fclose($fp);

    } else { 
        echo "No s'ha pogut obrir el fitxer <br/>";
    }

    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];

        $sql_nom1="SELECT * FROM hosting_davidIvars WHERE correu = '$correu'"; 
        $resultat1 = mysqli_query($connexio, $sql_nom1);  
        while ($mostrar1=mysqli_fetch_array($resultat1)) { 
     
            $nom_foto=$mostrar1['imatgeperfil'];
        }

        if ($nom_foto == "") { 
            $nom_foto = "imatge_per_defecte.png";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dades.css">
    <title>DADES USUARI</title>
</head>
<body style="background-color: black">

    <?php
        if (isset($_SESSION['correu'])) {
            echo '<h1 style="font-size: 30px; background-color: blue"> 
            <img src="../../img/img_perfil/'.$nom_foto.'" alt="foto" width="50" height="50">
            Benvingut/a '.$correu.' <a href="desconnecta.php" style="color: red;"> Desconnectat.</a> </h1>';
        }
    ?>

    <!--<h1>Hola, <?php echo $correu1 ?> <a href="desconnecta.php?correu_desconecta=<?php echo $correu?>" style="color: red;"> Desconecta la sessio.</a> </h1>-->


    <?php
        
        if ($dades == "true") {
            ?>
            <h1 style="background-color: lime ;color: crimson;">Les teues dades / contrasenyes modificades correctament</h1>
            <?php

        } else { 
            ?>
            <h1 style="background-color: blue ;color: crimson;">Les teues dades</h1>
            <?php
        }
    ?>

    <div class="mostrar_datos">

        <ul>
            <li type="disc">NOM: <?php echo $nom1 ?></li>

            <li type="disc">COGNOM: <?php echo $cognom1 ?></li>

            <li type="disc">CORREU: <?php echo $correu1 ?></li>

            <li type="disc">TIPUS COMPTE: <?php echo $tipuscompte1 ?></li>

        </ul>
    </div>

    <h1>
        <a href="modificaDadesUsuari.php?correu1=<?php echo $correu1?>" style="color: red;">Modificar Dades</a>
        <a href="donatBaixa.php?correu1=<?php echo $correu?>" style="color: red;">Dona't de baixa</a>
        <?php
            if ($visualitza == "true") {
                ?>
                <a href="registrat.php?visualitza=false" style="color: red;">Oculta Log</a>
                <?php
            } else {
                ?>
                <a href="registrat.php?visualitza=true" style="color: red;">Visualitza Log</a>
                <?php
            }
        ?>
    </h1>
    <br><br>

    <h2><a href="../../index.php">TORNAR AL INICI</a></h2>

    <h3>IES SIMARRO <br> DAW <br> CURS 2020/2021</h3>


</body>
</html>
