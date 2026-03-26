<?php
session_start();
include "db.php";

/* VALIDATE INPUT */
if (
    !isset($_POST['resource_id']) ||
    !isset($_POST['date']) ||
    !isset($_POST['start_time']) ||
    !isset($_POST['end_time'])
) {
    die("Invalid request");
}

/* GET DATA */
$resource_id = $_POST['resource_id'];
$date = $_POST['date'];
$start = $_POST['start_time'];
$end = $_POST['end_time'];
$user = $_SESSION['user'];

/* INSERT QUERY */
$query = "INSERT INTO bookings (resource_id, booking_date, start_time, end_time, user_email)
          VALUES ('$resource_id', '$date', '$start', '$end', '$user')";

if (mysqli_query($conn, $query)) {

    // ✅ REDIRECT BACK TO CALENDAR (IMPORTANT)
    header("Location: calendar.php");
    exit();

} else {
    echo "Error: " . mysqli_error($conn);
}
?>