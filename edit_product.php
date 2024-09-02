<?php
include 'assets\components\nevigationbar.php';
include 'assets\components\mainside.php';
include 'assets/config/connection.php';

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id == 0) {
    header("Location: product.php?error=invalid_id");
    exit();
}

// Fetch the product details
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $product = mysqli_fetch_assoc($result);
} else {
    header("Location: product.php?error=product_not_found");
    exit();
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
    $image1_base64 = !empty($_FILES['product_image']['tmp_name'][0]) ? imageToBase64($_FILES['product_image']['tmp_name'][0]) : $product['image1_base64'];
    $image2_base64 = !empty($_FILES['product_image']['tmp_name'][1]) ? imageToBase64($_FILES['product_image']['tmp_name'][1]) : $product['image2_base64'];
    $image3_base64 = !empty($_FILES['product_image']['tmp_name'][2]) ? imageToBase64($_FILES['product_image']['tmp_name'][2]) : $product['image3_base64'];

    // Update the product in the database
    $sql = "UPDATE products SET 
            product_name = '$product_name',
            category = '$category',
            image1_base64 = '$image1_base64',
            image2_base64 = '$image2_base64',
            image3_base64 = '$image3_base64',
            weight = '$carat_weight',
            clarity = '$clarity',
            size = '$size',
            color = '$color',
            shape_cut = '$shape_cut',
            treatment = '$treatment',
            certificate = '$certificate',
            price = '$price',
            stock_quantity = '$stock_quantity',
            description = '$description',
            updated_at = NOW()
            WHERE id = $product_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product updated successfully! Click Ok to continue'); window.location.href='product.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Function to convert image to base64
function imageToBase64($image)
{
    $imageData = file_get_contents($image);
    return base64_encode($imageData);
}

?>

<div class="form-container">
    <form id="gemForm" action="edit_product.php?id=<?php echo $product_id; ?>" method="POST" enctype="multipart/form-data">
        <br>
        <h1>Edit Product</h1>

        <!-- Basic Information -->
        <section>
            <h2>Basic Information</h2>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $product['product_name']; ?>" required>

            <label for="category">Category:</label>
            <select id="category" name="category">
                <option value="blue-sapphire" <?php echo $product['category'] == 'blue-sapphire' ? 'selected' : ''; ?>>Blue Sapphire</option>
                <option value="ruby" <?php echo $product['category'] == 'ruby' ? 'selected' : ''; ?>>Ruby</option>
                <option value="yellow-sapphire" <?php echo $product['category'] == 'yellow-sapphire' ? 'selected' : ''; ?>>Yellow Sapphire</option>
                <option value="pink-sapphire" <?php echo $product['category'] == 'pink-sapphire' ? 'selected' : ''; ?>>Pink Sapphire</option>
                <option value="white-sapphire" <?php echo $product['category'] == 'white-sapphire' ? 'selected' : ''; ?>>White Sapphire</option>
                <option value="padparadscha" <?php echo $product['category'] == 'padparadscha' ? 'selected' : ''; ?>>Padparadscha</option>
                <option value="star-sapphire" <?php echo $product['category'] == 'star-sapphire' ? 'selected' : ''; ?>>Star Sapphire</option>
                <option value="purple-sapphire" <?php echo $product['category'] == 'purple-sapphire' ? 'selected' : ''; ?>>Purple Sapphire</option>
                <option value="garnet" <?php echo $product['category'] == 'garnet' ? 'selected' : ''; ?>>Garnet</option>
                <option value="tourmaline" <?php echo $product['category'] == 'tourmaline' ? 'selected' : ''; ?>>Tourmaline</option>
                <option value="chrysoberyl" <?php echo $product['category'] == 'chrysoberyl' ? 'selected' : ''; ?>>Chrysoberyl</option>
                <option value="aquamarine" <?php echo $product['category'] == 'aquamarine' ? 'selected' : ''; ?>>Aquamarine</option>
                <option value="topaz" <?php echo $product['category'] == 'topaz' ? 'selected' : ''; ?>>Topaz</option>
                <option value="spinel" <?php echo $product['category'] == 'spinel' ? 'selected' : ''; ?>>Spinel</option>
                <option value="amethyst" <?php echo $product['category'] == 'amethyst' ? 'selected' : ''; ?>>Amethyst</option>
                <option value="moonstone" <?php echo $product['category'] == 'moonstone' ? 'selected' : ''; ?>>Moonstone</option>
            </select>

            <label for="product_image">Product Images:</label>
            <input type="file" id="product_image" name="product_image[]" multiple>
            <input type="file" id="product_image" name="product_image[]" multiple>
            <input type="file" id="product_image" name="product_image[]" multiple>
        </section>

        <!-- Product Specification -->
        <section>
            <h2>Product Specification</h2>
            <label for="carat_weight">Weight:</label>
            <input type="text" id="carat_weight" name="carat_weight" value="<?php echo $product['weight']; ?>">

            <label for="clarity">Clarity:</label>
            <input type="text" id="clarity" name="clarity" value="<?php echo $product['clarity']; ?>">

            <label for="size">Size:</label>
            <input type="text" id="size" name="size" value="<?php echo $product['size']; ?>">

            <label for="colour">Colour:</label>
            <input type="text" id="color" name="colour" value="<?php echo $product['color']; ?>">

            <label for="sapecut">Shape & Cut:</label>
            <input type="text" id="sapecut" name="sapecut" value="<?php echo $product['shape_cut']; ?>">

            <label for="treatment">Treatment:</label>
            <input type="text" id="treatment" name="treatment" value="<?php echo $product['treatment']; ?>">

            <label for="certificate">Certificate:</label>
            <input type="text" id="certificate" name="certificate" value="<?php echo $product['certificate']; ?>">
        </section>

        <!-- Price, Stock & Variants -->
        <section>
            <h2>Price, Stock & Variants</h2>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>" required>

            <label for="stock">Stock Quantity:</label>
            <input type="number" id="stock" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required>
        </section>

        <!-- Product Description -->
        <section>
            <h2>Product Description</h2>
            <label for="description">Main Description:</label>
            <textarea id="description" name="description"><?php echo $product['description']; ?></textarea>
        </section>

        <div class="form-actions">
            <button type="submit">Update Product</button>
            <a href="product.php"><button type="cancel">Cancel</button></a>
        </div>
    </form>
</div>

<?php include 'assets\components\footer.php'; ?>