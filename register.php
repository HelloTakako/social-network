<?php
$con = mysqli_connect("localhost", "root", "test", "social-network");

if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
}

$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //Email
$em2 = ""; //Confirm email
$password = ""; //Password
$password2 =""; //Confirm Password
$date = ""; //sign up data
$error_array = ""; //holds error messages

if(isset($_POST['register_button'])){
    //registration form values

    //First Name
    $fname = strip_tags($_POST['reg_fname']); //remove html tags
    $fname = str_replace(' ', '', $fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); // take the str first, make all characters to lowercase, then capitalize

    //Last Name
    $lname = strip_tags($_POST['reg_lname']); //remove html tags
    $lname = str_replace(' ', '', $lname); //remove spaces
    $lname = ucfirst(strtolower($lname)); // take the str first, make all characters to lowercase, then capitalize

    //email
    $em = strip_tags($_POST['reg_email']); //remove html tags
    $em = str_replace(' ', '', $em); //remove spaces
    $em = ucfirst(strtolower($em)); // take the str first, make all characters to lowercase, then capitalize

    //email2
    $em2 = strip_tags($_POST['reg_email2']); //remove html tags
    $em2 = str_replace(' ', '', $em2); //remove spaces
    $em2 = ucfirst(strtolower($em2)); // take the str first, make all characters to lowercase, then capitalize

    //password
    $password = strip_tags($_POST['reg_password']); //remove html tags
    $password2 = strip_tags($_POST['reg_password2']); //remove html tags

    $date = date("Y-m-d"); //gets current date

    if($em == $em2){
        // check if email is in valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
            
            // Check if email already exists
            
        }
        else {
            echo "Invalid email format";
        }
    }
    else {
        echo "Emails don't match";
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | DODO</title>
</head>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" required>
        <br />
        <input type="text" name="reg_lname" placeholder="Last Name" required>
        <br />
        <input type="email" name="reg_email" placeholder="Email" required>
        <br />
        <input type="email" name="reg_email2" placeholder="Confirm Email" required>
        <br />
        <input type="password" name="reg_password" placeholder="Password" required>
        <br />
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br />
        <input type="submit" name="register_button" value="Register">
    </form>
</body>
</html>