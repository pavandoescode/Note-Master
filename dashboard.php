<?php
session_start();
$count = 0;
if ($_SESSION['loggedin'] == true && $_SESSION['username'] != "") {
    $username = $_SESSION["username"];
    $user_id =  $_SESSION['user_id'];
} else {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>
    <?php require "includes/navBar.php"; ?>

   



    <div class="container mt-1">
        <div class="card col-lg-6 col-md-8 col-sm-12 mx-auto mt-4">
            <div class="card-header"><b>Welcome @<?php echo $username; ?>,</b></div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">"Welcome to your note-taking hub! 🚀 Begin capturing your thoughts, organizing ideas, and unlocking creativity. Remember, every stroke on your digital canvas is a step toward making your ideas come alive—embracing the journey of note-taking joyfully!"</p>
                <div class="m-4"></div>
                <a href="newnote.php" class="btn btn-primary">Create New Note</a>
            </div>
        </div>
        <hr class="mb-4">
    </div>

    <div class="container d-flex flex-wrap justify-content-around">
        <?php
        require "includes/db.php";

        $sql = "SELECT * FROM `note` WHERE user_id = '$user_id' ORDER BY created_on DESC";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card col-lg-3 col-md-4 col-sm-6 m-2">
                    <div class="card-header">' . limitWords($row["title"], 8) . ' <b> . . . </b>'  ; if( $row["status"]  == "0"){ echo '<sup> <span class="badge rounded-pill bg-secondary">Private</span></sup>';  }  echo  '</div>
                    <div class="card-body">
                        <p class="card-text">' . limitWords($row["text"], 12) . '  <b> . . . </b></p>
                        <div class="d-flex mt-3 justify-content-end">
                            <a href="viewnote.php/?note=' . $row["note_id"] . '" class="btn btn-sm mx-1 btn-primary">View</a>
                            <a href="editnote.php/?note=' . $row["note_id"] . '" class="btn btn-sm mx-1 btn-secondary">Edit</a>
                            <a href="deletenote.php/?note=' . $row["note_id"] . '" class="btn btn-sm mx-1 btn-danger">Delete</a>
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>

    <?php
    function limitWords($text, $limit = 30)
    {
        $words = explode(' ', $text);
        $limitedWords = array_slice($words, 0, $limit);
        return implode(' ', $limitedWords);
    }
    ?>
</body>

</html>
