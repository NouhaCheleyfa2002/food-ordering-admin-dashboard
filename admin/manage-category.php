<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
       <h1>manage category</h1>
        <br>
       <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
            
        ?>
        <br>
                <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">add category</a>
                <br> <br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>title</th>
                        <th>image</th>
                        <th>featured</th>
                        <th>active</th>
                        <th>actions</th>
                    </tr>

                    <?php
                        //query to get all categories from db
                        $sql = "SELECT * FROM category";
                        //execute quey
                        $res = mysqli_query($conn, $sql);

                        //count rows to check if data is available
                        $count = mysqli_num_rows($res);

                        //check whether we have data in db
                        if ($count>0) {
                            //get the data and display
                            while ($row=mysqli_fetch_assoc($res)) {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td>
                                            <?php 
                                            //check whether the image name is available or not
                                            if ($image_name!="") {
                                                //display image
                                                ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px" >
                                        <?php
                                            }else{
                                                echo "no image displayed";
                                            }

                                         ?>
                                         </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-secondary">Update category</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete category</a>
                                        </td>
                                    </tr>
                                  <?php                        
                            }
                            
                        }else{
                            //we'll display message inside table
                            ?>
                            <tr>
                                <td colspan="6"><div class="error">No category added yet</div></td>
                            </tr>

                            <?php
                            
                        }
                    ?>

                   
                    
                </table>
    </div>
</div>

<?php include ('partials/footer.php')?>