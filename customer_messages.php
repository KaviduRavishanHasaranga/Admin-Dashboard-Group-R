<?php
include 'assets/config/connection.php';

$sql = "SELECT * FROM contactus ORDER BY submission_date DESC";
$result = $conn->query($sql);
?>