<?php
include('connect.php');

if (isset($_POST['idGallery'])) {
    $idGallery = mysqli_real_escape_string($con, $_POST['idGallery']);

    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        $sql = "DELETE FROM gallery WHERE idGallery = ?";
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $idGallery);
            if(mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Image deleted successfully.'); window.location.href='gallery.php';</script>";
            } else {
                echo "ERROR: Could not execute sql: " . mysqli_error($con);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "ERROR: Could not prepare sql: " . mysqli_error($con);
        }
    } else {
        // Confirmation form for image deletion
        echo "<p>Are you sure you want to delete this image with ID: " . htmlspecialchars($idGallery) . "?</p>";
        echo "<form method='POST' action='delete_image.php'>";
        echo "<input type='hidden' name='idGallery' value='" . htmlspecialchars($idGallery) . "'>";
        echo "<input type='hidden' name='confirm' value='yes'>";
        echo "<button type='submit'>Confirm Delete</button>";
        echo "</form>";
        echo "<a href='gallery.php'><button type='button'>Cancel</button></a>";
    }
} else {
    echo "ERROR: No image ID provided for deletion.";
}

// Close connection
mysqli_close($con);

?>
