<?php 

$db_servername = "localhost";
$db_username = "id21552197_note_master_db";
$db_password = "1234@Pavan";
$db_database = "id21552197_note_master_db";

      // Create a connection
      $conn = mysqli_connect($db_servername, $db_username, $db_password, $db_database);
      // Die if connection was not successful
      if (!$conn){
          die("Sorry we failed to connect: ". mysqli_connect_error());
      }

      ?>