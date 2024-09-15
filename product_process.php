<?php
// Include database connection
include 'assets/config/connection.php';

// Function to convert image to base64
function imageToBase64($image) {
    $imageData = file_get_contents($image);
    return base64_encode($imageData);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $carat_weight = mysqli_real_escape_string($conn, $_POST['carat_weight']);
    $clarity = mysqli_real_escape_string($conn, $_POST['clarity']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $color = mysqli_real_escape_string($conn, $_POST['colour']);
    $shape_cut = mysqli_real_escape_string($conn, $_POST['sapecut']);
    $treatment = mysqli_real_escape_string($conn, $_POST['treatment']);
    $certificate = mysqli_real_escape_string($conn, $_POST['certificate']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $stock_quantity = mysqli_real_escape_string($conn, $_POST['stock_quantity']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Handle image uploads and convert them to base64
    $image1_base64 = null;
    $image2_base64 = null;
    $image3_base64 = null;

    // Check and convert each image file to base64
    if (!empty($_FILES['image1_base64']['tmp_name'])) {
        $image1_base64 = imageToBase64($_FILES['image1_base64']['tmp_name']);
    }
    if (!empty($_FILES['image2_base64']['tmp_name'])) {
        $image2_base64 = imageToBase64($_FILES['image2_base64']['tmp_name']);
    }
    if (!empty($_FILES['image3_base64']['tmp_name'])) {
        $image3_base64 = imageToBase64($_FILES['image3_base64']['tmp_name']);
    }

    // Insert data into the products table
    $sql = "INSERT INTO products (product_name, category, image1_base64, image2_base64, image3_base64, weight, clarity, size, color, shape_cut, treatment, certificate, price, stock_quantity, description, created_at, updated_at)
            VALUES ('$product_name', '$category', '$image1_base64', '$image2_base64', '$image3_base64', '$carat_weight', '$clarity', '$size', '$color', '$shape_cut', '$treatment', '$certificate', '$price', '$stock_quantity', '$description', NOW(), NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "success"; // Return success message for JavaScript
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn); // Return error message
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
