<?php
  include ('partials/menu.php');
?>
        <!--Main Content Section -->
        <div class="main-content">
             <div class="wrapper">
                <h1>manage admin</h1>
                <br/> 
                <a href="add-admin.php" class="btn-primary">add admin</a>
                <br/> <br/>

                <?php if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);//removing session message
                } 
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);//removing session message
                } 
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if (isset($_SESSION['user-not-found'])) {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                if (isset($_SESSION['password-not-matched'])) {
                    echo $_SESSION['password-not-matched'];
                    unset($_SESSION['password-not-matched']);
                }
                if (isset($_SESSION['change-pwd'])) {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
                 ?>
                <br/>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>full name</th>
                        <th>username</th>
                        <th>actions</th>
                    </tr>

                    <?php
                        //query to get all admin
                        $sql = "SELECT * FROM admin";
                        //execute the query 
                        $res = mysqli_query($conn, $sql);

                        //check whether the query is executed or not 
                        if($res==TRUE){
                            //count rows 
                            $count = mysqli_num_rows($res);// function to get all the rows in db

                            if($count>0){
                                while($rows=mysqli_fetch_assoc($res)){
                                    //using while to get all the data from db
                                    //get individual data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                                    //display the values in the table
                                    ?>
                                    <tr>
                                        <td><?php echo $id  ; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">change password</a>
                                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>
                                    <?php
                                
                                }
                                
                            }else{

                            }
                        }
                    ?>

                   
                </table>
            
             </div>
        </div>
<?php include ('partials/footer.php'); ?>