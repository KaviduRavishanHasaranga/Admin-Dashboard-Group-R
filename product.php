<?php
include 'assets\components\nevigationbar.php';
include 'assets\components\mainside.php';
include 'assets\config\connection.php';

// Check if there's a success message in the URL
if (isset($_GET['message']) && $_GET['message'] == 'product_updated') {
    echo "<script>alert('Product successfully updated!');</script>";
}

// Fetch products from the database
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

?>

<div class="form-container">

    <nav>
        <ul class="navbar">
            <li><a href="manage_product.php">Manage Products</a></li>
            <li><a href="add_product.php">Add Product</a></li>
        </ul>
    </nav>

    <h2>Product List</h2>

    <div class="product-table">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Weight</th>
                    <th>Clarity</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Shape & Cut</th>
                    <th>Treatment</th>
                    <th>Certificate</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Description</th>
                    <th>Image 1</th>
                    <th>Image 2</th>
                    <th>Image 3</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['weight'] . "</td>";
                        echo "<td>" . $row['clarity'] . "</td>";
                        echo "<td>" . $row['size'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>" . $row['shape_cut'] . "</td>";
                        echo "<td>" . $row['treatment'] . "</td>";
                        echo "<td>" . $row['certificate'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['stock_quantity'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";

                        // Display images if available
                        echo "<td>";
                        if (!empty($row['image1_base64'])) {
                            echo "<img src='data:image/jpeg;base64," . $row['image1_base64'] . "' width='50'>";
                        }
                        echo "</td>";

                        echo "<td>";
                        if (!empty($row['image2_base64'])) {
                            echo "<img src='data:image/jpeg;base64," . $row['image2_base64'] . "' width='50'>";
                        }
                        echo "</td>";

                        echo "<td>";
                        if (!empty($row['image3_base64'])) {
                            echo "<img src='data:image/jpeg;base64," . $row['image3_base64'] . "' width='50'>";
                        }
                        echo "</td>";

                        // Action buttons
                        echo "<td>";
                        echo "<a href='manage_product.php?id=" . $row['id'] . "'>Edit</a> | ";
                        echo "<a href='delete_product.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='17'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
mysqli_close($conn);
include 'assets\components\footer.php';
?>