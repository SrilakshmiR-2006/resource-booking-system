<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resource Booking System</title>

    <style>
        body {
            text-align: center;
            font-family: Arial;
        }
        a {
            display: block;
            margin: 10px;
            font-size: 18px;
        }
    </style>
</head>

<body>

<h1>Resource Booking System</h1>

<?php if(isset($_SESSION['user_id'])) { ?>

    <a href="calendar.php">Go to Calendar</a>
    <a href="my_bookings.php">My Bookings</a>
    <a href="logout.php">Logout</a>

<?php } else { ?>

    <a href="login.php">Login</a>
    <a href="register.php">Register</a>

<?php } ?>

</body>
</html>