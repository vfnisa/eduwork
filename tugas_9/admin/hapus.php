<?php
require 'database.php';

$id = $_GET['id'];
$query = "DELETE FROM products WHERE id=$id";

if ($conn->query($query) === TRUE) {
    header("Location: manajemenproduk.php");
} else {
    echo "Error: " . $conn->error;
}
?>
