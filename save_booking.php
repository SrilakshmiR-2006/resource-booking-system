<?php
include 'db.php';

// Get data
$resource_id = $_GET['resource_id'];
$date = $_GET['date'];
$start = $_GET['start'];
$end = $_GET['end'];
$user_id = $_GET['user'];

// Combine date + time
$start_datetime = $date . " " . $start;
$end_datetime = $date . " " . $end;

// Check conflict
$check = "SELECT * FROM bookings 
WHERE resource_id = '$resource_id'
AND (
    ('$start_datetime' BETWEEN CONCAT(booking_date,' ',start_time) AND CONCAT(booking_date,' ',end_time))
    OR
    ('$end_datetime' BETWEEN CONCAT(booking_date,' ',start_time) AND CONCAT(booking_date,' ',end_time))
)";

$result = mysqli_query($conn, $check);

if(mysqli_num_rows($result) > 0){
    echo "Time slot already booked!";
    exit();
}

// Insert correctly
$sql = "INSERT INTO bookings (user_id, resource_id, booking_date, start_time, end_time)
VALUES ('$user_id', '$resource_id', '$date', '$start', '$end')";

if(mysqli_query($conn, $sql)){
    echo "<h2 style='color:green;'>✅ Booking Successful!</h2>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>