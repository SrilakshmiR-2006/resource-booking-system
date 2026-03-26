<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Resource Booking System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;

            /* SAME background as login */
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .home-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            width: 350px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .title {
            font-weight: 600;
            margin-bottom: 25px;
        }

        .btn-custom {
            width: 100%;
            margin: 10px 0;
            border-radius: 8px;
            padding: 10px;
        }
    </style>
</head>

<body>

<div class="home-card">
    <h3 class="title">Resource Booking System</h3>

    <a href="login.php" class="btn btn-primary btn-custom">Login</a>
    <a href="register.php" class="btn btn-outline-primary btn-custom">Register</a>
</div>

</body>
</html>