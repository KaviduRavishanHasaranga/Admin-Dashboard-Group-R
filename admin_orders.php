<?php
include 'assets/components/nevigationbar.php';
include 'assets/components/mainside.php';
include 'assets/config/connection.php';

// Fetch all orders from the `orders` table, sorted by order date in descending order
$sql_orders = "SELECT orders.order_id, orders.order_date, orders.total_price, orders.status, users.fname 
               FROM orders
               JOIN users ON orders.user_id = users.id
               ORDER BY orders.order_date DESC";
$result_orders = mysqli_query($conn, $sql_orders);

if (mysqli_num_rows($result_orders) > 0) {
?>
    <div class="form-container">
        <nav>
            <ul class="navbar">
                <li><a href="manage_product.php">Order Management</a></li>
                <li><a href="add_product.php">Reviews Management</a></li>
            </ul>
        </nav>

        <div class="order-list">
            <h2>Order List</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($order = mysqli_fetch_assoc($result_orders)) {
                        echo "<tr>";
                        echo "<td>" . $order['order_id'] . "</td>";
                        echo "<td>" . $order['fname'] . "</td>";
                        echo "<td>" . $order['order_date'] . "</td>";
                        echo "<td>$" . $order['total_price'] . "</td>";
                        echo "<td>" . $order['status'] . "</td>";
                        echo "<td><a href='admin_order_details.php?order_id=" . $order['order_id'] . "'>View Details</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
} else {
    echo "<p>No orders found.</p>";
}
include 'assets/components/footer.php';
?>
