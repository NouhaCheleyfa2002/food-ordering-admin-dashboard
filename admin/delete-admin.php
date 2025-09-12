<?php
    include('../config/constant.php');
    //1 get the id of admin to be deleted
  
    $id = $_GET['id'];
    
    //2 create sql query to delete admin
    $sql = " DELETE FROM admin WHERE id = $id ";

    //execute the query
    $res = mysqli_query($conn,$sql);
    //check whether the query is executed
    if($res==true){
        //create session variable to display message
        $_SESSION['delete'] ="<div class='success'>admin deleted successfully</div>" ;
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');  
    }else{
        $_SESSION['delete'] = "<div class='error'>failed to delete, try again</div>";
        header('location:'.SITEURL.'admin/delete-admin.php'); 
    }

    //3 redirect to manage admin page with message 
?>