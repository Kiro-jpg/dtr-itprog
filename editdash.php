<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style\editdashstyle.css">
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

    <!--Add---->
    <div class="bigcon">
        <div class="addcon">
            <h3 class="msg">Add Employee Details</h3>
            <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post' class="edeet">
                Enter ID: <input type="text" name="empid" size="30" class="in1" /><br />
                Enter Name: <input type="text" name="empname" size="30" class="in2" /><br />
                Enter Username: <input type="text" name="usercred" size="30" class="in3" /><br />
                Enter Password: <input type="password" name="pwd" size="30" class="in4" /><br />
                Enter Status: <input type="text" name="empstatus" size="30" class="in5" /><br />
                Enter Gender: <input type="text" name="empgender" size="30" class="in6" /><br />
                <input type="submit" name="add-data" value='Add' class="addbtn" /><br />
            </form>
        </div>
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
        } else if (isset($_POST["add-data"]) == NULL) {
        } else {
            echo "Cannot Save!!!";
        }
        ?>
        <div class="edcon">
            <!--Edit---->
            <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
                Search Employee : <input type='text' name='eid' size='10' /><br />
                <input type='submit' name='search' value='Search'>
            </form>
        </div>

        <?php
        $SERVER = $_SERVER["PHP_SELF"];
        $q = '"';
        require "connect.php";
        echo '<div class="shedcon">';

        echo '<form action=' . $q . $SERVER . $q . 'method="post" class="edform">';
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
            echo "Employee Name : <input type='text' name='name' value='" . $name . "' size='30' class='edin1'><br/>";
            echo "Employee Status : <input type='text' name='status' value='" . $status . "' size='30' class='edin2'><br/>";
            echo "Employee Gender : <input type='text' name='gender' value='" . $gender . "' size='30' class='edin3'><br/>";
            echo "Employee Username : <input type='text' name='usern' value='" . $usercred . "' size='30' class='edin4'><br/>";
            echo "Employee Passwords : <input type='text' name='pass' value='" . $passwd . "' size='30' class='edin5'><br/>";
            echo '<div class="modal-footer">';
            echo '<input type="submit" onclick="confirmation()" class="editbtn" name="edit" value="Save Changes"></input>';
            echo '</div>';

            echo "</form>";
            echo '</div>';
        }

        ?>


        <?php
        if (isset($_POST["edit"])) {
            $newID = $_POST["id"];
            $newName = $_POST["name"];
            $newStat = $_POST["status"];
            $newGender = $_POST["gender"];
            $newUser = $_POST["usern"];
            $newPass = $_POST["pass"];


            mysqli_select_db($DBConnect, "dbemployee");
            mysqli_query($DBConnect, "UPDATE tblemployee SET empname='$newName', empstatus='$newStat',
                        empgender='$newGender', usercred='$newUser', pwd='$newPass' WHERE empid='$newID'") or die(mysqli_error());

            echo "<h3 class='msg2'>Record has been saved. Please check the modification.</h3>";
        }
        ?>

    </div>
    <div class="delcon">
        <!--Delete-->
        <form action='<?php echo $_SERVER["PHP_SELF"];  ?>' method='post' class="delform">
            Search Employee : <input type='text' name='empID' size='10' /><br />
            <input type='submit' name='delete' value='Delete'>
        </form>
    </div>
    <?php


    $DBConnect = mysqli_connect("localhost", "root", "")
        or die("Unable to Connect" . mysqli_error());
    mysqli_select_db($DBConnect, "dbemployee");
    if (isset($_POST["delete"])) {
        $delid = $_POST["empID"];
        mysqli_query($DBConnect, "DELETE FROM tblemployee WHERE empid = $delid");
    } else if (isset($_POST["delete"]) == NULL) {
    } else {
        echo "failed";
    }
    ?>

</body>

</html>