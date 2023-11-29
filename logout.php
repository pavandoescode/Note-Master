<?php
session_start();
if ($_SESSION['loggedin'] == true && $_SESSION['username'] != "") {




    $_SESSION["loggedin"] = false;
    $_SESSION["username"] = "";

    session_unset();
    session_destroy();

    header("location: index.php");
}


?>