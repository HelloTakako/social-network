<?php
session_start();
$con = mysqli_connect("localhost", "root", "test", "social_network");

if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
}

if(isset($_POST['register_button'])){
    //registration form values
        $query = mysqli_query($con, "INSERT INTO `test` (`id`, `name`) VALUES (NULL, 'bbb');");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | Social Network Application</title>
</head>
<body>
    <form action="test.php" method="POST">
        <input type="submit" name="register_button" value="Register">
    </form>
</body>
</html>