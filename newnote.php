<?php

session_start();
$blankError = false;



if ($_SESSION['loggedin'] == true && $_SESSION['username'] != "") {



  $username = $_SESSION["username"];
  $user_id = $_SESSION['user_id'];



  $note_id = rand(1000, 1000000);
  $views = 0;




  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $title = $_POST["title"];
    $status = isset($_POST["status"]) ? $_POST["status"] : "0";






    $date = date("d-m-y");




    if ($text == "" || $title == "") {
      $blankError = true;
    } else {



      require "includes/db.php";












      $q = "INSERT INTO `note` (`note_id`, `user_id`, `title`, `text`, `created_on`, `status` , `views`) VALUES (?, ?, ?, ?, ?, ?, ?)";




      $stmt = mysqli_prepare($conn, $q);





      mysqli_stmt_bind_param($stmt, "isssssi", $note_id, $user_id, $title, $text, $date, $status, $views);




      $result = mysqli_stmt_execute($stmt);

      mysqli_stmt_close($stmt);







      header("location: /dashboard.php");
    }
  }


} else {
  header("location: /login.php");
}









?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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

  <link rel="stylesheet" href="style.css">

  <link rel="icon" href="img/favicon.ico">

  <title>Write New Note</title>
</head>

<body>
  <?PHP require "includes/navBar.php"; ?>

  <?php if ($blankError) {

    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>Empty Field Found</strong> You cannot leave empty fields.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

  } ?>


















  <div class="container mt-5">
    <div class="container col-12">
      
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class=" my-1 form-group">
          <label for="title" class="form-label fs-3">Title</label>

          <input type="text" name="title" class="form-control" id="title" >
        </div>
        <div class=" mb-2 form-group">
          <label for="textarea" class="form-label fs-3">Note</label>

          <textarea type="text" name="text" class="form-control" id="text" rows="17" cols="50" > </textarea>
        </div>
        <div class="form-check my-3">
            <input class="form-check-input " name="status" type="checkbox" value="1" id="flexCheckChecked" checked>
            <label class="form-check-label" for="flexCheckChecked"> Public Note
            </label>
          </div>

       

          <button class="btn btn-primary" type="submit">Submit</button>
 

      </form>
    </div>
  </div>







</body>

</html>