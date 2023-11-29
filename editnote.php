<?php

session_start();

$blankError = false;



if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {


  $user_id = $_SESSION['user_id'];

  if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $note_id = $_GET["note"];


    require "includes/db.php";




    $q = " SELECT * FROM `note` WHERE note_id = $note_id; ";
    $result = mysqli_query($conn, $q);

    $row = mysqli_fetch_assoc($result);

    $title = $row["title"];
    $text = $row["text"];
    $status = $row["status"];




  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Updated_title = $_POST['title'];
    $Updated_text = $_POST['text'];
    $note_id = $_POST['note_id'];
    $Updated_status = isset($_POST["status"]) ? $_POST["status"] : "0";


    


    if ($Updated_text == "" || $Updated_title == "") {
      $blankError = true;
      if ($blankError) {
        $title = $Updated_title;
        $text = $Updated_text;

      }


    } else {

      date_default_timezone_set("Asia/Calcutta");
      $date = date("d-m-y, h:i:sa");
      require 'includes/db.php';


      
$q = "UPDATE `note` SET `title`=?, `status`=?,  `text`=?, `modified_on`=? WHERE note_id=?";
$stmt = mysqli_prepare($conn, $q);


mysqli_stmt_bind_param($stmt, "sssss",  $Updated_title,  $Updated_status, $Updated_text, $date, $note_id);




mysqli_stmt_execute($stmt);



mysqli_stmt_close($stmt);



      header('location: /dashboard.php');


      

    }

  }



  $loggedin = true;
} else {
  header('location: /');
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

  <title>Edit Note</title>
  <link rel="icon" href="img/favicon.ico">

</head>




<body>
  <?PHP require "includes/navBar.php"; ?>


  <?php if ($blankError) {

    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>Empty Field Found!! </strong> You cannot leave empty fields.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

  } ?>



















  <div class="container mt-5">
    <div class="container col-12">
      
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class=" my-1 form-group">
          <label for="title" class="form-label fs-3">Title</label>

          <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" class="form-control" id="title" >
        </div>
        <div class=" mb-2 form-group">
          <label for="textarea" class="form-label fs-3">Note</label>

          <textarea type="text" name="text" class="form-control"  id="text" rows="17" cols="50" > <?php echo htmlspecialchars($text); ?> </textarea>
        </div>
       

          <div class="form-check mb-3">
  <input class="form-check-input "  name="status" type="checkbox" value="1" id="flexCheckChecked" <?php if($status == "1") {
echo "checked";
  }else{
    echo "";

  }?> >
  <label class="form-check-label" for="flexCheckChecked"> Public Note
  </label>
</div>
          <input type="hidden" name="note_id" value="<?php echo $note_id; ?>" id="">
          <button type="submit" class="btn btn-primary">Submit</button>
       

 

      </form>
    </div>
  </div>







  







</body>


</body>

</html>