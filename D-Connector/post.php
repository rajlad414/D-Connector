<?php
    session_start();
    $servername="localhost";
        $username="root";
        $password="";
        $database="admin";
        $f=1;
        $con= new mysqli($servername,$username,$password,$database);
        if(!$con){
          die("connection failed");
        } 
    
    if (isset($_POST['submit'])) {
        
        if (is_uploaded_file(basename($_FILES["fileToUpload"]["name"]))) {
          echo'hello';
            $currentDirectory = getcwd();
            $target_dir = $currentDirectory."/Post/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        
            if (file_exists($target_file)) {
                $err= "<br>Sorry, file already exists.<br>";
                $uploadOk = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 10000000) {
                $err="<br>Sorry, your file is too large.<br>";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpeg" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {
                $err= "<br>Sorry, jpeg, jpg, png, and gif files are only allowed.<br>";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $err= "<br>Sorry, your file was not uploaded.<br>";
            } else {
                $no=0;
                $sql="select count(Post_Id) from post";
                $result=$con->query($sql);
                if ($result->num_rows>0) {
                    $no=$result->fetch_assoc()['count(Post_Id)'];
                    $no=$no+1;
                }
                $newfilename =  $no.'.'. $imageFileType;
                if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newfilename)) {
                    $err= "<br>Sorry, there was an error uploading your file.";
                } else {
                    
                  $sql="insert INTO `post`(`User_Id`, `Post_Description`) VALUES (".$_SESSION['user_id'].",'".$_POST['description']."')";
                    if ($con->query($sql)==true) {
                        echo "inserted successfull";
                        header("location:post.php");
                    } else {
                      echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
            
        }
        else{
          $sql="insert INTO `post`(`User_Id`, `Post_Description`) VALUES (".$_SESSION['user_id'].",'".$_POST['description']."')";
        if ($con->query($sql)==true) {
            echo "inserted successfull";
            header("location:post.php");
        } else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }
      }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Posts</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--===============================================================================================-->	
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="l_vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="l_fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="l_fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="l_vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="l_vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="l_vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="l_vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="l_vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="l_css/util.css">
    <link rel="stylesheet" type="text/css" href="l_css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
        
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/brand/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">
<style>
.fa:hover {
  color: darkblue;
}
</style>
</head>
<body style="background-image: url('images/bj.jpg');
   background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;">

    
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      <header class="site-navbar light site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">

            <div class="col-3">
              <div class="site-logo">
                <a href="home.php" style="font-size:30px;"><strong>D-Connector</strong></a>
              </div>
            </div>
            <div class="col-3">
              <div class="site-logo">
                <a href="developers.php" style="font-size:30px;"><strong>Developer</strong></a>
              </div>
            </div>

            <div class="col-6  text-right">
              
              <span class="d-inline-block d-lg-none"><a href="#" class=" site-menu-toggle js-menu-toggle py-5 "><span class="icon-menu h3 text-black"></span></a></span>

              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                <?php
                if($_SESSION['user']=='admin'){
                            echo '<li><a href="admin_dashboard.php" class="nav-link"><strong> Admin Dashboard</strong></a></li>';
                          }?>
                  <li><a href="home.php" class="nav-link" style="font-size:18px;"><strong>Home</strong></a></li>
                  <li><a href="dashboard.php" class="nav-link" style="font-size:18px;"><strong>Dashboard</strong></a></li>
                  <li class="active"><a href="home.php" class="nav-link" style="font-size:18px;"><strong>Post</strong></a></li>
                  
                </ul>
              </nav>
            </div>
            <br><br>
        </div>
        
<div class="limiter">
		<div class="container-login100" 
         style="background-image: url('images/bj.jpg');background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 100% 100%;">
			<div style=" width:100%; 
                  margin:20px;background: #fff;
                  border-radius: 10px;
                  overflow: hidden;
                  position: relative;">
				<div class="login100-form-title" style="background-image: url(l_images/bg-01.jpg);" >
					<span class="login100-form-title-1">
                        <p style="font-size:50px; color:white">Posts</p>
						
					</span>
                </div>
            </div>

            

            <div style=" width:100%; 
                  margin:20px;background: #fff;
                  border-radius: 10px;
                  overflow: hidden;
                  position: relative;">
                <p style="text-align:center; font-size:30px; font-weight:1000; background-color:#5f5f5f; color:white">Say Something</p>
                <form enctype="multipart/form-data" style="padding:20px; height:50%;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <div class="wrap-input100 m-b-26">
                            <input style="width:100%;" type="textarea" name="description"  placeholder="Create A Post...">
                            <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 m-b-26">
						<span class="label-input100" style=" font-size:20px; font-weigth:1000;">Select Photo</span>
                        <input class="input100" type="file" name="fileToUpload" id="fileToUpload"  style="color:Black" >
                        <span class="focus-input100"></span>
                </div>
                    <br>
                    <div  class="container-login100-form-btn" 
                        style="align-items: right;">
                        <input type="submit" class="login100-form-btn"
                            value="Submit"
                            name='submit'>
					</div>
                </form> 
            </div>
            <?php
              $sql="SELECT * FROM `post` order by `Post_Id` DESC";
              $result=$con->query($sql);
              if($result->num_rows>0){
                while($rows=$result->fetch_assoc()){
                  $path='';
                  $target_dir ="Profile pics\\";
                  $files = glob($target_dir.$rows["User_Id"].".*", GLOB_BRACE);
                  if(empty($files)){
                  $path="Profile pics\\".'user.jpg';
                  } 
                  else{
                    $path=$files[0];
                  }
                  echo '<div style=" width:100%; 
                  margin:20px;background: #fff;
                  border-radius: 10px;
                  overflow: hidden;
                  position: relative;">
                            <div style="width:40%; color:pink; float:left;">
                                <img src="'.$path.'" alt="User Profile" ';
                                
                               echo 'style="  display: block;
                                        margin-left: auto;
                                        margin-right: auto;
                                        border-radius: 50%;
                                        width:200px;
                                        padding:20px;">
                                <p style="display: block;
                                        margin: auto;
                                        text-align:center;
                                        font-size:25px;
                                        font-weight:1000;
                                        color:black;"
                                        >';
                                        $sql1="select Name from profile where User_Id=".$rows['User_Id'];
                                            $result1=$con->query($sql1);
                                            if ($result1->num_rows>0) {
                                                while ($rowss=$result1->fetch_assoc()) {
                                                    echo $rowss['Name'];
                                                }
                                            }
                        echo '</p>
                                <br><br>
                            </div>';
                        echo '<div style="width:60%; color:pink; float:left;">
                        <p style="text-align:center;
                                    font-size:20px;
                                    font-weight:100px;
                                    color:black;
                                    margin:10px">';
                        echo $rows['Post_Description'];
                        echo '</p>
                        <br><br>';
                        echo '<div style="position: absolute;
                        top: 80%;
                        right: 5%;"><div  class="container-login100-form-btn" 
                            style="justify-content: center;">
                            <i onclick="upVotes()" 
                                class="fa fa-thumbs-up" 
                                id="up_vote"
                                style="color:black;
                                        font-size: 50px;
                                        cursor: pointer;
                                        user-select: none;
                                        justify-content: center;
                                        margin-left:5px;
                                        margin-right:10px;">';
                                        echo $rows['Post_Up_Votes'];
                                        echo '</i>
                            <i onclick="downVotes" 
                            class="fa fa-thumbs-down"
                            style="color:black;
                                        font-size: 50px;
                                        cursor: pointer;
                                        user-select: none;
                                        justify-content: center;
                                        margin-left:5px;
                                        margin-right:10px;">';
                                        echo $rows['Post_Down_Votes']; 
                                        echo'</i>
                            
                            <form  action="comment.php?post_id='.$rows["Post_Id"].'" method="Post">
                            <input type="submit" class="login100-form-btn"
                                value="Comments"
                                name="post_id"
                                id="post_id">
                            </form>
                              <br><br><br><br>
                        </div> <br><br><br></div>
                        </div>

                        </div>';
                }
              }
            ?>
	</div> 
</header>
 </div>
 <script>

 function upVotes(){
   var x= document.getElementById("up_vote").value;
   x=x+1;
   document.getElementById("up_vote").innerHTML=x;
  //  <?php
  //     $v= ;
  //     echo a;
  //     $sql="UPDATE `post` SET `Post_Up_Votes`=(SELECT `Post_Up_Votes` from `post` where `Post_Id`=".$v.")+1 WHERE `Post_Id`=".$v;
  //     $result=$con->query['$sql'];
  //     if($result->num_rows>0){
  //       $sql="select `Post_Up_Votes` from post where Post_Id=".$v;
  //       $result=$con->query['$sql'];
  //       if($result->num_rows>0){
  //         echo 'document.getElementById(\'up_vote\').innerHTML ='.$result->fetch_assoc()['Post_Up_Votes'];
  //       }
  //       else{
  //         echo "Error: " . $sql . "<br>" . $con->error;
  //       }
  //     }
  //  ?>
 }
 </script>

  </body>
</html>


