<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style\editdtrstyle.css">
    <link rel="stylesheet" href="style\navstyle.css">
    <title>DTR Editor</title>
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
    <div class="concon2">
        <div class="concon">
            <!--Edit-->
            <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post' class="formedit">
                Search DTR number : <input type='text' name='logid' size='10' /><br />
                <input type='submit' name='search' value='Search'>
            </form>

            <?php
            $countedit = 0;
            $SERVER = $_SERVER["PHP_SELF"];
            $q = '"';
            require "connect.php";
            echo '<div class="contform">';
            echo '<form action=' . $q . $SERVER . $q . 'method="post" class="edeet">';
            if (isset($_POST["search"])) {

                $logid = $_POST["logid"];
                mysqli_select_db($DBConnect, "dbemployee");
                $query = mysqli_query($DBConnect, "SELECT * FROM tbldtr WHERE logid='$logid'");
                $cell = mysqli_fetch_array($query);
                $id = $cell["empid"];
                $sday1 = $cell["startday"];
                $smonth1 = $cell["startmonth"];
                $syear1 = $cell["startyear"];
                $eday1 = $cell["endday"];
                $emonth1 = $cell["endmonth"];
                $eyear1 = $cell["endyear"];
                $timein = $cell["inlog"];
                $timeout = $cell["outlog"];
                $work = $cell["work0"];
                $log = $cell["logid"];




                echo '<div class="contform1">';
                echo "<input type='hidden' name='empid' value='$log'size='30'>";
                echo "Start Day : <input type='text' name='sday' value='$sday1' size='30' class='inbox1'><br/>";
                echo "Start Month : <input type='text' name='smonth' value='$smonth1' size='30' class='inbox2'><br/>";
                echo "Start Year : <input type='text' name='syear' value='$syear1' size='30' class='inbox3'><br/>";
                echo "End Day : <input type='text' name='eday' value='$eday1' size='30' class='inbox4'><br/>";
                echo "End Month : <input type='text' name='emonth' value='$emonth1' size='30' class='inbox5'><br/>";
                echo "End Year : <input type='text' name='eyear' value='$eyear1' size='30' class='inbox6'><br/>";
                echo "Time In : <input type='text' name='timein' value='$timein' size='30' class='inbox7'><br/>";
                echo "Time Out  : <input type='text' name='timeout' value='$timeout' size='30' class='inbox8'><br/>";
                echo "Workdays : <input type='text' name='work' value='$work' size='30' class='inbox9' ><br/>";


                echo '<div class="footer">';
                echo '<input type="submit" onclick="confirmation()" class="subbtn" name="edit" value="Save Changes"></input>';
                echo '</div>';
                echo "</form>";
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }



            if (isset($_POST["edit"])) {

                $id = $_POST["empid"];
                $sday1 = $_POST["sday"];
                $smonth1 = $_POST["smonth"];
                $syear1 = $_POST["syear"];
                $eday1 = $_POST["eday"];
                $emonth1 = $_POST["emonth"];
                $eyear1 = $_POST["eyear"];
                $timein = $_POST["timein"];
                $timeout = $_POST["timeout"];
                $work = $_POST["work"];

                mysqli_select_db($DBConnect, "dbemployee");
                mysqli_query($DBConnect, "UPDATE tbldtr SET startday='$sday1', startmonth='$smonth1',
                        startyear='$syear1', endday='$eday1', endmonth='$emonth1', endyear='$eyear1', inlog='$timein', outlog='$timeout', work0='$work' WHERE logid='$id'") or die(mysqli_error());

                echo "<h3 class='msg'>Record has been saved. Please check the modification.</h3>";
            }
            ?>
        </div>
        <div class="concon3">
            <!--Delete---->
            <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post' class="delform">
                Delete Log: <input type='text' name='logID' placeholder="Log ID" size='10' class="indel" /><br />
                <input type='submit' name='delete' value='Delete'>
            </form>
            <?php
            require "connect.php";
            mysqli_select_db($DBConnect, "dbemployee");
            if (isset($_POST["delete"])) {
                $delid = $_POST["logID"];
                echo $delid;

                mysqli_select_db($DBConnect, "dbemployee");
                mysqli_query($DBConnect, "DELETE FROM tbldtr WHERE logid = $delid");
                echo "delete succesful";
            } else if (isset($_POST["delete"]) == NULL) {
                echo '<hr>';
            } else {
                echo "failed";
            }
            ?>
            <!--View-->
            <form action="/ITPROG/REPO/dtr-itprog/dtrdata.php" method='post'>
                View Employee Log : <input type='text' placeholder="Employee ID" name='dtrID' size='10' /><br />
                <input type='submit' name='view' value='View DTR'>
            </form>
        </div>
</body>

</html>