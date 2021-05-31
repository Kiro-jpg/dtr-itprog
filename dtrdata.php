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
    <link rel="stylesheet" href="style\dtrprocessstyle.css">
    <link rel="stylesheet" href="style\navstyle.css">
    <title>DTR Data</title>
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

    <?php
    require "connect.php";
    if (isset($_POST["view"])) {
        $empid = $_POST["dtrID"];
   
    mysqli_select_db($DBConnect, "dbemployee");
    $query = mysqli_query($DBConnect, "SELECT * FROM tbldtr WHERE empid = $empid");
    // $table = mysqli_query($DBConnect, "SELECT * FROM tblemployee WHERE empid = $empid");
    // $retrieve = mysqli_fetch_array($table);

    // $name = $retrieve["empname"];
    
    $count = 0;
        
        $hinmour = 0;
        $overmour = 0;
   //echo '<h2>Data for '. $name.'</h2>';
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
   
   while ($cell = mysqli_fetch_array($query)){

           if (($cell["inlog"] != null) && ($cell["outlog"] != null)) {
               $minhour = $cell["outlog"] - $cell["inlog"];
               $minhour -= 1;
               $hinmour += $minhour;

               if ($minhour > 8) {
                   echo '<div class="row">';
                   echo '<div class="cell" data-title="Days Present">', $cell["work0"], '</div>';
                   echo '<div class="cell" data-title="Time In">', $cell["inlog"], '</div>';
                   echo '<div class="cell" data-title="Time Out">', $cell["outlog"], '</div>';
                   echo '<div class="cell" data-title="Hours Per Day">', $minhour, '</div>';
                   echo '</div>';
                   // echo "<tr>", "<td colspan='10' >", $_POST["work$x"], " - <span style='color: red;'>You are going overtime.</span>", "</td>", "<td colspan='20'>", $_POST["in$x"], "</td>", "<td colspan='30'>", $_POST["out$x"], "</td>", "<td colspan='40'>", $minhour, "</td>", "</tr>";
                   $overmour += $minhour - 8;
               } else if ($minhour < 6) {
                    echo '<div class="row">';
                    echo '<div class="cell" data-title="Days Present">', $cell["work0"], '</div>';
                    echo '<div class="cell" data-title="Time In">', $cell["inlog"], '</div>';
                    echo '<div class="cell" data-title="Time Out">', $cell["outlog"], '</div>';
                    echo '<div class="cell" data-title="Hours Per Day">', $minhour, '</div>';
                    echo '</div>';
                   // echo "<tr>", "<td colspan='10' >", $_POST["work$x"], " - <span style='color: red;'>Not Validated.</span>", "</td>", "<td colspan='20'>", $_POST["in$x"], "</td>", "<td colspan='30'>", $_POST["out$x"], "</td>", "<td colspan='40'>", $minhour, "</td>", "</tr>";
                   $hinmour -= $minhour;
               } else if ($minhour >= 6 && $minhour <= 8) {
                    echo '<div class="row">';
                    echo '<div class="cell" data-title="Days Present">', $cell["work0"], '</div>';
                    echo '<div class="cell" data-title="Time In">', $cell["inlog"], '</div>';
                    echo '<div class="cell" data-title="Time Out">', $cell["outlog"], '</div>';
                    echo '<div class="cell" data-title="Hours Per Day">', $minhour, '</div>';
                    echo '</div>';
                   //echo "<tr>", "<td colspan='10' >", $_POST["work$x"], "</td>", "<td colspan='20'>", $_POST["in$x"], "</td>", "<td colspan='30'>", $_POST["out$x"], "</td>", "<td colspan='40'>", $minhour, "</td>", "</tr>";
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
        $SERVER = $_SERVER["PHP_SELF"];
                                    $q = '"';
                                    require "connect.php";
        echo '<form action=' . $q . $SERVER . $q . 'method="post">';
        echo "Search Employee : <input type='text' name='dtrID' size='10' /><br />";
        echo "<input type='submit' name='view' value='View Data'>";
        echo "</form>";

    }
echo '</div>';
echo '</div>';
?>
</body>
</html>