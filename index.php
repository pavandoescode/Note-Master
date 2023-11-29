


<?php 



session_start();
 

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

   
    $user_id =  $_SESSION['user_id'];

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

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <title>Note Master</title>

    
  
  

  <style>


@media screen and (max-width: 768px) {
    /* Apply styles when the screen width is 768 pixels or less */
    p {
      font-size: 16px; /* Adjust the font size for smaller screens */
    }
  }

 

    * {
      margin: 0px;
      padding: 0px;
    }

    body {
      background-color: #FCF5ED;
      color: white;
    }

    .title {
      font-size: 77px;
      font-family: 'Nunito Sans', sans-serif;
      color: #352F44;
    }

    p {
      color: #352F44; /* Apply color to all <p> elements */
    }

    .canvas {
      height: 100%;
      background-color: #FAF0E6;
    }

    .btn-success {
      background-color: #5C5470;
      color: white;
      border-color: transparent;
    }

    .btn-success:hover {
      background-color: #352F44;
      
    }
  </style>
</head>

<body>
<?php require("includes/navBar.php"); ?>


  <div class="canvas container-fluid">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-md-6 text-center">
        <!-- Your content goes here -->
        <p class="title">Create, Share, Thrive</p>
        <p class="fs-4">Unlock the power of seamless note-sharing with Note Master!</p>
        <a class="btn mt-3 btn-lg btn-success" href="/dashboard.php">Create New Note🚀</a>
      </div>
    </div>
  </div>

</body>

</html>
