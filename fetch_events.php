<?php
include 'db.php';

$result = $conn->query("
    SELECT r.resource_name, b.booking_date, b.start_time, b.end_time
    FROM bookings b
    JOIN resources r ON b.resource_id = r.resource_id
");

$events = [];

while ($row = $result->fetch_assoc()) {

    $events[] = [
        "title" => $row['resource_name'],
        "start" => $row['booking_date'] . "T" . $row['start_time'],
        "end"   => $row['booking_date'] . "T" . $row['end_time']
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
?>