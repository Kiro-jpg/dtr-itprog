<html>

<head>
    <title>Log-In</title>
</head>

<body>
    <center>

        <h3>Welcome to Employee's Log-In Panel</h3>
        <table border="2" bgcolor="#dddddd">
            <tr>
                <form name="frm" method="post" action="check.php">
                    <td>Username:</td>
                    <td><input type="text" name="username" /></td>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="pass" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Login" name="loginBtn" /></td>
            </tr>
            </form>
        </table>
        <?php
if (isset($_GET["error"])) {
    $error = $_GET["error"];

    //this line will be called by the check.php if the login credentials are incorrect
    if ($error == 1) {
        echo "<p align='center'>Username and/or password invalid<br/></p>";}
}

?>
</body>

</html>