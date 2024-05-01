<?php 
if(isset($_POST['submit'])){

  $newFileName = $_POST['filename'];
  if(empty($newFileName)){
    $newFileName = 'gallery';
  }else{
    $newFileName = strtolower(str_replace(" ", "-", $newFileName));
  }

  $imageTitle = $_POST['filetitle'];
  $imageDesc = $_POST['filedescription'];

  $file = $_FILES["file"];
  $fileName = $file['name'];
  $fileType = $file['type'];
  $fileTempName = $file['tmp_name'];
  $fileError = $file['error'];
  $fileSize = $file['size'];

  $fileExtension = explode(".", $fileName);
  $fileActualExt = strtolower(end($fileExtension));
  // allowed file types
  $allowed = array("jpg", "jpeg", "png");

  // error handling
  if(in_array($fileActualExt, $allowed)){
    if($fileError == 0){
      if($fileSize < 20000000){
        $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
// Check link for gallery images = ok
        $fileDestination = "images/gallery/" . $imageFullName;

        //connect to DB Kris!
        include ("connect.php");

        if(!empty($imageTitle) && !empty($imageDesc)){

          $sql = "SELECT * FROM gallery;";
          $stmt = mysqli_stmt_init($con);
          if (!mysqli_stmt_prepare($stmt, $sql)){
            echo "Could not prepare statment". $sql;
          }else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_num_rows($result);
            $setImageOrder = $row + 1;

            // Insert statement
            $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (?, ?, ?, ?);";
            if (!mysqli_stmt_prepare($stmt, $sql)){
              echo "Could not prepare SQL statment". $sql;
            }else{
              mysqli_stmt_bind_param($stmt, 'ssss', $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
              mysqli_stmt_execute($stmt);

              move_uploaded_file($fileTempName, $fileDestination);
              //check image folder relative link
              header("Location: gallery.php?upload=success");
            }


          }

        }else{
          //check image folder relative link = ok
          header("Location: gallery.php?upload=success");

        }


      }else{
        echo "<h1 style='text-align: center; padding-top: 25px;'>File Size Too Big! &#x1F615</h1>";
        exit();
      }
    }else{
      echo "<h1 style='text-align: center; padding-top: 25px;'>Error &#x1F615</h1>";
      exit();
    }
  }else{
    echo "<h1 style='text-align: center; padding-top: 25px;'>Invalid File Type &#x1F615</h1>";
    exit();
  }

  print_r($file);


}else{
  echo "<h1 style='text-align: center; padding-top: 25px;'>There was an error uploading &#x1F615</h1>";
}

//Close connection
mysqli_close($con);

?>