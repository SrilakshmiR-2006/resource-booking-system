<?php include 'db.php'; ?>

<form method="POST">
Name: <input name="name"><br>
Email: <input name="email"><br>
Password: <input type="password" name="password"><br>
<button name="submit">Register</button>
</form>

<?php
if(isset($_POST['submit'])){
$name=$_POST['name'];
$email=$_POST['email'];
$pass=password_hash($_POST['password'],PASSWORD_DEFAULT);

$conn->query("INSERT INTO users(name,email,password)
VALUES('$name','$email','$pass')");

echo "Registered!";
}
?>