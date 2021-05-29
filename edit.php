<html>

<head>
    <title>Edit Module</title>
    <script type="text/javascript">
    function confirmation() {
        alert("Confirm Modification of Record?")
    }
    </script>
</head>

<body>
    <h1>Update Module</h1>
    <hr>
    <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
        Search Student : <input type='text' name='eid' size='10' /><br />
        <input type='submit' name='search' value='Search'>
    </form>

    <form action="delete.php" method="post">
        <h2>Delete Data</h2>
        Enter Log ID: <input type="text" name="empID" size="8"><br>
        <input type="submit" name="enter" value="Delete">
    </form>

    <?php
    $SERVER = $_SERVER["PHP_SELF"];
    $q = '"';
require "connect.php";
echo '<form action='.$q.$SERVER.$q.'method="post">';
if (isset($_POST["search"])) {

    $eid = $_POST["eid"];
    mysqli_select_db($DBConnect, "dbemployee");
    $query = mysqli_query($DBConnect, "SELECT * FROM tblemployee WHERE empid='$eid'");
    $cell = mysqli_fetch_array($query);
    $id = $cell["empid"];
    $name = $cell["empname"];
    $status = $cell["empstatus"];
    $gender = $cell["empgender"];
    echo "<input type='hidden' name='id' value='" . $id . "'size='30'>";
    echo "Employee Name : <input type='text' name='name' value='" . $name . "' size='30'><br/>";
    echo "Employee Status : <input type='text' name='status' value='" . $status . "' size='30'><br/>";
    echo "Employee Gender : <input type='text' name='gender' value='" . $gender . "' size='30'><br/>";

    echo "<br /><input type='submit' onclick='confirmation()' name='edit' value='Save' />";
    echo "</form>";
}

if (isset($_POST["edit"])) {
    $newID = $_POST["id"];
    $newName = $_POST["name"];
    $newStat = $_POST["status"];
    $newGender = $_POST["gender"];

    mysqli_select_db($DBConnect, "dbemployee");
    mysqli_query($DBConnect, "UPDATE tblemployee SET empname='$newName', empstatus='$newStat',
            empgender='$newGender' WHERE empid='$newID'") or die(mysqli_error());

    echo "<h3>Record has been saved. Please check the modification below.</h3>";

    $query = mysqli_query($DBConnect, "SELECT * FROM tblemployee WHERE empid='$newID'");
    $fetch = mysqli_fetch_array($query);
    echo "Employee Name : " . $fetch["empname"] . "<br />";
    echo "Employee Status : " . $fetch["empstatus"] . "<br />";
    echo "Employee Gender : " . $fetch["empgender"] . "<br />";

}
?>

    <a href='dbquery.php'>View All</a>
</body>

</html>