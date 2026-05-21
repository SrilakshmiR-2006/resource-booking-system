<?php
include 'db.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users(name,email,password)
              VALUES('$name','$email','$pass')";

    if(mysqli_query($conn,$query)){

        header("Location: login.php");
        exit();

    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <style>
        body{
            margin:0;
            font-family:Arial;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg,#667eea,#764ba2);
        }

        .container{
            background:white;
            padding:30px;
            border-radius:12px;
            width:350px;
        }

        input{
            width:100%;
            padding:10px;
            margin-top:10px;
        }

        button{
            width:100%;
            padding:10px;
            margin-top:15px;
            background:#4f46e5;
            color:white;
            border:none;
        }
    </style>
</head>

<body>

<div class="container">

<h2>Register</h2>

<form method="POST">

    <input type="text" name="name" placeholder="Name" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Register</button>

</form>

</div>

</body>
</html>