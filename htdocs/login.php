<!DOCTYPE html>
<html>
<head>
    <title>Title</title>
    <link rel="stylesheet" href="\css\login.css">
    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<script>
    $(function () {
        $('#header').load('header.php')
    })
</script>
</head>
<body>
<div id="header"></div>
<div id="loginform" >

    <h1>Login</h1>
    <form action="\php\login.php" method="POST">

        <input id="txtbox" type="text" placeholder="Username" name="username"></input>
        <input  id="txtbox" type="password" placeholder="Password" name="password"></input>
        <input id="subbutton" type="submit" value="Login">
        <p align="right" id="msg">Don't have an account? <a href="register.html">Register</a></p>
    </form>

</div>
</body>
</html>