<?php
ob_start(); //turns on output buffering
session_start();

$timezon = date_default_timezone_set("America/Vancouver");

$con = mysqli_connect("localhost", "root", "test", "social_network");

if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
}
?>