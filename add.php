<form action="add.php" method="post">
    Enter ID: <input type="text" name="eid" size="8" /><br />
    Enter Name: <input type="text" name="ename" size="50" /><br />

    <input type="submit" name="Save" /><br />
</form>
<?php
error_reporting(E_ALL ^ E_NOTICE);

$DBConnect = mysqli_connect("localhost", "root", "") or die("Unable to Connect" . mysqli_error());

mysqli_select_db($DBConnect, "dbemployee");

if (isset($_POST["Save"])) {
    $eid = $_POST["eid"];
    $ename = $_POST["ename"];

    $add = "INSERT INTO tblemployee (empid, empname) VALUES ('$eid', '$ename')";
    mysqli_query($DBConnect, $add) or die(mysqli_error());
    echo "Records has been saved!!!";
} else {
    echo "Cannot Save!!!";
}

?>