<html>

<head>
    <title>Chat Client</title>
</head>

<body>
    <h3>Simple Chat Client</h3>
    <form method="POST">
        Enter Message: <input type="text" name="txtMessage" size="20">
        <input type="submit" name="btnSend" value="send"><br /><br />

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
    $reply = "Server says:\t" . $reply;
}
?>

        <textarea rows="10" cols="45"><?php echo @$reply; ?></textarea>
    </form>