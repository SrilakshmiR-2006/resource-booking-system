<?php include 'db.php'; ?>

<?php
if(isset($_POST['book'])){
$resource_id=$_POST['resource_id'];
$date=$_POST['date'];
$start=$_POST['start'];
$end=$_POST['end'];

// Check conflict
$check = $conn->query("SELECT * FROM bookings 
WHERE resource_id='$resource_id' 
AND booking_date='$date'
AND (start_time < '$end' AND end_time > '$start')");

if($check->num_rows > 0){
    echo "Time slot already booked!";
} else {
    $conn->query("INSERT INTO bookings(resource_id,booking_date,start_time,end_time)
    VALUES('$resource_id','$date','$start','$end')");
    
    echo "Booking successful!";
}
}
?>