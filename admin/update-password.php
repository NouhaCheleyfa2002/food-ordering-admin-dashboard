<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>change password</h1>
        <br/>

        <?php
         if(isset($_GET['id'])){
            $id=$_GET['id'];
         } 
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>current password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="current_password">
                    </td>
                </tr>
                <tr>
                    <td>new password</td>
                    <td>
                    <input type="password" name="new_password" placeholder="new_password">
                    </td>
                </tr>
                <tr>
                    <td>confirm password</td>
                    <td>
                    <input type="password" name="confirm_password" placeholder="confirm_password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="change password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        //get the data from the form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        //check whether the user with the current id and passwords exists
        $sql = "SELECT * FROM admin WHERE id='$id' AND password='$current_password'";
        //execute the query
        $res = mysqli_query($conn,$sql);
        if ($res==true) {
            $count=mysqli_num_rows($res);
            if ($count==1) {
                if ($new_password==$confirm_password) {
                    //update password
                    $sql2 = "UPDATE admin SET password='$new_password' WHERE id='$id'";
                    //execute
                    $res2 = mysqli_query($conn,$sql2);
                    if ($res2==true) {
                        $_SESSION['change-pwd']= "<div class='error'>password changed</div>";
                       header('location:'.SITEURL.'admin/manage-admin.php'); 
                    }else{
                         $_SESSION['change-pwd']= "<div class='error'>failed to change password  </div>";
                         header('location:'.SITEURL.'admin/manage-admin.php'); 
                    }

                }else{
                    //redirect to manage admin
                    $_SESSION['password-not-matched']= "<div class='error'>password not matched</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php'); 
                }
            }else {
                $_SESSION['user-not-found'] = "<div class='error'>user not found</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    }
?>

<?php include('partials/footer.php'); ?>