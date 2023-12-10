<?php

session_start();

$blankError = false;
$passError = false;

function limitWords($text, $limit = 30)
{
  $words = explode(' ', $text);
  $limitedWords = array_slice($words, 0, $limit);
  return implode(' ', $limitedWords);

}

if ($_SESSION['loggedin'] == true && $_SESSION['username'] != "") {



  $username = $_SESSION["username"];
  $user_id = $_SESSION['user_id'];


  if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $note_id = $_GET["note"];

    require("includes/db.php");
    $q = " SELECT * FROM `note` WHERE note_id = $note_id;";
    $result = mysqli_query($conn, $q);

    $row = mysqli_fetch_assoc($result);


    $qUserData = " SELECT * FROM userdata WHERE user_id = '$user_id'; ";
    $resultUserData = mysqli_query($conn, $qUserData);

    $rowUserData = mysqli_fetch_assoc($resultUserData);


    $username = $rowUserData['username'];

    $title = $row["title"];
    $text = $row["text"];

  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $password = $_POST["password"];
    $note_id = $_POST["note_id"];
    $title = $_POST["title"];
    $text = $_POST["text"];


    if ($password = " ") {

      $blankError = true;

    } else {



      require("includes/db.php");


      $q = " SELECT * FROM userdata WHERE user_id = '$user_id'; ";

      $result = mysqli_query($conn, $q);

      $row = mysqli_fetch_assoc($result);

      $passwordDB = $row['password'];
      if ($password == password_verify($password, $passwordDB)) {


        $q = "DELETE FROM note WHERE `note_id` = '$note_id' ";
        $result = mysqli_query($conn, $q);


        header('location: /dashboard.php');

      } else {
        $passError = true;



      }
    }
  }
} else {
  header('location: /');
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="img/favicon.ico">

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

    <link rel="icon" href="/img/favicon.ico">

  <link rel="stylesheet" href="style.css">


  <title>Confirm Delete</title>
</head>

<body>
  <?PHP require "includes/navBar.php";


  if ($blankError) {

    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>Empty Field Found!! </strong> You cannot leave empty fields.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

  }

  if ($passError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Wrong Password!! </strong> Please enter correct password
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';


  }
  ?>












  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 my-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="col-10">
          <div class="mb-3 ">
            <label for="title" class="form-label fs-5">Are you sure want to delete this note</label>
            <div class="card  mt-5 mb-2 col-12">
              <div class="card-header">


                <?php echo limitWords($title, 20);


                ?> <b> . . . </b>

              </div>
              <div class="card-body">

                <p class="card-text">

                  <?php echo limitWords($text, 30); ?><b> More. . . . . </b>
                </p>
              </div>
            </div>

            <label for="title" class="form-label ">Enter Password to Confirm!!</label>
            <input type="password" class="form-control" name="password" id="title" aria-describedby="emailHelp">
          </div>

          <input type="hidden" name="note_id" value="<?php echo $note_id; ?>" id="">
          <input type="hidden" name="text" value=" <?php echo $text; ?>" id="">
          <input type="hidden" name="title" value=" <?php echo $title ?>" id="">



          <button type="submit" class="btn btn-danger">Delete</button>
        </form>

      </div>
    </div>
  </div>










</body>

</html>