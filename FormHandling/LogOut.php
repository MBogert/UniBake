<?php
   session_start();
   
   session_destroy();

    header("Location: TestLogIn.php");
    exit;
   }
?>