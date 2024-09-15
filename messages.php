<?php
include 'assets\components\nevigationbar.php';
include 'assets\components\mainside.php';
include 'customer_messages.php';
?>


<div class="form-container">
    <h2>Customer's Messages</h2><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Country</th>
            <th>City</th>
            <th>Phone</th>
            <th>Whatsapp</th>
            <th>Viber</th>
            <th>Telegram</th>
            <th>Subject</th>
            <th>Budget</th>
            <th>Message</th>
            <th>Submission Date</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["full_name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["country"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . ($row["whatsapp"] ? "Yes" : "No") . "</td>";
                echo "<td>" . ($row["viber"] ? "Yes" : "No") . "</td>";
                echo "<td>" . ($row["telegram"] ? "Yes" : "No") . "</td>";
                echo "<td>" . $row["subject"] . "</td>";
                echo "<td>" . $row["budget"] . "</td>";
                echo "<td>" . $row["message"] . "</td>";
                echo "<td>" . $row["submission_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='14'>No results found</td></tr>";
        }
        ?>
    </table>
</div>

<?php include 'assets/components/footer.php'; ?>