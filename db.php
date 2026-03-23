<?php
$conn = new mysqli("localhost","root","","resource_booking");

if($conn->connect_error){
    die("Connection failed");
}
?>