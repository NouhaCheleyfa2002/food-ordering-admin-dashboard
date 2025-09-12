<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/>

        <?php if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);//removing session message
                }
         ?>

        <form action="" method="post">
            <table class="tbl-30"> 
                <tr>
                    <td>full name:</td>
                    <td><input type="text" name="full_name" placeholder="enter your name"></td>
                </tr>
                <tr>
                    <td>username:</td>
                    <td><input type="text" name="username" placeholder="enter your username"></td>
                </tr>
                <tr>
                    <td>password:</td>
                    <td><input type="password" name="password" placeholder="enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                   
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>

<?php
//process the value from form and save it in db
    //check whether the submit button is clicked or not

    if (isset($_POST['submit'])){
        //button clicked 
       //get the data from form
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']);

       //sql query to save the data into db
       $sql = "INSERT INTO admin SET
       full_name='$full_name',
       username= '$username',
       password= '$password' 
       ";

        //execute query and saving data in db
       $res = mysqli_query($conn, $sql) or die("Connection failed: " . mysqli_connect_error());

        //check whether the data in inserted or not and display appropriate message
        if($res==TRUE){
            //data inserted 
            //create a session variable to display the message
            $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }else{
            $_SESSION['add'] = "<div class='error'>failed to add admin</div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>