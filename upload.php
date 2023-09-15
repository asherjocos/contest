<?php
include "connection.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the contestant name
    $contestantName = $_POST["contestantName"];
    $category = $_POST["category"];

    // Get the uploaded image
    $image = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];

    // Move the uploaded image to a desired location
    move_uploaded_file($image_tmp, "uploads/" . $image);

    // Change the name of the file before saving to avoid duplicated file names
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);
    $new_image_name = uniqid() . '.' . $file_extension;
    $new_image_path = "uploads/" . $new_image_name;
    move_uploaded_file($image_tmp, $new_image_path);
    $image = $new_image_name;
    

    // Insert the contestant name and image into the database
    // $conn = new mysqli("localhost", "username", "password", "database");
    $stmt = $conn->prepare("INSERT INTO contestant (name, image, category) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $contestantName, $image, $category);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Alert upload successful and return to index.html
    echo "<script>alert('Upload successful'); window.location.href = 'upload.html';</script>";
}

?>
