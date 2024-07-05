<?php
  session_start();
  if(isset($_GET["log_out"]) and isset($_SESSION['logged']))
  {
     unset($_SESSION['logged']);
     unset($_SESSION['fullname']);
     
  }
  if(isset($_SESSION['logged']) and $_SESSION['logged'] == true)
  {
    header("location:users.php");
    die();
  }
  if ($_SERVER["REQUEST_METHOD"] === "POST")
  {
    include_once("includes/conn.php");
    if(isset($_POST['register']))
    {
     $fullname = $_POST['fullname'];
     $username = $_POST['username'];
     $email = $_POST['email'];
     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      try{
        $sql = "INSERT INTO `user`(`fullname`, `username`, `email`, `password`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fullname, $username, $email, $password]);
        $msg = "Inserted Successfully";
        $alertType = "alert-success";
      } catch(PDOException $e){
        $msg = $e->getMessage();
        $alertType = "alert-danger";
        
      }
    }
    elseif(isset($_POST['login']))
    {
      try{
        $sql = "SELECT `fullname`,`password` FROM `user` WHERE `username`= ? and active = ?;";
        $stmt = $conn->prepare($sql);
        $username = $_POST['login_username'];
        $active = 1;
        $stmt->execute([$username, $active]);
        if($stmt->rowcount())
        {
          $result = $stmt->fetch();
          $password = $_POST['login_password'];
          $verify = password_verify($password, $result['password']);
          if ($verify)
          {
            $_SESSION['logged'] = true;
            $_SESSION['fullname'] = $result['fullname'];
            header("location:users.php"); 
            die();
            
          }
          else{
            $msg = "Incorrect Password";
            $alertType = "alert-danger";

          }
          
        }
        else{
          $msg = "No data Found";
          $alertType = "alert-danger";
          
        }
       
      } catch(PDOException $e){
        $msg = $e->getMessage();
        $alertType = "alert-danger";
        
      }
    }
   }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Education Admin | Login/Register</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <?php 
      include_once("includes/alert.php");
    ?>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="" method="POST" >
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="login_username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="login_password" />
              </div>
              <div>
                <button class="btn btn-default submit" name="login">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i></i> Education Admin</h1>
                  <p>©2016 All Rights Reserved. Education Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="" method="POST" >
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Fullname" required="" name="fullname" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="username" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="email" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
              <div>
                <button class="btn btn-default submit" name="register" >Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i></i> Education Admin</h1>
                  <p>©2016 All Rights Reserved. Education Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
