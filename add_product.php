<?php
include 'assets/components/nevigationbar.php';
include 'assets/components/mainside.php';
?>

<div class="form-container">
    <nav>
        <ul class="navbar">
            <li><a href="manage_product.php">Manage Products</a></li>
            <li><a href="add_product.php">Add Product</a></li>
        </ul>
    </nav>
    <form id="gemForm" action="product_process.php" method="POST" enctype="multipart/form-data">
        <br>
        <h1>Add Product</h1>

        <!-- Basic Information -->
        <section>
            <h2>Basic Information</h2>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter product name" required>

            <label for="category">Category:</label>
            <select id="category" name="category">
                <option value="Blue Sapphire">Blue Sapphire</option>
                <option value="Ruby">Ruby</option>
                <option value="Yellow Sapphire">Yellow Sapphire</option>
                <option value="Pink Sapphire">Pink Sapphire</option>
                <option value="White Sapphire">White Sapphire</option>
                <option value="Padparadscha">Padparadscha</option>
                <option value="Star Sapphire">Star Sapphire</option>
                <option value="Purple Sapphire">Purple Sapphire</option>
                <option value="Garnet">Garnet</option>
                <option value="Tourmaline">Tourmaline</option>
                <option value="Chrysoberyl">Chrysoberyl</option>
                <option value="Aquamarine">Aquamarine</option>
                <option value="Topaz">Topaz</option>
                <option value="Spinel">Spinel</option>
                <option value="Amethyst">Amethyst</option>
                <option value="Moonstone">Moonstone</option>
            </select>

            <label for="product_image">Product Images:</label>
            <input type="file" id="product_image1" name="image1_base64">
            <input type="file" id="product_image2" name="image2_base64">
            <input type="file" id="product_image3" name="image3_base64">
        </section>

        <!-- Product Specification -->
        <section>
            <h2>Product Specification</h2>
            <label for="carat_weight">Weight:</label>
            <input type="text" id="carat_weight" name="carat_weight">

            <label for="clarity">Clarity:</label>
            <input type="text" id="clarity" name="clarity">

            <label for="size">Size:</label>
            <input type="text" id="size" name="size">

            <label for="colour">Colour:</label>
            <input type="text" id="color" name="colour">

            <label for="sapecut">Shape & Cut:</label>
            <input type="text" id="sapecut" name="sapecut">

            <label for="treatment">Treatment:</label>
            <input type="text" id="treatment" name="treatment">

            <label for="certificate">Certificate:</label>
            <input type="text" id="certificate" name="certificate">
        </section>

        <!-- Price, Stock & Variants -->
        <section>
            <h2>Price, Stock & Variants</h2>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>

            <label for="stock">Stock Quantity:</label>
            <input type="number" id="stock" name="stock_quantity" required>
        </section>

        <!-- Product Description -->
        <section>
            <h2>Product Description</h2>
            <label for="description">Main Description:</label>
            <textarea id="description" name="description"></textarea>
        </section>

        <div class="form-actions">
            <button type="submit">Submit</button>
            <button type="reset">Save Draft</button>
        </div>
    </form>
</div>

<?php include 'assets/components/footer.php'; ?>

<script>
    document.getElementById('gemForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = event.target;

        const formData = new FormData(form);
        fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                if (result.trim() === "success") {
                    alert("Product added successfully!");
                    form.reset(); // Reset the form
                    window.scrollTo(0, 0); // Scroll to the top
                } else {
                    alert("Error: " + result);
                }
            })
            .catch(error => {
                alert("An error occurred: " + error.message);
            });
    });
</script>