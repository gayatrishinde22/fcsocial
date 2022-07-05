<?php
    require('connection.php');
    // make session variable NULL
    // we can make session variable null using ??? function
    $_SESSION['user_id']="";
    header("Location:index.php");
?>
