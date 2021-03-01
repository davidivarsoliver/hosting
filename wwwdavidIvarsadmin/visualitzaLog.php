<?php

    if (isset($_SESSION['correu'])) {
        $correu_a_mostrar = $_SESSION['correu'];
    }

    
    $patro="/$correu_a_mostrar/i";
    preg_match($patro,"logs/admin.log"); 

   
    $fp = fopen("logs/admin.log", "r");
    while (!feof($fp)) {
        $linia = fgets($fp); 
        if (preg_match($patro,$linia)) { 
            ?>
            <p style="text-align: center; color: white;"> <?php echo $linia ?> </p>
            <?php
        }
    }
    fclose($fp);
?>