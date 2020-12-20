
<?php
session_start();
if(isset($_SESSION['admin'])){
    echo 'session='.$_SESSION['admin'];

}
if (isset($_COOKIE["user"])){
    echo '<br>cookie='.$_COOKIE["user"];
    echo '<html>
    <body>
        <form action="logout.php">
            Logout:
            <input type="submit" value="Logout">
            <br><br>
        </form>
        <form action="register.php">
            Register:
            <input type="submit" value="Register">
            <br><br>
        </form>
    </body>
</html>';
}else{
    echo '<html>
    <body>
        <form action="login.php">
            Login:
            <input type="submit" value="Login">
            <br><br>
        </form>
        <form action="register.php">
            Register:
            <input type="submit" value="Register">
            <br><br>
        </form>
    </body>
</html>';
}
?>


