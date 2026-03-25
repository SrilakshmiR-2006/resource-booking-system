<?php
session_start();
include 'db.php';

// 🔐 Check login
if(!isset($_SESSION['user_id'])){
    die("Please login first!");
}

$user_id = $_SESSION['user_id'];

// 🔹 Get data from calendar (GET)
$resource_id = $_GET['resource_id'];
$date = $_GET['date'];
$start = $_GET['start'];
$end = $_GET['end'];

// 🔹 Convert to datetime
$start_time = $date . " " . $start;
$end_time = $date . " " . $end;

// 🔹 Validate input
if(empty($resource_id) || empty($date) || empty($start) || empty($end)){
    die("Invalid input!");
}

// 🔹 Check if resource exists
$checkRes = $conn->query("SELECT * FROM resources WHERE resource_id = $resource_id");
if($checkRes->num_rows == 0){
    die("Invalid resource!");
}

// 🔹 Check time clash
$check = $conn->query("
    SELECT * FROM bookings 
    WHERE resource_id = $resource_id
    AND (
        ('$start_time' BETWEEN start_time AND end_time)
        OR
        ('$end_time' BETWEEN start_time AND end_time)
        OR
        (start_time BETWEEN '$start_time' AND '$end_time')
    )
");

// ❌ If clash
if($check->num_rows > 0){
    echo "<h2 style='color:red;'>❌ Time slot already booked!</h2>";
    exit();
}

// ✅ Insert booking
$insert = $conn->query("
    INSERT INTO bookings (user_id, resource_id, start_time, end_time)
    VALUES ($user_id, $resource_id, '$start_time', '$end_time')
");

// 🎉 Success
if($insert){
    echo "<h2 style='color:green;'>✅ Booking Successful!</h2>";
    echo "<br><a href='calendar.php'>Go Back to Calendar</a>";
} else {
    echo "Error: " . $conn->error;
}
?>