
<?php
// save.php

// database connection 
include 'conn.php';
session_start();
//check user is login
if (isset($_SESSION['user_id'])) {
  

    $logoSize = $_POST['logo_size'] ?? '';
    $tscolorURL = $_POST['tscolor_url'] ?? '';
    $words = $_POST['words'] ?? '';
    $wordsColor = $_POST['words_color'] ?? '';
    $priProduct = $_POST['priproduct'] ?? '';
    $quantity = $_POST['quantity'] ?? 1;
    $ts_size = $_POST['ts_size'];
    $user_id = $_SESSION['user_id'];

    // Upload the logo image and save URL in the database
    $logoImage = $_FILES['logo_image'];
    $logoImageName = $logoImage['name'];
    $logoImageTmpName = $logoImage['tmp_name'];
    $logoImageExtension = pathinfo($logoImageName, PATHINFO_EXTENSION); // Get the file extension
    $randomFileName = uniqid() . '.' . $logoImageExtension; // Generate a random file name
    $logoImageDestination = 'upload_logo/' . $randomFileName; // Set the desired destination path

    if (move_uploaded_file($logoImageTmpName, $logoImageDestination)) {
        // File upload successful
        $logoURL = $randomFileName;
    } else {
        // File upload failed
        $logoURL = '';
    }

    // Save file URLs to the database
    //user_id	logo_url	logo_size	tscolor_url	words	words_color	design_id	priproduct	 ts_size
    $stmt = $conn->prepare("INSERT INTO prevdesigns (user_id,logo_url, logo_size, tscolor_url, words, words_color, priproduct, quantity,ts_size) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("issssssis", $user_id, $logoURL, $logoSize, $tscolorURL, $words, $wordsColor, $priProduct, $quantity, $ts_size);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Design saved successfully!";
    } else {
        echo "Failed to save design.";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
else{
    echo '1';
}


?>
