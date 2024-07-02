<?php
include 'db_connect.php';

$basket_id = $_POST['basket_id'];
$action = $_POST['action'];

if ($action == 'increment') {
    $sql = "UPDATE basket SET quantity = quantity + 1 WHERE id='$basket_id'";
} else if ($action == 'decrement') {
    $sql = "UPDATE basket SET quantity = quantity - 1 WHERE id='$basket_id' AND quantity > 1";
}

$conn->query($sql);
$conn->close();
?>
