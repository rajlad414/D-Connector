<?php
    session_start();
    $r_user=$r_pass=$r_c_pass=$r_c_pass_err=$r_user_err=$r_pass_err='';
    $flag=1;
if(isset($_POST['register'])){
    if($_SERVER['REQUEST_METHOD']='POST'){
            if(empty($_POST["user"])){
                $r_user_err='User name is required';
                $flag=-1;
            }else{
                $r_user=trim($_POST["user"]);
                $_SESSION['admin']=$r_user;
            }
            if(empty($_POST["pass"])){
                $r_pass_err='Password is required';
                $flag=-1;
            }else{
                $r_pass=md5(trim($_POST["pass"]));
            }
            if(empty($_POST["c_pass"])){
                $r_c_pass_err='Confirm Password is required';
                $flag=-1;
            }else{
                if($_POST["pass"]==$_POST["c_pass"]){
                    $r_c_pass=md5(trim($_POST["c_pass"]));
                }
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
    
        // //Create database:
        // $sql="create database admin";
    
        // if($con->query($sql)== true){
        //     echo 'database created';
        // }
        // else{
        //     echo 'database not created';
        // }
    
        // // Create table
        // $sql="create table admin(Name varchar(225), Password varchar(255))";
        // if($con->query($sql)== true){
        //     echo 'tabel inserted succesfully';
        // }
        // else{
        //     echo 'data inserted unsuccesfully';
        // }
        $sql= "select * from admin where Name='$r_user'";
        $result = $con->query($sql);
        
        if($result->num_rows > 0){            
            echo 'Username already exist.<br>Use another username';
        }
        else{
            $sql= "insert into admin values('$r_user','$r_pass')";
            if($con->query($sql)== true){
                $_SESSION['admin']=$r_user;

                if (isset($_POST['remember'])) {
                    setcookie("user", $r_user, time() + (86400 * 30));
                }
                header('location:login_register.php');
            }
            else{
                echo '<script>Not registered</script>';
            }  
        }
  

    }
}


?>

<!Doctype HTML>
<html>
    <body>
        <div>
            <h1>SignIn</h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <fieldset>
                    <legend>SignIn Section:</legend>
                    <label for="user">Username:</label>
                    <input type="text" name="user" value=<?php echo $r_user;?>>
                    <span style="color:red">* <?php echo $r_user_err;?></span>
                    <br><br>
                    <label for="pass">Password</label>
                    <input type="password"
                         name="pass" 
                         pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">>
                    <span style="color:red">* <?php echo $r_pass_err;?></span>
                    <br><br>
                    <label for="c_pass">Confirm Password</label>
                    <input type="password" 
                        name="c_pass" 
                        >
                    <span style="color:red">* <?php echo $r_c_pass_err;?></span>
                    <br><br>
                    <input type="checkbox" id="remember" name="remember" value="remember">
                    <label for="remeber"> Remeber me</label><br><br>
                    <input type="submit" value="Register" name="register">
                    <br><br>
                    <p align="center"><a href="login.php">Login</a></p>
                </fieldset>
            </form>
        </div>
        
        
    </body>

</html>