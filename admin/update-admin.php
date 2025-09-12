<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update admin</h1>
    <br/>

    <?php
       //get the id of selected admin
        $id=$_GET['id'];
       //create sql query to get details
       $sql="SELECT * FROM admin WHERE id = $id";
       //execute the query
       $res=mysqli_query($conn,$sql);

       //check whether the query is executed or not 
       if ($res==true) {
          $count = mysqli_num_rows($res);
          if ($count==1) {
             $row=mysqli_fetch_assoc($res);

             $full_name=$row['full_name'];
             $username=$row['username'];
          }else{
            header('location:'.SITEURL.'admin/manage-admin.php');
          }
       }
    ?>

        <form action="" method="POST">
             <table class="tbl-30">
                <tr>
                    <td>full name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name;?>"></td>
                </tr>
                <tr>
                    <td>username:</td>
                    <td><input type="text" name="username" value="<?php echo $username;?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="update admin" class="btn-secondary">
                </td>
                </tr>
             </table>
        </form>
    </div>
</div>

<?php
    //check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        //get all the values from form to update
        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        //create sql query to update admin
        $sql = "UPDATE admin SET 
        full_name = '$full_name',
        username = '$username' WHERE id = $id
        ";
        //execute the query
        $res = mysqli_query($conn,$sql);
        //check whether it's executed successfully
        if ($res==true) {
            $_SESSION['update'] ="<div class='success'>admin updated successfully</div> ";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }else{
            $_SESSION['update'] ="<div class='error'>failed to update admin</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>