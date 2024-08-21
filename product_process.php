<?php
include 'assets\config\connection.php';

// Set parameters and execute
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = (int) $_POST['category_id'];  // Cast as integer
    $price = (float) $_POST['price'];  // Cast as float
    $carat_weight = (float) $_POST['carat_weight'];  // Cast as float
    $color = $_POST['color'];
    $certification = $_POST['certification'];

    

    // Handle image upload
    if ($_FILES['image']['name']) {
        $target_dir = "Products Images/".$file_name;
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image_url = $target_file;
    } else {
        $image_url = null;
    }

    $stock_quantity = (int) $_POST['stock_quantity'];  // Cast as integer

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>