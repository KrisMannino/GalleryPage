<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/photogallery.css">

  <title>Document</title>
</head>
<body>
<?php 
if (isset($_GET['id'])) {
    include("connect.php");
    $idGallery = mysqli_real_escape_string($con, $_GET['id']); 

    if ($stmt = mysqli_prepare($con, "SELECT * FROM gallery WHERE idGallery = ?")) {
        mysqli_stmt_bind_param($stmt, 'i', $idGallery);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='gallery-upload w-2/3 mt-6 mx-auto  p-4 border rounded mb-4 bg-white'>"
            . "<form action=\"editImage.php\" method=\"POST\" enctype=\"multipart/form-data\" class=\"mx-auto\">"
            . "<table class=' mx-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 text-2xl'>"  
            . "<tr>"

            . "<th>" . htmlspecialchars($row['titleGallery']) . "</th>"
            . "<th>" . htmlspecialchars($row['descGallery']) . "</th>"
            . "<th style= 'text-align: center;'> Image ID:" . htmlspecialchars($row['idGallery']) . "</th>"
            . "</tr>"
            . "<input type='hidden' name='idGallery' value='" . htmlspecialchars($idGallery) . "'>"
            . "<input  type='hidden' name='imgFullNameEdit' value='" . htmlspecialchars($row['imgFullNameGallery']) . "'>"

            . "<tr>"
            . "<td><input size='20'type=\"text\" name=\"titleEdit\" value=\"" . htmlspecialchars($row['titleGallery']) . "\" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'></td>"
            . "<td><input size='90' type=\"text\" name=\"descEdit\" value=\"" . htmlspecialchars($row['descGallery']) . "\" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'></td>"
            . "<td><button type=\"submit\" name=\"edit_image_btn\" class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>Save Changes</button></td>"
            . "</tr>"

            . "</form>"
            . "<tr><td colspan='4' style='text-align: center;'>"
            . "<form method='POST' action='delete_image.php' >"
            . "<input type='hidden' name='idGallery' value='" . htmlspecialchars($idGallery) . "'>"
            . "<button type='submit' class='text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center'>Delete</button>"
            . "</form>"
            . "</td></tr>";
        } else {
            echo "<p>No image found with ID " . htmlspecialchars($idGallery) . ".</p>";
        }

        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not prepare query: " . mysqli_error($con);
    }
} else {
    echo "<p>Image ID not provided.</p>";
}
?>
<script src="scripts/main.js"></script>
</body>
</html>