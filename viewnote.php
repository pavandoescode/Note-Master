<?php

session_start();

$adminView = false;

if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $note_id = $_GET["note"];

    require("includes/db.php");

    $q_admin_user_id = " SELECT * FROM `note` WHERE note_id = $note_id;";
    $result_admin_user_id = mysqli_query($conn, $q_admin_user_id);

    $row_admin_user_id = mysqli_fetch_assoc($result_admin_user_id);

    // admin user_id
    $admin_user_id = $row_admin_user_id["user_id"];



    $q_admin_username = " SELECT * FROM `userdata` WHERE user_id = $admin_user_id;";
    $result_admin_username = mysqli_query($conn, $q_admin_username);

    $row_admin_username = mysqli_fetch_assoc($result_admin_username);

    // admin username
    $admin_username = $row_admin_username["username"];



    // note status PUBLIC/PRIVATE

    $q_check_note_status = " SELECT * FROM `note` WHERE note_id = $note_id;";
    $result_check_note_status = mysqli_query($conn, $q_check_note_status);

    $row_check_note_status = mysqli_fetch_assoc($result_check_note_status);
    $status = $row_check_note_status["status"];













    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {


        // logged in user_data
        $logged_username = $_SESSION['username'];
        $logged_user_id = $_SESSION['user_id'];

        $loggedin = true;




        if ($status == 0) {




            if ($admin_user_id == $logged_user_id) {


                
                $adminView =true;

                $q_noteData = " SELECT * FROM `note` WHERE note_id = $note_id;";
                $result_noteData = mysqli_query($conn, $q_noteData);

                $row_noteData = mysqli_fetch_assoc($result_noteData);

                $title = $row_noteData["title"];
                $text = $row_noteData["text"];
                $created_on = $row_noteData["created_on"];
                $modified_on = $row_noteData["modified_on"];
                $views = $row_noteData["views"];




            } else {
                echo    ' <!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            
                <link rel="stylesheet"
                    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="icon" href="img/favicon.ico">
    <title>Note Master</title>';
            
               require("includes/navBar.php"); 
            
                echo    ' <div class="container d-flex justify-content-center">
                    <div class=" mt-5  col-8">
            
                        <div class="card">
                            <h5 class="card-header"><span class="material-symbols-outlined"> lock</span>Private Note</h5>
                            <div class="card-body">
                                <h5 class="card-title">This note is private</h5>
                                <p class="card-text">Oops! It seems like you have stumbled upon a private note page.
            
                                    If you believe you should have access to this page, make sure you are logged in with the correct
                                    credentials. In case you encounter any issues or need assistance, feel free to contact our
                                    support team.</p>
                                    <br>
            
                                <a href="/login.php" class="btn btn-primary">Login</a>  ';
                             
            
                                if ($loggedin) {
                                    echo `<a href="/dashboard.php" class="btn btn-outline-success">Dashboard</a>  `;
                                }
                              
                                echo '
                            </div>
                        </div>
            
                    </div>
            
                </div>
            
            </head>
            
            <body>
            
            
            
            </body>
            
            </html>';

                exit();
            }



        } else {


            // status = 1 [public note]
            // with login

            require("includes/db.php");





            $q_noteData = " SELECT * FROM `note` WHERE note_id = $note_id;";
            $result_noteData = mysqli_query($conn, $q_noteData);

            $row_noteData = mysqli_fetch_assoc($result_noteData);

            $title = $row_noteData["title"];
            $text = $row_noteData["text"];
            $created_on = $row_noteData["created_on"];
            $modified_on = $row_noteData["modified_on"];
            $views = $row_noteData["views"];







        }


    } else {






        if ($status == 0) {

            //you are logged out, this is private page

          
            
            echo    ' <!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            
                <link rel="stylesheet"
                    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="icon" href="img/favicon.ico">
    <title>Note Master</title>';
            
               require("includes/navBar.php"); 
            
                echo    ' <div class="container d-flex justify-content-center">
                    <div class=" mt-5  col-8">
            
                        <div class="card">
                            <h5 class="card-header"><span class="material-symbols-outlined"> lock</span>Private Note</h5>
                            <div class="card-body">
                                <h5 class="card-title">This note is private</h5>
                                <p class="card-text">Oops! It seems like you have stumbled upon a private note page.
            
                                    If you believe you should have access to this page, make sure you are logged in with the correct
                                    credentials. In case you encounter any issues or need assistance, feel free to contact our
                                    support team.</p>
                                    <br>
            
                                <a href="/login.php" class="btn btn-primary">Login</a>  ';
                             
            
                                if ($loggedin) {
                                    echo `<a href="/dashboard.php" class="btn btn-outline-success">Dashboard</a>  `;
                                }
                              
                                echo '
                            </div>
                        </div>
            
                    </div>
            
                </div>
            
            </head>
            
            <body>
            
            
            
            </body>
            
            </html>';



            exit();








        } else {


            require("includes/db.php");


            $q_noteData = " SELECT * FROM `note` WHERE note_id = $note_id;";
            $result_noteData = mysqli_query($conn, $q_noteData);

            $row_noteData = mysqli_fetch_assoc($result_noteData);

            $title = $row_noteData["title"];
            $text = $row_noteData["text"];
            $created_on = $row_noteData["created_on"];
            $modified_on = $row_noteData["modified_on"];
            $views = $row_noteData["views"];


        }



    }







}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="style.css">

    <title>Note By @
        <?php echo $admin_username; ?>
    </title>
</head>

<body>



    <style>
        .view_icon {


            color: red;

        }
    </style>
    </style>

    <?PHP require "includes/navBar.php"; 
    
    
    if ($adminView) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>This is Private Page </strong> You can see this because you are Admin of this note
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    
    
    ?>


    <div class="container mt-5 ">


        <div class="card  ">
            <div class="card-header">
                <?php echo $title; ?>
            </div>
            <div class="card-body">


                <label class="card-text">
                    <?php echo nl2br($text); ?>
                </label>
            </div>

        </div>
    </div>


    <div class=" col-12 container text-end ">
        <div class="row ">


            <small>Views</span>: <b>
                    <?php echo $views; ?>
                </b> </b>
            </small>
            <small>Created By: <b>@
                    <?php echo $admin_username; ?>
                </b>
            </small>
            <small>Created On:
                <b>
                    <?php echo $created_on; ?>
                </b>
            </small>
            <?php

            if ($modified_on != "") {
                echo '<br><small  >Last Modified On: <b>' . $modified_on . '</b></small>';
            }


            $views++;

            require("includes/db.php");
            $q_views = "UPDATE `note` SET `views` = '$views'  WHERE note_id = $note_id;";



            $result_views = mysqli_query($conn, $q_views);


            ?>

        </div>
    </div>



    





</body>

</html>