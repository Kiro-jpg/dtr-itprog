<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style\dtrprocessstyle.css">
    <link rel="stylesheet" href="style\navstyle.css">
    <title>Validation</title>
</head>


<body bgcolor="#ccc">
    <p> </p>
    <nav role="navigation" class="primary-navigation">
        <ul>
            <li class="homenav"><a href="/ITPROG/REPO/dtr-itprog/login.php">Home</a></li>
            <li class="nav123"><a href=" /ITPROG/REPO/dtr-itprog/dtr.php">DTR</a></li>
            <li class="nav123"><a href="/ITPROG/REPO/dtr-itprog/dashboard.php">Dashboard</a></li>
            <li class="nav123"><a href="/ITPROG/REPO/dtr-itprog/logout.php">Logout</a></li>
        </ul>
    </nav>
    <center>

        <?php

        error_reporting(E_ALL | E_NOTICE | E_ERROR | E_PARSE);
        error_reporting(E_ERROR ^ E_PARSE);
        $smonth = $_POST["startmonth"];
        $sday = $_POST["startday"];
        $syear = $_POST["startyear"];
        $emonth = $_POST["endmonth"];
        $eday = $_POST["endday"];
        $eyear = $_POST["endyear"];
        $count = 0;
        $x = 0;
        $hinmour = 0;
        $overmour = 0;

        $counter = ($eday - $sday) + 1;

        if (strcmp($emonth, $smonth) != 0) {
            echo "Log not validated!";
        } else if (strcmp($eyear, $syear) != 0) {
            echo "Log not validated!";
        } else if ($counter <= 6 && $counter > 0) {
            echo "<h3>Date of Effectivity: ", $smonth, ", ", $sday, ", ", $syear, " | Cutoff Date: ", $emonth, ", ", $eday, ", ", $eyear, "</h3>";
            echo '<div class="wrapper">';
            echo '<div class="table">';
            echo '<div class="row header green">';
            echo '<div class="cell">';
            echo 'Days Present';
            echo '</div>';
            echo '<div class="cell">';
            echo 'Time In';
            echo '</div>';
            echo '<div class="cell">';
            echo 'Time Out';
            echo '</div>';
            echo '<div class="cell">';
            echo 'Hours Per Day';
            echo '</div>';
            echo '</div>';
            for ($x = 0; $x <= 5; $x++) {
                if ($_POST["work$x"] != null) {

                    $count++;
                } else if ($_POST["work$x"] == null) {
                }
            }

            for ($x = 0; $x <= $count; $x++) {
                if ($count == 6) {
                    echo "You are not allowed to tick all days.";
                    $x = 6;
                } else if ($x < 6) {

                    if (($_POST["in$x"] != null) && ($_POST["out$x"] != null)) {
                        $minhour = $_POST["out$x"] - $_POST["in$x"];
                        $minhour -= 1;
                        $hinmour += $minhour;

                        if ($minhour > 8) {
                            echo '<div class="row">';
                            echo '<div class="cell" data-title="Days Present">', $_POST["work$x"], '</div>';
                            echo '<div class="cell" data-title="Time In">', $_POST["in$x"], '</div>';
                            echo '<div class="cell" data-title="Time Out">', $_POST["out$x"], '</div>';
                            echo '<div class="cell" data-title="Hours Per Day">', $minhour, '</div>';
                            echo '</div>';
                            // echo "<tr>", "<td colspan='10' >", $_POST["work$x"], " - <span style='color: red;'>You are going overtime.</span>", "</td>", "<td colspan='20'>", $_POST["in$x"], "</td>", "<td colspan='30'>", $_POST["out$x"], "</td>", "<td colspan='40'>", $minhour, "</td>", "</tr>";
                            $overmour += $minhour - 8;
                        } else if ($minhour < 6) {
                            echo '<div class="row">';
                            echo '<div class="cell" data-title="Days Present">', $_POST["work$x"], '</div>';
                            echo '<div class="cell" data-title="Time In">', $_POST["in$x"], '</div>';
                            echo '<div class="cell" data-title="Time Out">', $_POST["out$x"], '</div>';
                            echo '<div class="cell" data-title="Hours Per Day">', $minhour, '</div>';
                            echo '</div>';
                            // echo "<tr>", "<td colspan='10' >", $_POST["work$x"], " - <span style='color: red;'>Not Validated.</span>", "</td>", "<td colspan='20'>", $_POST["in$x"], "</td>", "<td colspan='30'>", $_POST["out$x"], "</td>", "<td colspan='40'>", $minhour, "</td>", "</tr>";
                            $hinmour -= $minhour;
                        } else if ($minhour >= 6 && $minhour <= 8) {
                            echo '<div class="row">';
                            echo '<div class="cell" data-title="Days Present">', $_POST["work$x"], '</div>';
                            echo '<div class="cell" data-title="Time In">', $_POST["in$x"], '</div>';
                            echo '<div class="cell" data-title="Time Out">', $_POST["out$x"], '</div>';
                            echo '<div class="cell" data-title="Hours Per Day">', $minhour, '</div>';
                            echo '</div>';
                            //echo "<tr>", "<td colspan='10' >", $_POST["work$x"], "</td>", "<td colspan='20'>", $_POST["in$x"], "</td>", "<td colspan='30'>", $_POST["out$x"], "</td>", "<td colspan='40'>", $minhour, "</td>", "</tr>";
                        }
                    }
                }
            }
            if ($hinmour != 0) {
                echo '<div class="row">';
                echo '<div class="cell" data-title="Days Present">Total Rendered Hours:</div>';
                echo '<div class="cell" data-title="Days Present"></div>';
                echo '<div class="cell" data-title="Days Present"> </div>';
                echo '<div class="cell" data-title="Days Present">', $hinmour, '</div>';
                echo '</div>';
                echo '<div class="row">';
                echo '<div class="cell" data-title="Days Present">OverTime (OT):</div>';
                echo '<div class="cell" data-title="Days Present">  </div>';
                echo '<div class="cell" data-title="Days Present"> </div>';
                echo '<div class="cell" data-title="Time In">', $overmour, '</div>';
                echo '</div>';
                //echo "<tr>", "<td colspan ='60'>Total Rendered Hours: </td>", "<td colspan='50'>", $hinmour, "</td>", "</tr>";
                //echo "<tr>", "<td colspan ='60'>Overtime (OT):  </td>", "<td colspan='50'>", $overmour, "</td>", "</tr>";
            }
        } else {
            if ($sday > $eday) {
                echo "Log not validated! start date is greater than the end date!";
                echo "<h2>Start Date: ", $sday, "</h2>", "<h2> End Date: ", $eday, "</h2>";
            } else {
                echo "Log not validated! Total days is less than the desired amount.";
                echo "<br>";
                echo "Total days logged: ", $counter;
            }
        }

        echo '</div>';
        echo '</div>';
        ?>



        <button class="modbtn1"><a href="/ITPROG/REPO/dtr-itprog/editdtr.php" target="_Blank">Modify</a></button>
        <!-- Modal -->
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


    </center>



    <?php
    $DBConnect = mysqli_connect("localhost", "root", "")
        or die("Unable to Connect" . mysqli_error());
    mysqli_select_db($DBConnect, "dbemployee");

    if (isset($_POST["enter"])) {
        $eid = $_POST["empid"];
        $smonth = $_POST["startmonth"];
        $sday = $_POST["startday"];
        $syear = $_POST["startyear"];
        $emonth = $_POST["endmonth"];
        $eday = $_POST["endday"];
        $eyear = $_POST["endyear"];

        for ($x = 0; $x <= 5; $x++) {
            if ($_POST["work$x"] != null) {
                $yes = $_POST["work$x"];
                $in = $_POST["in$x"];
                $out = $_POST["out$x"];
                $countwork = rand(1000, 10000);
                mysqli_query($DBConnect, "INSERT INTO tbldtr (empid, startmonth, startday, startyear, endday, endmonth, endyear, work0, logid, inlog, outlog) VALUES ('$eid', '$smonth', '$sday', '$syear', '$eday', '$emonth', '$eyear', '$yes', '$countwork', '$in', '$out')");
            }
        }
    } else {
        echo "No";
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>