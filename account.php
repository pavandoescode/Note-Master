<?php


session_start();


$wrongPassword = false;
$passwordUpdated = false;




if ($_SESSION['loggedin'] == true && $_SESSION['username'] != "") {


  $username = $_SESSION["username"];
  $user_id = $_SESSION['user_id'];



  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];

    require 'includes/db.php';
    $q_password = " SELECT * FROM userdata WHERE user_id = '$user_id'; ";
    $result_password = mysqli_query($conn, $q_password);

    $row_password = mysqli_fetch_assoc($result_password);


    if (password_verify($current_password, $row_password['password'])) {


      $encryptedpass = password_hash($new_password, PASSWORD_DEFAULT);



      $q_Update_password = " UPDATE `userdata` SET `password` = '$encryptedpass' WHERE `user_id` = 1; ";

      $result_Update_password = mysqli_query($conn, $q_Update_password);







      $passwordUpdated = true;



    } else {

      $wrongPassword = true;

    }







  }




  require 'includes/db.php';
  $q = " SELECT * FROM userdata WHERE user_id = '$user_id'; ";
  $result = mysqli_query($conn, $q);

  $row = mysqli_fetch_assoc($result);


  $qUserData = " SELECT * FROM note WHERE user_id = '$user_id' ORDER BY views DESC ";
  $resultNoteData = mysqli_query($conn, $qUserData);

  $Notecount = mysqli_num_rows($resultNoteData);









} else {
  header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">

  <title>Account</title>
</head>

<body>
  <?php require "includes/navBar.php"; 
  
  
  if ($passwordUpdated) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Password is updated!! </strong> 
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

  
  
if ($wrongPassword) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Opps!!  </strong> You have Entered Wrong Password
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
  
  ?>



  <style>
    .main_account {
      height: 28vh;


    }





    * {
      margin: 0px;
      padding: 0px;
    }


    
  </style>



  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>








    <div class="container ">


        <div class="card">
            <div class="card-body pb-0">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="text-center "> <img
                                src="./img/user_avatar.png"
                                class="img-fluid img-fluid rounded-circle" height="150px" width="150px" alt="">
                            <h4 class=" font-size-20 mt-3 text-uppercase mb-2" >@<?php echo $row["username"];
        ; ?></h4>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="ms-3">
                            <div>
                                <p class="mb-0 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum porro nam delectus explicabo,  </p>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-12">
                                    <div>
                                        <p class="text-muted mb-2 fw-medium">Email: </i><?php echo $row["email"];
        ; ?></p>
                                        <p class="text-muted fw-medium mb-0">User Since: </i><?php echo $row["usersince"];
        ; ?></p>
                                        <p class="text-muted fw-medium mb-0">Total Notes: </i> <?php echo $Notecount;
        ; ?> </p>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

















   







  </div>

  <div class="container  mt-4">
    <div class="fs-4">Your Most viewed notes</div>
    <table class=" mt-2 table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Text</th>
          <th scope="col">Views</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>


        <?php



        if ($Notecount > 0) {
          $note_num = 1;



          while ($rowNoteData = mysqli_fetch_assoc($resultNoteData)) {
            echo '
        <tr>
        <th scope="row">' . $note_num . '</th>
        <td>' . $rowNoteData["title"] . '</td>
        <td>' . limitWords($rowNoteData["text"], 8) . ' . . . </td>
        <td>' . $rowNoteData["views"] . '</td>
        <td> ';
            if ($rowNoteData["status"] == 1) {
              echo 'Public';
            } else {
              echo '<span class="badge rounded-pill bg-secondary">Private</span>';
            }
            ;
            echo '</td>    
        </tr>';
            $note_num++;
            if ($note_num > 5) {
              break;
            }
          }


        } else {


          echo "<tr><td colspan='5'>No records found</td></tr>";
        }








        function limitWords($text, $limit = 30)
        {
          $words = explode(' ', $text);
          $limitedWords = array_slice($words, 0, $limit);
          return implode(' ', $limitedWords);
        }

        ?>

      </tbody>
    </table>


  </div>
  <div class="mt-4 container">

    <div class="fs-4 my-2">Do you want to change your password?</div>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#passwordchange">
      Change Password
    </button>

    <!-- Modal -->
    <div class="modal fade" id="passwordchange" tabindex="-1" aria-labelledby="passwordchangeLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="passwordchangeLabel">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">





            <div class="container">

              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class=" my-1 form-group">
                  <label class="my-1" for="current_password">Current Password:</label>
                  <input type="password" name="current_password" class="form-control" id="current_password"
                    placeholder="Enter your Current Password">
                </div>
                <div class=" my-2 form-group">
                  <label class="my-1" for="new_password">New Password:</label>
                  <input type="password" name="new_password" class="form-control" id="new_password"
                    placeholder="Enter your New Password">
                </div>

                <div class="d-flex justify-content-end">

                  <button class="btn mt-2 mb-1 btn-primary" type="submit">Save Changes</button>
                </div>

              </form>

            </div>




          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


  </div>



</body>

</html>