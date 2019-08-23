<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");

if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else{
    header("Location: register.php");
}
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Water Colors</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/watercolor.js"></script>
        <script src="assets/js/jquery.Jcrop.js"></script>
        <script src="assets/js/jcrop_bits.js"></script>
        
        <!-- CSS -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/51271ac046.js"></script>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/jquery.Jcrop.css">
    </head>
    <body>

        <div class="top_bar">
            <div class="logo">
                <a href="index.php">WaterColors</a>
            </div>  
            <nav>
                <a href="<?php echo $userLoggedIn; ?>">
                    <?php echo $user['first_name']; ?>
                </a>
                <a href="index.php"><i class="fas fa-home"></i></a>
                <a href="#"><i class="far fa-envelope"></i></a>
                <a href="#"><i class="far fa-bell"></i></a>
                <a href="requests.php"><i class="fas fa-user-friends"></i></a>
                <a href="#"><i class="fas fa-cog"></i></a>
                <a href="includes/handlers/logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </nav>  
        </div>
        <div class="wrapper">

        