<?php



session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {


    $user_id = $_SESSION['user_id'];

    $loggedin = true;
} else {
    $loggedin = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Note Master</title>

    <?php require("includes/navBar.php"); ?>

    <div class="container d-flex justify-content-center">
        <div class=" mt-5  col-8">

            <div class="card">
                <h5 class="card-header"><span class="material-symbols-outlined"> lock</span>Private Note</h5>
                <div class="card-body">
                    <h5 class="card-title">This note is private</h5>
                    <p class="card-text">Oops! It seems like you've stumbled upon a private note page.

                        If you believe you should have access to this page, make sure you are logged in with the correct
                        credentials. In case you encounter any issues or need assistance, feel free to contact our
                        support team.</p>
                        <br>

                    <a href="/login.php" class="btn btn-primary">Login</a>  
                    <?php

                    if ($loggedin) {
                        echo '<a href="/dashboard.php" class="btn btn-outline-success">Dashboard</a>  ';
                    }
                    ; ?>
                </div>
            </div>

        </div>

    </div>

</head>

<body>



</body>

</html>