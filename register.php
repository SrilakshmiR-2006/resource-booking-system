<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <style>
       body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background: #ffffff;
    padding: 30px;
    border-radius: 16px;
    width: 350px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1e293b;
}

input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 14px;
}

input:focus {
    border-color: #4f46e5;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    background: #4f46e5;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 15px;
}

button:hover {
    background: #4338ca;
}

.link {
    text-align: center;
    margin-top: 15px;
}

.link a {
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
}

.link a:hover {
    text-decoration: underline;
}
    </style>
</head>

<body>

<div class="container">
    <h2>Create Account</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Enter Name" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit">Register</button>
    </form>

    <div class="link">
        <a href="login.php">Already have an account?</a>
    </div>
</div>

</body>
</html>

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