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
    <title>Document</title>
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



    <div class="wrapper">
        <div class="table">
            <div class="row header blue">
                <div class="cell">Username </div>
                <div class="cell">Name </div>
                <div class="cell">Password </div>
                <div class="cell">Status </div>

            </div>


            <?php
            require "connect.php";
            mysqli_select_db($DBConnect, "dbemployee");
            $query = mysqli_query($DBConnect, "SELECT * FROM tblemployee ORDER BY empname");
            while ($retrieve = mysqli_fetch_array($query)) {
                echo '<div class="row">';
                echo '<div class="cell" data-title="Username">' . $retrieve["empid"] . '</div>';
                echo '<div class="cell" data-title="Name">' . $retrieve["empname"] . '</div>';
                echo '<div class="cell" data-title="Password">************ </div>';
                echo '<div class="cell" data-title="Status">' . $retrieve["empstatus"] . '</div>';

                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            ?>
            <div class="btncon">

                <!-- ADD -->
                <div class="btnbtn" data-title="Active"><button class="modbtn1" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Add</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
                                    Search Student : <input type='text' name='eid' size='10' /><br />
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

                            </div>
                        </div>
                    </div>
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

                    <!-- EDIT -->
                    <div class="btnbtn" data-title="Active"><button class="modbtn2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Edit</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
                                        Search Student : <input type='text' name='eid' size='10' /><br />
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

                                </div>
                            </div>
                        </div>
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

                        <!-- Delete -->
                        <div class="btnbtn" data-title="Active"><button class="modbtn3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Delete</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='post'>
                                            Search Student : <input type='text' name='eid' size='10' /><br />
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

                                    </div>
                                </div>
                            </div>
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

                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
                            crossorigin="anonymous">
                        </script>

</body>

</html>