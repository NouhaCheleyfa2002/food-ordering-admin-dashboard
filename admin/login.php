<?php include('../config/constant.php');?>

<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        
     <div class="login">
        <h1 class="text-center">Login</h1>
        <br>

        <?php
          if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <form action="login.php" method="post" class="text-center">
            username: <br>
            <input type="text" name="username" placeholder="Enter your username" required><br><br>
            password: <br>
            <input type="password" name="password" placeholder="Enter your password" required><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>
     </div>

    </body>
</html>

<?php
  // Check if the form has been submitted.
  if (isset($_POST['submit'])) {
    // Get the username and password from the form.
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //sql to check whether the username and password exist
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    //execute the query
    $res = mysqli_query($conn,$sql);

    //count rows to check the existence of user
    $count = mysqli_num_rows($res);

    if($count==1){
        $_SESSION['login'] = "<div class='success'>logged in successfully</div>" ;
        //for the logout functionality(to check if user logged in or not)
        $_SESSION['user'] = $username;
        //redirect to home
        header('location:'.SITEURL.'admin/');  
    }else{
        //echo "Invalid username or password";
        $_SESSION['login'] = "<div class='error text-center'>login failed</div>" ;
        //redirect to home
        header('location:'.SITEURL.'admin/login.php'); 
    }
  }
?>