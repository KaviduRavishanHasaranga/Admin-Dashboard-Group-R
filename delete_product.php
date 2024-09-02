<?php
include 'assets/config/connection.php';

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id == 0) {
    header("Location: product.php?error=invalid_id");
    exit();
}

// Delete the product from the database
$sql = "DELETE FROM products WHERE id = $product_id";

if (mysqli_query($conn, $sql)) {
    header("Location: product.php?message=product_deleted");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
