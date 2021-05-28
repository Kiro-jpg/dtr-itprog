<html>

<head>
    <title>Chat Client</title>
</head>

<style>
* {
    font-family: "Roboto", sans-serif;
}

body {
    margin: 0;
    padding: 0;
    background-color: #a2a2a2;
    display: flex;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

input,
button,
textarea {
    border: 2px solid rgba(0, 0, 0, 0.6);
    background-image: none;
    background-color: #dadad3;
    box-shadow: none;
    padding: 5px;
}

input:focus,
button:focus,
textarea:focus {
    outline: none;
}

textarea {
    min-height: 50px;
    resize: vertical;
}

button {
    cursor: pointer;
    font-weight: 500;
}

.feedback-card {
    border: 1px solid black;
    max-width: 980px;
    background-color: #fff;
    margin: 0 auto;
    box-shadow: -0.6rem 0.6rem 0 rgba(29, 30, 28, 0.26);
}

.feedback-header {
    text-align: center;
    padding: 8px;
    font-size: 14px;
    font-weight: 700;
    border-bottom: 1px solid black;
}

.feedback-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.feedback-body__message {
    margin-top: 10px;
}

.feedback-body button {
    margin-top: 10px;
    align-self: flex-end;
}
</style>

<body>
    <div class="feedback-card">
        <div class="feedback-header">
            Simple Chat Client
        </div>

        <form method="POST" class="feedback-body">
            <input type="text" class="feedback-body__email" placeholder="Client Message" name="txtMessage" />



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
            <textarea ,type="text" class="feedback-body__message"
                placeholder="Server Reply:"><?php echo @$reply; ?></textarea>
            <button type="submit" name="btnSend" class="feedback-body__submit">SEND</button>
        </form>

    </div>