<?php
include 'database.php';

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['user']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Set timezone
    date_default_timezone_set("Asia/Kolkata");
    $time = date('h:i:s', time());

    // Validate input
    if(!isset($username) || $username == "" || !isset($message) || $message == "") {
        $error = "Control your name or message!";
        header("Location:index.php?error=". urlencode($error));
    } else {
        $query = "INSERT INTO shouts(user, message, time) VALUES ('$username', '$message', '$time')";
        if(!mysqli_query($con, $query)) {
            die("Error: " . mysqli_error($con));
        } else {
            header("Location:index.php");
            exit();
        }

    }
}
?>