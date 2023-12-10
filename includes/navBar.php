<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $loggedin = true;
} else {
  $loggedin = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <style>
    .account_icon {
      color: white;
    }
  </style>
  <?php
  echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark my-navbar">
 <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="/img/[MAIN]notes.png" height="36px" width="36px"> 
   </a>
   <a class="navbar-brand" href="/">Note Master
   </a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav me-auto mb-2 mb-lg-0">'; ?>

  <?php if ($loggedin) {
    echo '<li class="nav-item">
         <a class="nav-link active" aria-current="page" href="/dashboard.php">Dashboard</a>
       </li>';
  } ?>

  <?php
  if (!$loggedin) {
    echo ' <li class="nav-item">
         <a class="nav-link active" href="/login.php">Login</a>
       </li> 
       
       <li class="nav-item">
         <a class="nav-link active" href="/signup.php">Signup</a>
       </li>';
  }
  ; ?>

  <?php
  if ($loggedin) {
    echo ' </ul>
     <div class="d-flex flex-row align-middle">
     <a class="nav-link   active " aria-current="page" href="/account.php">
     <span class="  active" aria-current="page" ><i  class=" account_icon material-icons">manage_accounts</i></span>
     </a>
     <span class="nav-item">
         <a class="nav-link   active btn btn-danger" aria-current="page" href="/logout.php">Logout</a>
       </span> ';
  }
  ; ?>

  <?php
  echo '
       
     </div>
   </div>
 </div>
</nav>
';
  ?>
</body>

</html>
