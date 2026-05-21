<?php
session_start();
include "db.php";

if (
    !isset($_POST['resource_id']) ||
    !isset($_POST['date']) ||
    !isset($_POST['start_time']) ||
    !isset($_POST['end_time'])
) {
    die("Invalid request");
}

$resource_id = $_POST['resource_id'];
$date = $_POST['date'];
$start = $_POST['start_time'];
$end = $_POST['end_time'];

/* GET USER ID FROM SESSION */
$email = $_SESSION['user'];

$getUser = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$userData = mysqli_fetch_assoc($getUser);

$user_id = $userData['user_id'];

/* CHECK CONFLICT */
$check = mysqli_query($conn,"
SELECT * FROM bookings
WHERE resource_id='$resource_id'
AND booking_date='$date'
AND (
(start_time <= '$start' AND end_time > '$start')
OR
(start_time < '$end' AND end_time >= '$end')
OR
(start_time >= '$start' AND end_time <= '$end')
)
");

if(mysqli_num_rows($check)>0){
    die("Time slot already booked!");
}

/* INSERT BOOKING */
$query = "
INSERT INTO bookings(resource_id, user_id, booking_date, start_time, end_time)
VALUES('$resource_id','$user_id','$date','$start','$end')
";

if(mysqli_query($conn,$query)){
    header("Location: calendar.php");
    exit();
}else{
    echo mysqli_error($conn);
}
?>