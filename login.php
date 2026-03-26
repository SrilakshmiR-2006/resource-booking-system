<?php
ob_start();
session_start();
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {

    $_SESSION['user'] = $email;

    header("Location: calendar.php");
    exit();

} else {
    $error = "Invalid password";
}

} else {
    echo "USER NOT FOUND";
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body>

<div class="login-card">
    <h3 class="text-center mb-3">Login</h3>

    <?php if ($error != "") { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
        <p style="text-align:center; margin-top:10px;">
    Don't have an account? 
    <a href="register.php" style="color:#2563eb; text-decoration:none; font-weight:500;">
        Register here
    </a>
</p>
    </form>
</div>

</body>
</html>