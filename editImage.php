<?php 
include('connect.php');

if(isset($_POST['edit_image_btn'])){
  $idGallery = $_POST['idGallery'];
  $title = mysqli_real_escape_string($con, $_POST['titleEdit']);
  $desc = mysqli_real_escape_string($con, $_POST['descEdit']);
  $imgFullName = mysqli_real_escape_string($con, $_POST['imgFullNameEdit']);
  $order = mysqli_real_escape_string($con, $_POST['orderEdit']);

  $sql = "UPDATE gallery SET titleGallery = ?, descGallery = ?, imgFullNameGallery = ?, orderGallery = ? WHERE idGallery = ?"; 

  if($stmt = mysqli_prepare($con, $sql)){
    mysqli_stmt_bind_param($stmt, 'sssii', $title, $desc, $imgFullName, $order, $idGallery);
    mysqli_stmt_execute($stmt);
    echo "Update successful.<br><br>";
    echo "<script type=\"text/javascript\"> 
    window.location.href=\"gallery.php\" 
    </script> ";
  } else {
      echo "Update failed: " . mysqli_stmt_error($stmt);
  }
  mysqli_stmt_close($stmt);
} else {
  echo "ERROR: No Text entered:<br>";
}

mysqli_close($con);
?>
