<?php

$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //Email
$em2 = ""; //Confirm email
$password = ""; //Password
$password2 =""; //Confirm Password
$date = ""; //sign up data
$error_array = array(); //holds error messages

if(isset($_POST['register_button'])){
    //registration form values

    //First Name
    $fname = strip_tags($_POST['reg_fname']); //remove html tags
    $fname = str_replace(' ', '', $fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); // take the str first, make all characters to lowercase, then capitalize
    $_SESSION['reg_fname'] = $fname; //stores first name into session variable

    //Last Name
    $lname = strip_tags($_POST['reg_lname']); //remove html tags
    $lname = str_replace(' ', '', $lname); //remove spaces
    $lname = ucfirst(strtolower($lname)); // take the str first, make all characters to lowercase, then capitalize
    $_SESSION['reg_lname'] = $lname; //stores last name into session variable

    //email
    $em = strip_tags($_POST['reg_email']); //remove html tags
    $em = str_replace(' ', '', $em); //remove spaces
    $em = ucfirst(strtolower($em)); // take the str first, make all characters to lowercase, then capitalize
    $_SESSION['reg_email'] = $em; //stores email into session variable

    //email2
    $em2 = strip_tags($_POST['reg_email2']); //remove html tags
    $em2 = str_replace(' ', '', $em2); //remove spaces
    $em2 = ucfirst(strtolower($em2)); // take the str first, make all characters to lowercase, then capitalize
    $_SESSION['reg_email2'] = $em2; //stores email2 into session variable

    //password
    $password = strip_tags($_POST['reg_password']); //remove html tags
    $password2 = strip_tags($_POST['reg_password2']); //remove html tags

    $date = date("Y-m-d"); //gets current date

    if($em == $em2){
        // check if email is in valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
            
            // Check if email already exists
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

            //count the number of rows returnes
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0){
                array_push($error_array, "Email already in use<br/>");
            }
        }
        else {
            array_push($error_array, "Invalid email format<br/>");
        }
    }
    else {
        array_push($error_array, "Emails don't match<br/>");
    }

    if(strlen($fname) > 25 || strlen($fname) < 2){
        array_push($error_array, "Your first name must be between 2 and 25 characters<br/>");
    }

    if(strlen($lname) > 25 || strlen($lname) < 2){
        array_push($error_array, "Your last name must be between 2 and 25 characters<br/>");
    }

    if($password != $password2){
        array_push($error_array, "Your passwords do not match<br/>");
    }
    else{
        if(preg_match('/[^A-Za-z0-9]/',$password)){
            array_push($error_array, "Your password can only contain english characters or numbers<br/>");
        }
    }

    if(strlen($password>30) || strlen($password) <5){
        array_push($error_array, "Your password must be between 5 and 30 characters<br/>");
    }

    if(empty($error_array)){
        $password = md5($password); // encrypt password before sending database

        //generate username by concatenating first name and last name
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        $i = 0;
        //if username exists add number to username
        while(mysqli_num_rows($check_username_query) != 0){
            $i++; // add 1 to i
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        //profile picture assignment
        $rand = rand(1,2); //random number between 1 and 2

        if($rand == 1)
            $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        else if($rand == 2)
            $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";

        $query = mysqli_query($con, "INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES (NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',');");

        array_push($error_array, "<span style='color:#14c800;'>You're all set! Go ahead and login!</span><br/>");

        // clear session variables
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    }
}
?>