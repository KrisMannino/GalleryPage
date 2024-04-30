<?php
  // Database credentials
  $server = "localhost";
  $user = "root";
  $pw = "";
  $db = "ImageGallery";
  //test

  // Create connection
  $con = mysqli_connect($server, $user, $pw, $db);

  // Check connection
  if (!$con) {
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  // echo "connect.php success";
?>