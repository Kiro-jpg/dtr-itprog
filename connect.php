<?php
error_reporting(E_ALL ^ E_NOTICE);
$DBConnect = mysqli_connect("localhost", "root", "")
or die("Unable to Connect" . mysqli_error());