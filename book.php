<?php include 'db.php'; ?>

<form method="POST" action="save_booking.php">

Resource:
<select name="resource_id">
<?php
$res = $conn->query("SELECT * FROM resources");
while($row = $res->fetch_assoc()){
    echo "<option value='".$row['resource_id']."'>".$row['resource_name']."</option>";
}
?>
</select>
<br>

Date: <input type="date" name="date"><br>
Start Time: <input type="time" name="start"><br>
End Time: <input type="time" name="end"><br>

<button name="book">Book</button>

</form>