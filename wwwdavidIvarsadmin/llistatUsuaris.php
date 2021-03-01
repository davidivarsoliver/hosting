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

    $sql_nom1="SELECT * FROM hosting_davidIvars"; 
    $resultat1 = mysqli_query($connexio, $sql_nom1); 

    if (isset($_SESSION['correu'])) {
    $correu = $_SESSION['correu'];
     
        $sql_nom2="SELECT * FROM hosting_davidIvars WHERE correu = '$correu'"; 
        $resultat2 = mysqli_query($connexio, $sql_nom2);  
        while ($mostrar2=mysqli_fetch_array($resultat2)) {  
            
            $nom_foto=$mostrar2['imatgeperfil'];
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>ADMIN</title>
</head>
<body >

<h1 style="font-size: 35px;">ADMIN</h1>


    <h1 style="font-size: 25px;">
    <img src="https://2daw10.ticsimarro.org/wwwdavidIvars/img/img_perfil/<?php echo $nom_foto ?>" alt="foto" width="50" height="50">
    Benvingut/a, <?php echo $correu ?> <a href="desconnecta.php?correu_desconecta=<?php echo $correu?>" style="color: red;"> Desconnectat.</a> </h1>

    <div class="container">
    <br>
    <h2>Llistat Usuaris Hosting <i class="fas fa-pen-square"></i></h2>          
    <br>
    <table class="table table-dark">
        <thead>
        <tr>
            <th>ID</th>
            <th>NOM</th>
            <th>COGNOMS</th>
            <th>CORREU ELECTRONIC</th>
            <th>TIPUS DE COMPTE</th>
            <th>IMATGE PERFIL</th>
            <th>DATA CREACIO</th>
            <th> ACCIONS </th>
        </tr>
        </thead>
        <tbody>
            <?php
                while ($mostrar1=mysqli_fetch_array($resultat1)) { 
                    
                    $id1=$mostrar1['idUsuari'];
                    $nom1=$mostrar1['nom'];
                    $cognom1=$mostrar1['cognoms'];
                    $correu1=$mostrar1['correu'];
                    $imatgeperfil1=$mostrar1['imatgeperfil'];
                    $tipuscompte1=$mostrar1['tipuscompte'];
                    $datacreacio1=$mostrar1['fecha'];
                    ?>

                    <tr>
                        <td><?php echo $id1 ?></td>
                        <td><?php echo $nom1 ?></td>
                        <td><?php echo $cognom1 ?></td>
                        <td><?php echo $correu1 ?></td>
                        <td><?php echo $tipuscompte1 ?></td>
                        <?php
                            if ($imatgeperfil1 == "") {
                                ?>
                                    <td><img src="https://2daw10.ticsimarro.org/wwwdavidIvars/img/img_perfil/imatge_per_defecte.png" alt="foto" width="50" height="50"></td>
                                <?php

                            } else { 
                                ?>
                                    <td><img src="https://2daw10.ticsimarro.org/wwwdavidIvars/img/img_perfil/<?php echo $imatgeperfil1 ?>" alt="foto" width="50" height="50"></td>
                                <?php 
                            }
                        ?>
                        <td><?php echo $datacreacio1 ?></td>
                        <?php
                           
                            if ($correu == $correu1) {
                                ?>
                                    <td> - </td>
                                <?php

                            } else { 
                                ?>
                                    <td> <a href="./modificarUsuari/modificaDadesUsuari.php?id1=<?php echo $id1?>"> <img src="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/img/lapiz.png" alt="lapiz" width="25px" height="25px"> </a>
                                         <a href="./modificarUsuari/processaEliminaUsuari.php?id1=<?php echo $id1?>"> <img src="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/img/papelera.png" alt="papelera"  width="25px" height="25px"> </a> </td>
                                <?php 
                            }
                        ?>
                        
                    </tr>
                    
                    <?php
                }
            ?>    
        </tbody>
    </table>
    </div>


    <h1 style="font-size: 20px;">
        <img src="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/img/new.png" alt="new" width="25px" height="25px">
        <a href="registrarUsuari/afegeixUsuari.php" style="color: purple;">Afegir Usuari</a>

        <img src="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/img/guardar.png" alt="guardar" width="25px" height="25px">
        <a href="processaBackup.php?correu=<?php echo $correu?>" style="color: purple;">Fes un backup dels usuaris</a>
     
        
        <?php
            if ($visualitza == "true") {
                ?>
                <img src="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/img/log.png" alt="log" width="25px" height="25px">
                <a href="admin.php?visualitza=false" style="color: purple;">Oculta Log</a>
                <?php
            } else {
                ?>
                <img src="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/img/log.png" alt="log" width="25px" height="25px">
                <a href="admin.php?visualitza=true" style="color: purple;">Visualitza Log</a>
                <?php
            }
        ?>
    </h1>
    <br>

</body>
</html>
