<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<style>
@media screen and (max-width: 580px) {
    body {
        font-size: 16px;
        line-height: 22px;
    }
}

.wrapper {
    margin: 0 auto;
    padding: 40px;
    max-width: 800px;
}

.table {
    margin: 0 0 40px 0;
    width: 100%;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    display: table;
}

@media screen and (max-width: 580px) {
    .table {
        display: block;
    }
}

.row {
    display: table-row;
    background: #f6f6f6;
}

.row:nth-of-type(odd) {
    background: #e9e9e9;
}

.row.header {
    font-weight: 900;
    color: black;
    background: #ea6153;
}

.row.green {
    background: #27ae60;
}

.row.blue {
    background: #dadad3;
}

.dasheditbtn {
    background-color: black;
    color: black;
    border-radius: 5px;
    width: 3rem;
    height: 2.5rem;
}

.dasheditbtn:hover {
    transform: translateY(-3px);
    box-shadow: 0 2px 6px -1px rgba(0, 0, 0, 0);
}

@media screen and (max-width: 580px) {
    .row {
        padding: 14px 0 7px;
        display: block;
    }

    .row.header {
        padding: 0;
        height: 6px;
    }

    .row.header .cell {
        display: none;
    }

    .row .cell {
        margin-bottom: 10px;
    }

    .row .cell:before {
        margin-bottom: 3px;
        content: attr(data-title);
        min-width: 98px;
        font-size: 10px;
        line-height: 10px;
        font-weight: bold;
        text-transform: uppercase;
        color: #969696;
        display: block;
    }
}

.cell {
    padding: 6px 12px;
    display: table-cell;
}

@media screen and (max-width: 580px) {
    .cell {
        padding: 2px 16px;
        display: block;
    }
}

nav.primary-navigation {
    margin: 0 auto;
    display: block;
    padding: 120px 0 0 0;
    text-align: center;
    font-size: 16px;
}

nav.primary-navigation ul li.nav123 {
    list-style: none;
    margin: 0 auto;
    border-left: 2px solid #dadad3;
    display: inline-block;
    padding: 0 30px;
    position: relative;
    text-decoration: none;
    text-align: center;
    font-family: arvo;
}

nav.primary-navigation ul li.homenav {
    list-style: none;
    margin: 0 auto;
    display: inline-block;
    padding: 0 30px;
    position: relative;
    text-decoration: none;
    text-align: center;
    font-family: arvo;
}

nav.primary-navigation li a {
    color: black;
}

nav.primary-navigation li a:hover {
    color: #BDBDBD;
}

nav.primary-navigation li:hover {
    cursor: pointer;
}

nav.primary-navigation ul li ul {
    visibility: hidden;
    opacity: 0;
    position: absolute;
    padding-left: 0;
    left: 0;
    display: none;
    background: white;
}

nav.primary-navigation ul li:hover>ul,
nav.primary-navigation ul li ul:hover {
    visibility: visible;
    opacity: 1;
    display: block;
    min-width: 250px;
    text-align: left;
    padding-top: 20px;
    box-shadow: 0px 3px 5px -1px #ccc;
}

nav.primary-navigation ul li ul li {
    clear: both;
    width: 100%;
    text-align: left;
    margin-bottom: 20px;
    border-style: none;
}

nav.primary-navigation ul li ul li.nav123n a:hover {
    padding-left: 10px;
    border-left: 2px solid #3ca0e7;
    transition: all 0.3s ease;
}

a {
    text-decoration: none;
}

a:hover {
    color: #3CA0E7;
}

ul li ul li a {
    transition: all 0.5s ease;
}
</style>

<body>



    <nav role="navigation" class="primary-navigation">
        <ul>
            <li class="homenav"><a href="#">Home</a></li>
            <li class="nav123"><a href="#">DTR</a></li>
            <li class="nav123"><a href="#">Dashboard</a></li>
            <li class="nav123"><a href="#">Edit Profile</a></li>
        </ul>
    </nav>
    <div class="wrapper">
        <div class="table">
            <div class="row header blue">
                <div class="cell">Username </div>
                <div class="cell">Email </div>
                <div class="cell">Password </div>
                <div class="cell">Active </div>
                <div class="cell"></div>
            </div>
            <div class="row">
                <div class="cell" data-title="Username">ninjalug </div>
                <div class="cell" data-title="Email">misterninja@hotmail.com </div>
                <div class="cell" data-title="Password">************ </div>
                <div class="cell" data-title="Active">Yes </div>
                <div class="cell" data-title="Active"><button class="dasheditbtn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Edit</button> </div>
            </div>
            <div class="row">
                <div class="cell" data-title="Username">jsmith41 </div>
                <div class="cell" data-title="Email">joseph.smith@gmail.com </div>
                <div class="cell" data-title="Password">************ </div>
                <div class="cell" data-title="Active">No </div>
                <div class="cell" data-title="Active"><button class="dasheditbtn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Edit</button> </div>
            </div>
            <div class="row">
                <div class="cell" data-title="Username">1337hax0r15 </div>
                <div class="cell" data-title="Email">hackerdude1000@aol.com </div>
                <div class="cell" data-title="Password">************ </div>
                <div class="cell" data-title="Active">Yes </div>
                <div class="cell" data-title="Active"><button class="dasheditbtn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Edit</button> </div>
            </div>
            <div class="row">
                <div class="cell" data-title="Username">hairyharry19 </div>
                <div class="cell" data-title="Email">harryharry@gmail.com </div>
                <div class="cell" data-title="Password">************ </div>
                <div class="cell" data-title="Active">Yes </div>
                <div class="cell" data-title="Active"><button class="dasheditbtn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Edit</button> </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <label for="user">Username:</label>
                        <input placeholder="Username" type="text" name="user" autocomplete="off"><br>
                        <label for="pass">Password:</label>
                        <input placeholder="Password" type="text" name="pass" autocomplete="off"><br>
                        <label for="stat">Status:</label>
                        <input placeholder="Status" type="text" name="stat" autocomplete="off"><br>
                        <label for="gen">Gender:</label>
                        <input placeholder="Gender" type="text" name="gen" autocomplete="off"><br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>