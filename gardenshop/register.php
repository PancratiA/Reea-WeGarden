<!DOCTYPE html>
<html>
    <head> <link rel="stylesheet" href="login.css"></head>
<body>
<?php
session_start(); 
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $check_sql = "SELECT * FROM users WHERE name = '$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO users (name, password, email) VALUES ('$username', '$password', '$email')";

        if ($conn->query($insert_sql) === TRUE) {
            $_SESSION['user_id'] = $conn->insert_id;
            header("Location: services.php");
            exit();
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
            exit();
        }
    }
}
?>

<div >
<button class="close-btn" onclick="closeRegister()"style="float: right;">x</button>

        <h2>Register</h2>
        <form id="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <button type="submit">Register</button>
        </form>

</div>

<script>
function closeRegister() {
    window.history.back();
}

document.getElementById("register-form").addEventListener("submit", function(event) {
    event.preventDefault(); 
    var formData = new FormData(this);

    fetch('register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'success') {
            //alert('Registration successful!');
            closeRegister();
            header("Location: services.php");
            exit();
        } else {
          //  alert(data); 
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>

</body>
</html>