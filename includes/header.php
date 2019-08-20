<?php
require 'config/config.php';

if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
}
else{
    header("Location: register.php");
}
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Social Network</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    </head>
    <body>

        <div class="top_bar">
            <div class="logo">
                <a href="index.php">DODO</a>
            </div>
        
        </div>