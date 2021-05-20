<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation</title>
</head>

<body bgcolor="#ccc">
    <p> </p>
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
} else if ($counter <= 6) {
    echo "<h3>Date of Effectivity: ", $smonth, ", ", $sday, ", ", $syear, " | Cutoff Date: ", $emonth, ", ", $eday, ", ", $eyear, "</h3>";
    echo "<table border='5'>
    <tr>
        <th colspan='10'>Days present</th>
        <th colspan='20'>Time in</th>
        <th colspan='30'>Time out</th>
        <th colspan='40'>Hours per day</th>
    </tr>";
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
                    echo "<tr>", "<td colspan='10' >", $_POST["work$x"], " - <span style='color: red;'>You are going overtime.</span>", "</td>", "<td colspan='20'>", $_POST["in$x"], "</td>", "<td colspan='30'>", $_POST["out$x"], "</td>", "<td colspan='40'>", $minhour, "</td>", "</tr>";
                    echo "<br>";
                    $overmour += $minhour;
                    $hinmour -= $minhour;
                } else if ($minhour < 6) {

                    echo "<tr>", "<td colspan='10' >", $_POST["work$x"], " - <span style='color: red;'>Not Validated.</span>", "</td>", "<td colspan='20'>", $_POST["in$x"], "</td>", "<td colspan='30'>", $_POST["out$x"], "</td>", "<td colspan='40'>", $minhour, "</td>", "</tr>";
                    $hinmour -= $minhour;
                } else if ($minhour >= 6 && $minhour <= 8) {
                    echo "<tr>", "<td colspan='10' >", $_POST["work$x"], "</td>", "<td colspan='20'>", $_POST["in$x"], "</td>", "<td colspan='30'>", $_POST["out$x"], "</td>", "<td colspan='40'>", $minhour, "</td>", "</tr>";

                }
            }
        }
    }
    if ($hinmour != 0) {
        echo "<tr>", "<td colspan ='60'>Total Rendered Hours: </td>", "<td colspan='50'>", $hinmour, "</td>", "</tr>";
        echo "<tr>", "<td colspan ='60'>Overtime (OT):  </td>", "<td colspan='50'>", $overmour, "</td>", "</tr>";
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

?>
    </center>


    <?php
$DBConnect = mysqli_connect("localhost", "root", "")
or die("Unable to Connect" . mysqli_error());
mysqli_select_db($DBConnect, "dbemployee");

if (isset($_POST["enter"])) {
    $eid = $_POST["empid"];
    $ename = $_POST["empname"];
    $smonth = $_POST["startmonth"];
    $sday = $_POST["startday"];
    $syear = $_POST["startyear"];
    $emonth = $_POST["endmonth"];
    $eday = $_POST["endday"];
    $eyear = $_POST["endyear"];
    $countwork = 0;

    for ($x = 0; $x <= 5; $x++) {
        if ($_POST["work$x"] != null) {
            $yes = $_POST["work$x"];
            $in = $_POST["in$x"];
            $out = $_POST["out$x"];
            $countwork++;
            mysqli_query($DBConnect, "INSERT INTO tbldtr (empid, empname, startmonth, startday, startyear, endday, endmonth, endyear, work0, logid, inlog, outlog) VALUES ('$eid', '$ename', '$smonth', '$sday', '$syear', '$eday', '$emonth', '$eyear', '$yes', '$countwork', '$in', '$out')");
        }
    }

} else {
    echo "No";
}

?>
</body>

</html>