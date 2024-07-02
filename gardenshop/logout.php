<?php
session_start();

include 'db_connect.php';

if (isset($_SESSION['user_id']) && isset($_SESSION['basket'])) {
    $user_id = $_SESSION['user_id'];
    $basket = $_SESSION['basket'];

    foreach ($basket as $item) {
        $service_id = $item['id'];
        $quantity = $item['quantity'];

        $check_basket_sql = "SELECT * FROM basket WHERE user_id = ? AND service_id = ?";
        $stmt = $conn->prepare($check_basket_sql);
        $stmt->bind_param("ii", $user_id, $service_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $update_basket_sql = "UPDATE basket SET quantity = ? WHERE user_id = ? AND service_id = ?";
            $update_stmt = $conn->prepare($update_basket_sql);
            $update_stmt->bind_param("iii", $quantity, $user_id, $service_id);
            $update_stmt->execute();
        } else {
            $insert_basket_sql = "INSERT INTO basket (user_id, service_id, quantity) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_basket_sql);
            $insert_stmt->bind_param("iii", $user_id, $service_id, $quantity);
            $insert_stmt->execute();
        }
    }
}

$_SESSION = array();

session_destroy();

header("Location: index.php");
exit();
?>
