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
  <!-- Navbar -->
<nav class="bg-white border-gray-200 dark:bg-gray-900 bg-white fixed top-0 w-full shadow-md">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="https://krismannino.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="images/Kris-Logo-512x512.png" class="h-8" alt="Kris' Logo" />
          <span class="text-4xl font-extrabold self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Kris Mannino</span>
      </a>

      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="align-middle font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li class="flex items-center">
          <h1 class="flex items-center text-4xl font-extrabold leading-none tracking-tight " >Gallery</h1>
          </li>
          <li>
          <!-- Toggle form -->
          <button onclick="toggleForm()" id="toggleBtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Add Image
          </button>
          </li>
          <li class="flex items-center">
            <a href="https://github.com/KrisMannino" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
          </li>
        
          <li class="flex items-center">
            <a href="mailto:krismannino@gmail.com" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
          </li>
        </ul>
      </div>
    </div>
      <!-- Form hidden -->
  <div id="formContainer" class="hidden">
      <div class="gallery-upload mt-6 mx-auto max-w-md p-4 border rounded mb-4">
        <form action="gallery_upload.php" method="post" enctype="multipart/form-data" class="max-w-sm mx-auto">
        <div class="mb-5">
          <input type="text" name="filename" placeholder="File name..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-5">
          <input type="text" name="filetitle" placeholder="Image Title..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-5">
          <input type="text" name="filedescription" placeholder="Image Description..."class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-5">
          <input type="file" name="file">
        </div>
        <div class="mb-5">
          <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
        </div>
        </form>
      </div>
    </div>
  </nav>


    <div class="gallery-container grid grid-cols-1 md:grid-cols-4 gap-4 ">
  <!-- <div class="grid gap-4"> -->
        <?php

          include("connect.php");

          $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";
          $stmt = mysqli_stmt_init($con);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL statement failed!";
            
          }else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)){


              echo "<div class=\"shadow-lg rounded-lg overflow-hidden bg-white\">";
              echo "<img class=\"p-3\" src=\"images/gallery/" . $row['imgFullNameGallery'] . "\" alt=\"user image\" class=\"h-auto max-w-full\">";
              echo "<h3 class='text-4xl font-semibold shadow-md p-2'>" . $row['titleGallery'] . "</h3>";
              echo "<p class='p-2'>" . $row['descGallery'] . "</p>";
              echo "</div>";
            }
          }
        ?>

      <!-- </div> -->
    </div>

<!-- Footer sticky -->
<footer class="footer fixed bottom-0 left-0  w-full p-4 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600">
  <span class="text-md text-gray-500 sm:text-center dark:text-gray-400">
    <a href="https://KrisMannino.com/" class="hover:underline">
    
    Kris Mannino     Final Project | CST-6305 Internet Technologies
    </a>
  </span>
  <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
      <li>
          <a href="https://github.com/KrisMannino" class="hover:underline me-4 md:me-6">About</a>
      </li>

      <li>
          <a href="mailto:krismannino@gmail.com" class="hover:underline">Contact</a>
      </li>
      <li>
        <a href="https://krismannino.com/" class="hover:underline me-4 md:me-6"><img src="images/Kris-Logo-512x512.png" alt="KRis' Logo" style="max-height: 25px;"></a>
    </li>
  </ul>
</footer>
<script src="scripts/main.js"></script>
</body>
</html>