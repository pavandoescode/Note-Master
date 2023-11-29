<?php


$passError = false;
$login = false;
$accError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    include "includes/db.php";

    $q = "Select * from userdata where username='$username'";
    $result = mysqli_query($conn, $q);
    $num = mysqli_num_rows($result);

    if ($num == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {


            session_start();
            $user_id = $row['user_id'];

            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            header("location: /dashboard.php");
        } else {
            $passError = true;


        }

    } else {

        $accError = true;


    }
}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <link rel="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="style.css">

    <title>Login to Notes</title>
</head>

<body>
    <?php
    include "includes/navBar.php"; ?>

    <?php
    if ($passError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Wrong Password!! </strong> Please enter correct password
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';


    }

    if ($accError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>No Account Exist!! </strong> Please create account first using <a href="signup.php"> Signup</a> Page
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';


    }




    ?>




    <div class="container">
        <div class="signup-container">
            <h2 class="text-center">Log in</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class=" my-1 form-group">
                    <label class="my-1" for="username">Username:</label>
                    <input type="text" name="username" class="form-control" id="username"
                        placeholder="Enter your username">
                </div>
                <div class=" mb-2 form-group">
                    <label class="my-1" for="password">Password:</label>
                    <input type="password" name="password" class="form-control" id="password"
                        placeholder="Enter your password">
                </div>

                <div class="d-grid gap-2">

                    <button class="btn my-3 btn-primary" type="submit">Login</button>
                </div>

            </form>
        </div>
    </div>




</body>

</html>