<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];

$result = $conn->query("
SELECT r.resource_name, b.start_time, b.end_time 
FROM bookings b
JOIN resources r ON b.resource_id = r.resource_id
WHERE b.user_id = $user_id
");

echo "<h2>My Bookings</h2>";

while($row = $result->fetch_assoc()){
    echo "<p>";
    echo $row['resource_name'] . " | ";
    echo $row['start_time'] . " to " . $row['end_time'];
    echo "</p>";
}
?>