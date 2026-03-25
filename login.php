<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            font-family: Arial;
            text-align: center;
        }
        input, button {
            padding: 8px;
            margin: 5px;
        }
        button {
            background: green;
            color: white;
            border: none;
        }
    </style>
</head>

<body>

<h2>Login</h2>

<form method="POST">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button name="login">Login</button>
</form>

<?php
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // 🔍 check user
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        // 🔐 verify password
        if(password_verify($password, $row['password'])){

            // ✅ store session
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['name'] = $row['name'];

            echo "<h3 style='color:green;'>Login successful!</h3>";

            // 🔄 redirect to calendar
            header("Location: calendar.php");
            exit();

        } else {
            echo "<h3 style='color:red;'>Wrong password!</h3>";
        }

    } else {
        echo "<h3 style='color:red;'>User not found!</h3>";
    }
}
?>

</body>
</html>