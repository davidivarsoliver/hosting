
<?php
    session_start();

    if (isset($_GET['visualitza'])) {
        $visualitza = $_GET['visualitza'];
    } else {
        $visualitza = "false";
    }

    if (isset($_SESSION['correu'])) {
        $correu = $_SESSION['correu'];
    }
  
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/usuari_registrat.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <title>ADMIN</title>
</head>

<body style="background-color: blue;">


<nav class="navbar navbar-light bg-light">
        <div class="container">
        <li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvarsadmin/admin.php">Inici</a></li>
<li class="list"><a href="https://2daw10.ticsimarro.org/wwwdavidIvars/index.php">Pàgina Hosting</a></li>
        </div>
    </nav>


    <br>
    
    <?php
    if (isset($_SESSION['correu']) ) { 
        include("llistatUsuaris.php");
        if ($visualitza == "true") {
            ?>
            <h1 style="background-color: black ;color: yellow;">Log Admin <?php echo $correu ?> </h1><br>
            <?php
            include("visualitzaLog.php");
        }
    } else {
        include("login.php");
    }
    ?>



    
   
</body>

</html>
