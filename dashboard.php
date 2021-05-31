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
                <div class="cell">ID </div>
                <div class="cell">Name </div>
                <div class="cell">Username </div>
                <div class="cell">Password </div>
                <div class="cell">Status </div>
                <div class="cell">Gender </div>


            </div>


            <?php
            require "connect.php";
            mysqli_select_db($DBConnect, "dbemployee");
            $query = mysqli_query($DBConnect, "SELECT * FROM tblemployee ORDER BY empname");
            while ($retrieve = mysqli_fetch_array($query)) {
                echo '<div class="row">';
                echo '<div class="cell" data-title="ID">' . $retrieve["empid"] . '</div>';
                echo '<div class="cell" data-title="Name">' . $retrieve["empname"] . '</div>';
                echo '<div class="cell" data-title="Username">' . $retrieve["usercred"] . '</div>';
                echo '<div class="cell" data-title="Password">' . $password = str_repeat("*", strlen($retrieve["pwd"])) . '</div>';
                echo '<div class="cell" data-title="Status">' . $retrieve["empstatus"] . '</div>';
                echo '<div class="cell" data-title="Gender">' . $retrieve["empgender"] . '</div>';

                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            ?>


            <!-- ADD -->
            <div class="btnbtn" data-title="Active">
                <button class="modbtn1"><a href="/ITPROG/REPO/dtr-itprog/editdash.php">Modify</a></button>

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


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
                crossorigin="anonymous">
            </script>
            <script src="style\main.js"></script>


</body>

</html>