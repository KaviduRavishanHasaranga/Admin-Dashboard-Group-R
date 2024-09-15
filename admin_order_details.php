<?php
include 'assets/components/nevigationbar.php';
include 'assets/components/mainside.php';
include 'assets/config/connection.php';

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);

    // Fetch the order details
    $sql_order = "SELECT orders.order_id, orders.order_date, orders.total_price, orders.status, users.fname 
                  FROM orders
                  JOIN users ON orders.user_id = users.id
                  WHERE orders.order_id = ?";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("i", $order_id);
    $stmt_order->execute();
    $result_order = $stmt_order->get_result();


    if ($result_order->num_rows == 1) {
        $order = $result_order->fetch_assoc();
?>
        <div class='form-container'>
            <h2>Order #<?php echo $order['order_id']; ?> Details</h2>
            <p>Customer: <?php echo $order['fname']; ?></p>
            <p>Order Date: <?php echo $order['order_date']; ?></p>
            <p>Total Price: $<?php echo $order['total_price']; ?></p>
            <p>Status: <?php echo $order['status']; ?></p>

            <h3>Order Items:</h3>
            <table border="1">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price at Purchase</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch order items along with product names
                    $sql_items = "SELECT products.product_name AS product_name, order_items.quantity, order_items.price_at_purchase 
                              FROM order_items
                              JOIN products ON order_items.product_id = products.id
                              WHERE order_items.order_id = ?";
                    $stmt_items = $conn->prepare($sql_items);
                    $stmt_items->bind_param("i", $order_id);
                    $stmt_items->execute();
                    $result_items = $stmt_items->get_result();

                    while ($item = $result_items->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $item['product_name'] . "</td>";
                        echo "<td>" . $item['quantity'] . "</td>";
                        echo "<td>$" . $item['price_at_purchase'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

<?php
    } else {
        echo "<p>Order not found.</p>";
    }
    $stmt_order->close();
    $stmt_items->close();
} else {
    echo "<p>Invalid order ID.</p>";
}
include 'assets/components/footer.php';
?>