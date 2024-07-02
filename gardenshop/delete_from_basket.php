<?php
include 'db_connect.php';

$basket_id = $_POST['basket_id'];
$sql = "DELETE FROM basket WHERE id='$basket_id'";

$conn->query($sql);
$conn->close();
?>
