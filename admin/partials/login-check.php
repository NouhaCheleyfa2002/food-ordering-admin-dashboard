<?php
   // authorization
   // Check if the user is logged in
    if (!isset($_SESSION['user'])) {//if user session is not set means user not logged in 
        //redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='success'>please login first</div>" ;
        header('location:'.SITEURL.'admin/login.php'); 
    }
?>