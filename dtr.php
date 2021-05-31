<?php
session_start();
$user = $_SESSION['getLogin'];

if ($user == NULL) {

    $message = "Please Login Again";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<script type='text/javascript'>window.location = '/ITPROG/REPO/dtr-itprog/login.php';</script>";
    //header("location:login.php"); 
} else
?>
<html>

<head>
    <title>Employee DTR</title>
    <link rel="stylesheet" href="style\dtrstyle.css">
    <link rel="stylesheet" href="style\navstyle.css">
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
    <center>
        <div class="big">
            <div class="container formcon">
                <h2>Work Schedule</h2>
                <h3>[ Online Daily Time Record ]</h3>
                <?php
            $DBConnect = mysqli_connect("localhost", "root", "")
                or die("Unable to Connect" . mysqli_error());
            mysqli_select_db($DBConnect, "dbemployee");

            $user = $_SESSION['getLogin'];

            $query = mysqli_query($DBConnect, "SELECT * FROM tblemployee WHERE usercred ='$user'");
            while ($retrieve = mysqli_fetch_array($query)) {
            }

                ?>

                <form action="dtrprocess.php" method="post">

                    Enter ID: <input type="text" name="empid" size="8" class="idbtn"><br>
                    Date of Effectivity: &nbsp;
                    <select name="startmonth">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>&nbsp;&nbsp;
                    <select name="startday">
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            echo "<option value=$i>$i</option>";
                        }
                        ?>
                    </select>&nbsp;&nbsp;
                    <select name="startyear">
                        <?php
                        for ($x = date("Y"); $x >= 2000; $x--) {
                            echo "<option value=$x>$x</option>";
                        }
                        ?>
                    </select> &nbsp; Cut Off Date: &nbsp;
                    <select name="endmonth">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>&nbsp;&nbsp;
                    <select name="endday">
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            echo "<option value=$i>$i</option>";
                        }
                        ?>
                    </select>&nbsp;&nbsp;
                    <select name="endyear">
                        <?php
                        for ($x = date("Y"); $x >= 2000; $x--) {
                            echo "<option value=$x>$x</option>";
                        }

                        ?>
                    </select>
                    <br /><br />
                    <?php
                    $dayArray = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                    echo "<table width='40%'>";
                    echo "<tr><th>/</th><th>Day</th><th>Time In</th><th>Time Out</th><tr>";
                    for ($day = 0; $day <= 5; $day++) {
                        echo "<tr><td><input type='checkbox' name='work$day' value='$dayArray[$day]'></td><td>" . $dayArray[$day] . "</td>" .
                            "<td align='center'><select name='in$day'><option></option>";
                        for ($timein = 0; $timein <= 24; $timein++) {
                            echo "<option value=$timein>$timein</option>";
                        }
                        echo "</select></td>";
                        echo "<td align='center'><select name='out$day'><option></option>";
                        for ($timeout = 0; $timeout <= 24; $timeout++) {
                            echo "<option value=$timeout>$timeout</option>";
                        }
                        echo "</select></td></tr>";
                    }
                    echo "</table>";
                    ?>
                    <br />
                    <input type="submit" name="enter" class="subbtn" value="Save"><input type="reset" class="subbtn1">

                </form>
            </div>

            <div class="chatcont">
                <div class="feedback-card">
                    <div class="feedback-header">
                        Simple Chat Client
                    </div>

                    <form method="POST" class="feedback-body">
                        <textarea ,type="text" class="feedback-body__email" placeholder="Client Message"
                            name="txtMessage"></textarea>
                        <?php
                        $host = "127.0.0.1";
                        $port = 50001;
                        set_time_limit(0);
                        if (isset($_POST["btnSend"])) {

                            $msg = $_REQUEST["txtMessage"];
                            $sock = socket_create(AF_INET, SOCK_STREAM, 0);
                            socket_connect($sock, $host, $port);

                            socket_write($sock, $msg, strlen($msg));

                            $reply = socket_read($sock, 1924);
                            $reply = trim($reply);
                            $reply = "Server says:\n" . $reply;
                        }
                        ?>
                        <textarea ,type="text" class="feedback-body__message"
                            placeholder="Server Reply:"><?php echo @$reply; ?></textarea>
                        <button type="submit" name="btnSend" class="feedback-body__submit">SEND</button>
                    </form>

                </div>
            </div>
        </div>
        <center>
</body>

</html>