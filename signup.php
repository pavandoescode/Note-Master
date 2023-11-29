<?php

$notsamePass = false;
$dataInserted = false;
$usernameExistError = false;
$blankUsername = false;
$usernameSpace = false;
$shortPassword = false;
$emailExistError = false;



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];

    require "includes/db.php";

    if ($username == "") {
        $blankUsername = true;


    } else {

        if (strpos($username, ' ')) {
            $usernameSpace = true;

        } else {



            $q_num = "Select * from userdata where username='$username'";
            $result = mysqli_query($conn, $q_num);
            $num = mysqli_num_rows($result);
            if ($num == 1) {

                $usernameExistError = true;

            } else {

                $q_email_check = "Select * from userdata where username='$username'";
                $result_email_check = mysqli_query($conn, $q_email_check);
                $num_email_check = mysqli_num_rows($result_email_check);
                if ($num_email_check == 1) {


                    $emailExistError = true;


                } else {





                    if ($password == $password2) {

                        if (strlen($password) < 8) {
                            $shortPassword = true;

                        } else {


                            $encryptedpass = password_hash($password, PASSWORD_DEFAULT);

                            $q = "INSERT INTO `userdata` ( `username`, `email`, `password`) VALUES ( '$username', '$email' , '$encryptedpass')";
                            $result = mysqli_query($conn, $q);


                            $dataInserted = true;

                        }

                    } else {
                        $notsamePass = true;
                    }


                }



            }
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



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <link rel="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="style.css">

    <title>Crete New Account</title>
</head>

<body>
    <?php
    include "includes/navBar.php"; ?>


    <?php

    if ($notsamePass) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Password does not match</strong> Please enter same password on both filed.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    if ($shortPassword) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Short Password !!</strong> Your Password must have at least 8 characters.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    if ($blankUsername) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Blank @Username !!</strong> Please Enter @username
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    if ($dataInserted) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Congratulations!! You are registered </strong> Please<a href="login.php"> Login </a>to continue
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    if ($usernameExistError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Username @' . $username . ' </strong> already exists, Please choose another username
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    if ($usernameSpace) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Username "@' . $username . '" contains space </strong> kindly pick username without space
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    if ($emailExistError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Email @' . $email . ' </strong> already exists, Please enter another Email ID
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>


    <div class="container">
        <div class="signup-container">
            <h2 class="text-center">Sign Up</h2>
            <form method="post" action="signup.php">
                <div class=" my-1 form-group">
                    <label class="my-1" for="username">Username:</label>
                    <input type="text" name="username" class="form-control" id="username"
                        placeholder="Enter your username">


                </div>
                <div class=" my-1 form-group">
                    <label class="my-1" for="email">Email:</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">


                </div>
                <div class=" mt-2 form-group">
                    <label class="my-1" for="password">Password:</label>
                    <input type="password" name="password" class="form-control" id="password"
                        placeholder="Enter your password">
                </div>
                <div class=" mb-2 form-group">
                    <label class="my-1" for="confirmPassword">Confirm Password:</label>
                    <input type="password" name="password2" class="form-control" id="confirmPassword"
                        placeholder="Confirm your password">
                    <div id="passwordHelpBlock" class="form-text">
                        Secure Password have 8-20 characters.
                    </div>
                </div>
                <div class="d-grid gap-2">

                    <button class="btn my-3 btn-primary" type="submit">Sign Up</button>
                </div>

            </form>
        </div>
    </div>




</body>

</html>