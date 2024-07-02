<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    exit();
}

$user_id = $_SESSION['user_id'];
$service_id = $_POST['service_id'];

$sql_check = "SELECT * FROM basket WHERE user_id = '$user_id' AND service_id = '$service_id'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    $row = $result_check->fetch_assoc();
    $new_quantity = $row['quantity'] + 1;

    $sql_update = "UPDATE basket SET quantity = '$new_quantity' WHERE user_id = '$user_id' AND service_id = '$service_id'";
  
} else {
    $quantity = 1; 
    $sql_insert = "INSERT INTO basket (user_id, service_id, quantity) VALUES ('$user_id', '$service_id', '$quantity')";
   
}

$conn->close();
?>
