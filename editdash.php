<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style\dashboardstyle.css">
    <link rel="stylesheet" href="style\navstyle.css">
    <title>Dashboard Editor</title>
</head>


<body>



    <nav role="navigation" class="primary-navigation">
        <ul>
            <li class="homenav"><a href="/ITPROG/REPO/dtr-itprog/login.php">Home</a></li>
            <li class="nav123"><a href=" /ITPROG/REPO/dtr-itprog/dtr.php">DTR</a></li>
            <li class="nav123"><a href="/ITPROG/REPO/dtr-itprog/dashboard.php">Dashboard</a></li>
            <li class="nav123"><a href="/ITPROG/REPO/dtr-itprog/logout.php">Logout</a></li>
        </ul>
    </nav>
<form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
    Enter ID: <input type="text" name="empid" size="8" /><br />
    Enter Name: <input type="text" name="empname" size="10" /><br />
    Enter Username: <input type="text" name="usercred" size="10" /><br />
    Enter Password: <input type="password" name="pwd" size="8" /><br />
    Enter Status: <input type="text" name="empstatus" size="5" /><br />
    Enter Gender: <input type="text" name="empgender" size="5" /><br />
    <input type="submit" name="add-data" value='Save' /><br />
</form>
<?php
                                    require "connect.php";
                                    if (isset($_POST["add-data"])) {
                                        mysqli_select_db($DBConnect, "dbemployee");
                                        $id = $_POST["empid"];
                                        $name = $_POST["empname"];
                                        $usercred = $_POST["usercred"];
                                        $passwd = $_POST["pwd"];
                                        $status = $_POST["empstatus"];
                                        $gender = $_POST["empgender"];
                                        
                                        
                                        $add = "INSERT INTO tblemployee (empid, empname, usercred, pwd, empstatus, empgender) VALUES ('$id', '$name', '$usercred','$passwd','$status','$gender')";
                                        mysqli_query($DBConnect, $add) or die(mysqli_error());
                                        echo "Records has been saved!!!";
                                        header("location:dashboard.php");
                                    } else {
                                        echo "Cannot Save!!!";
                                    }
?>


<form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
                                        Search Employee : <input type='text' name='eid' size='10' /><br />
                                        <input type='submit' name='search' value='Search'>
                                    </form>
                                    <?php
                                    $SERVER = $_SERVER["PHP_SELF"];
                                    $q = '"';
                                    require "connect.php";
                                    echo '<form action=' . $q . $SERVER . $q . 'method="post">';
                                    if (isset($_POST["search"])) {

                                        $eid = $_POST["eid"];
                                        mysqli_select_db($DBConnect, "dbemployee");
                                        $query = mysqli_query($DBConnect, "SELECT * FROM tblemployee WHERE empid='$eid'");
                                        $cell = mysqli_fetch_array($query);
                                        $id = $cell["empid"];
                                        $name = $cell["empname"];
                                        $usercred = $cell["usercred"];
                                        $passwd = $cell["pwd"];
                                        $status = $cell["empstatus"];
                                        $gender = $cell["empgender"];
                                        echo "<input type='hidden' name='id' value='" . $id . "'size='30'>";
                                        echo "Employee Name : <input type='text' name='name' value='" . $name . "' size='30'><br/>";
                                        echo "Employee Status : <input type='text' name='status' value='" . $status . "' size='30'><br/>";
                                        echo "Employee Gender : <input type='text' name='gender' value='" . $gender . "' size='30'><br/>";
                                        echo '<div class="modal-footer">';
                                        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                                        echo '<input type="submit" onclick="confirmation()" class="btn btn-primary" name="edit" value="Save Changes"></input>';
                                        echo '</div>';

                                        echo "</form>";
                                    }


                                    echo '</div>';
                                    ?>

        
                            <?php
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


<form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
                                        Search Employee : <input type='text' name='empID' size='10' /><br />
                                        <input type='submit' name='delete' value='Delete'>
                                    </form>
<?php


$DBConnect = mysqli_connect("localhost", "root", "")
or die("Unable to Connect" . mysqli_error());
mysqli_select_db($DBConnect, "dbemployee");
if (isset($_POST["delete"])) {
    $delid = $_POST["empID"];
    mysqli_query($DBConnect, "DELETE FROM tblemployee WHERE empid = $delid");
} else if (isset($_POST["delete"]) == NULL) {
    echo '<hr>';
} else {
    echo "failed";
}
?>

</body>

</html>