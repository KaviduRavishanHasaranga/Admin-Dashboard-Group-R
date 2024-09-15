<?php
include 'assets\config\connection.php'; // Include database connection file

// Check if an ID is passed via GET and is valid
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID

    // Prepare the DELETE query
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id); // Bind the integer value

    // Execute the query and handle the result
    if ($stmt->execute()) {
        // Redirect after successful deletion
        header("Location: manage_product.php?message=product_deleted");
        exit();
    } else {
        // Display error if something goes wrong
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close the prepared statement
} else {
    // Redirect if no valid ID is provided
    header("Location: manage_product.php?error=invalid_id");
    exit();
}
?>
