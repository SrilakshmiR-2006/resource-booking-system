<?php include 'db.php'; ?>

<form method="POST">
Email: <input name="email"><br>
Password: <input type="password" name="password"><br>
<button name="login">Login</button>
</form>

<?php
if(isset($_POST['login'])){
$email=$_POST['email'];
$password=$_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $result->fetch_assoc();

if($user && password_verify($password,$user['password'])){
    echo "Login successful!";
} else {
    echo "Invalid credentials";
}
}
?>