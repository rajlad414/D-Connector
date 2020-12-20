<!-- <?php
    session_start();    
?>
<!Doctype HTML>
<html>
    <body>
        <?php
         $l_user=$l_pass=$l_user_err=$l_pass_err='';
         $flag=1;

         if(isset($_POST['login'])){
     
            if($_SERVER['REQUEST_METHOD']='POST'){
                    if(empty($_POST["user"])){
                        $l_user_err='User name is required';
                        $flag=-1;
                    }else{
                        $l_user=trim($_POST["user"]);
                    }
                    if(empty($_POST["pass"])){
                        $l_pass_err='Password is required';
                        $flag=-1;
                    }else{
                        $l_pass=md5(trim($_POST["pass"]));
                    }
            }

            if($flag==1){
                $servername="localhost";
                $username="root";
                $password="";
                $database="admin";
                $f=1;
                $con= new mysqli($servername,$username,$password,$database);
                if(!$con){
                    die("connection failed");
                }
                $sql= "select * from admin where Name='$l_user'";
                $result = $con->query($sql);
                
                if($result->num_rows == 1){
                    if($l_pass==$result->fetch_assoc()['Password']){
                        echo 'Welcom dear!!!';
                        if (isset($_POST['remember'])) {
                            setcookie("user", $l_user, time() + (86400 * 30));
                        }
                        $_SESSION['admin']=$l_user;
                        header('location:login_register.php');
                    }
                    else{
                        $l_pass_err='Password is incorrect'; 
                    }         
                    
                }
                else{
                    echo 'Please register yourself';
                }
            }
        }
        
     
        ?>
    
        <div>
            <h1>Login</h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <fieldset>
                    <legend>Login Section:</legend>
                    <label for="user">Username:</label>
                    <input type="text" name="user" value="<?php if (isset($_COOKIE["user"])){echo $_COOKIE["user"];}?>">
                    <span style="color:red">* <?php echo  $l_user_err;?></span>
                    <br><br>
                    <label for="pass">Password</label>
                    <input type="password" name="pass">
                    <span style="color:red">* <?php echo  $l_pass_err;?></span>
                    <br><br>
                    <input type="checkbox" id="remember" name="remember" value="remember">
                    <label for="remeber"> Remeber me</label><br><br>
                    <input type="submit" value="Login" name="login">
                    <br><br>
                    <p align="center"><a href="register.php">Register</a></p>
                </fieldset>
            </form>
        </div>
        
        
    </body>

</html> -->
