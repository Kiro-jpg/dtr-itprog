<?php
 $text = "Geremiah";
 echo $text."<br />";
 echo md5($text); //encryption
 echo "<br /><br />";
 $pass = "Geremiah";
 echo $pass."<br />";
 echo md5($pass); //encryption
 

$a = mysqli_query("SELECT password FROM tblemployee WHERE...");
$b = mysqli_fetch_array($a)
$c = $b[pass];

md5($pass) == $c;

?>