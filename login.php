<?php
session_start();
if(isset($_SESSION['getLogin'])) {
    
    header("Location:dtr.php"); // redirects them to homepage
    exit; // for good measure
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
    <link rel="stylesheet" href="style\style.css">
    <script type="text/javascript">
    function confirmation() {
        alert("Confirm Modification of Record?")
    }
    </script>
</head>

<body>
    <div class="big">
        <div class="logincont">
            <div class="session">
                <div class="left">
                </div>
                <form name="frm" method="post" action="check.php">
                    <h4>We are <span>TRIO</span></h4>
                    <p>Welcome back! Log in to your account to view today's schedule.</p>
                    <div class="floating-label">
                        <input placeholder="Username" type="text" name="username" autocomplete="off" required>
                        <label for="username">Username:</label>
                        <div class="icon">
                            <svg enable-background="new 0 0 100 100" version="1.1" viewBox="0 0 100 100"
                                xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                <style type="text/css">
                                .st0 {
                                    fill: none;
                                }
                                </style>
                                <g transform="translate(0 -952.36)">
                                    <path
                                        d="m17.5 977c-1.3 0-2.4 1.1-2.4 2.4v45.9c0 1.3 1.1 2.4 2.4 2.4h64.9c1.3 0 2.4-1.1 2.4-2.4v-45.9c0-1.3-1.1-2.4-2.4-2.4h-64.9zm2.4 4.8h60.2v1.2l-30.1 22-30.1-22v-1.2zm0 7l28.7 21c0.8 0.6 2 0.6 2.8 0l28.7-21v34.1h-60.2v-34.1z" />
                                </g>
                                <rect class="st0" width="100" height="100" />
                            </svg>

                        </div>
                    </div>
                    <div class="floating-label">
                        <input placeholder="Password" type="password" name="pass" autocomplete="off">
                        <label for="pass">Password:</label>
                        <div class="icon">

                            <svg enable-background="new 0 0 24 24" version="1.1" viewBox="0 0 24 24"
                                xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                <style type="text/css">
                                .st0 {
                                    fill: none;
                                }

                                .st1 {
                                    fill: #010101;
                                }
                                </style>
                                <rect class="st0" width="24" height="24" />
                                <path class="st1" d="M19,21H5V9h14V21z M6,20h12V10H6V20z" />
                                <path class="st1"
                                    d="M16.5,10h-1V7c0-1.9-1.6-3.5-3.5-3.5S8.5,5.1,8.5,7v3h-1V7c0-2.5,2-4.5,4.5-4.5s4.5,2,4.5,4.5V10z" />
                                <path class="st1"
                                    d="m12 16.5c-0.8 0-1.5-0.7-1.5-1.5s0.7-1.5 1.5-1.5 1.5 0.7 1.5 1.5-0.7 1.5-1.5 1.5zm0-2c-0.3 0-0.5 0.2-0.5 0.5s0.2 0.5 0.5 0.5 0.5-0.2 0.5-0.5-0.2-0.5-0.5-0.5z" />
                            </svg>
                        </div>

                    </div>

                    <button type="submit" value="Login" name="loginBtn">Log in</button>
                    <?php
if (isset($_GET["error"])) {
    $error = $_GET["error"];

    //this line will be called by the check.php if the login credentials are incorrect
    if ($error == 1) {
        echo "<p class='flash' align='center'>Username and/or password invalid</p>";
    }
}

?>
                </form>
            </div>
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
</body>

</html>