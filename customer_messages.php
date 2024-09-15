<?php
include 'assets/config/connection.php';

// Assuming you have a database connection $conn
$sql = "SELECT * FROM contactus ORDER BY submission_date DESC";
$result = $conn->query($sql);
?>