<?php
if (isset($_POST["loginBtn"])) {
    $user = $_POST["username"];
    $pass = $_POST["pass"];

    error_reporting(E_ALL ^ E_NOTICE);
    $DBConnect = mysqli_connect("localhost", "root", "")
    or die("Unable to Connect" . mysqli_error());

    mysqli_select_db($DBConnect, "dbemployee");
    $query = mysqli_query($DBConnect, "SELECT pwd, usercred FROM tblemployee WHERE pwd = '$pass' AND usercred ='$user'");

    $b = mysqli_fetch_array($query);
    $c = $b["pwd"];
    $a = $b["usercred"];

    $hashedpass = md5($c);
    $hashedinput = md5($pass);

    if ($user == $a && $hashedpass == $hashedinput) {
        session_start(); //to start the session
        $_SESSION['getLogin'] = $user; //this will hold the session variable to identify the user of the system
        header("location:dtr.php"); //this sets the headers for the HTTP response given by the server

    } else {
        header("location:login.php?error=1");
    }
}