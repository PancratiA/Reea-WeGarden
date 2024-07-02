<?php
session_start(); 

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $username = mysqli_real_escape_string($conn, $username);
   
    $check_username_sql = "SELECT id, password FROM users WHERE name = '$username'";
    $check_username_result = $conn->query($check_username_sql);

    if ($check_username_result && $check_username_result->num_rows == 1) {
        $user_data = $check_username_result->fetch_assoc();
        $stored_password = $user_data['password'];

        if ($password == $stored_password) { 
            $_SESSION['user_id'] = $user_data['id'];
            
            $user_id = $_SESSION['user_id'];
            $load_basket_sql = "
                SELECT b.service_id, b.quantity, s.name, s.price 
                FROM basket b
                JOIN services s ON b.service_id = s.id
                WHERE b.user_id = ?";
            $stmt = $conn->prepare($load_basket_sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $_SESSION['basket'] = [];
            while ($row = $result->fetch_assoc()) {
                $_SESSION['basket'][] = [
                    'id' => $row['service_id'],
                    'name' => $row['name'],
                    'price' => $row['price'],
                    'quantity' => $row['quantity']
                ];
            }

            header("Location: services.php");
            exit();
        } else {
            echo "Invalid password";
            exit();
        }
    } else {
        echo "Invalid username";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div>
<button class="close-btn" onclick="closeLogin()" style="float: right;">x</button>

    <h2>Login</h2>
    <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    
</div>

<script>
function closeLogin() {
    window.history.back();
}

</script>

</body>
</html>
