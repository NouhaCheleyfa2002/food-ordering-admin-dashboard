<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update category</h1>
        <br>

    <?php
        //check whether the id is set or not
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //create sql query to get all the other details
            $sql = "SELECT * FROM category WHERE id=$id";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //check whether the query is executed or not
            //count rows
            $count = mysqli_num_rows($res);
            if ($count==1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }else{
                $_SESSION['no-category-found'] = "<div class='error'>category not found</div>";
                header("location:".SITEURL.'admin/manage-category.php');
            }
        }else{
            header("location:".SITEURL.'admin/manage-category.php');
        }
    ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>current image:</td>
                    <td>
                        <?php 
                            if ($current_image!="") {
                                //display the image
                                ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="100px" >
                                        <?php
                            }else{
                                echo "<div class='error'>image not added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>featured:</td>
                    <td>
                        <input <?php if($featured=="yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if (isset($_POST['submit'])) {
                //get all the values from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //update new image if selected
                 //check whether the image is selected or not
                if (isset($_FILES['image']['name'])) {
                    //get the image details
                    $image_name = $_FILES['image']['name'];
                    //check whether the image is available or not
                    if ($image_name!="") {
                        //upload the new image
                        //auto rename
                    //get the extension of the image(.jpg,.png...)
                    $ext = end (explode('.', $image_name));
                    //rename the image 
                    $image_name = "food_category_".rand(000, 999).'.'.$ext;  

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    //finaly upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image uploaded or not(stop the process if it's not)
                    if($upload==false){
                        $_SESSION['upload'] = "<div class='error'>failed to load image</div>";
                        header("location:".SITEURL.'admin/manage-category.php');
                        die();
                     }

                    //remove the current image
                    if ($current_image!="") {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);

                    //check whether the image is removed or not
                    //if failed to remove then stop the process
                    if ($remove==false) {
                        $_SESSION['failed-remove'] = "<div class='error'>failed to remove image</div>";
                        header("location:".SITEURL.'admin/manage-category.php');
                        die();
                    }
                   }
        
                    }else{
                        $image_name = $current_image;
                    }
                }else{
                    $image_name = $current_image;
                }
                
                //update db
                $sql2 = "UPDATE category SET 
                   title = '$title',
                   image_name = '$image_name',
                   featured = '$featured',
                   active = '$active' WHERE id = $id";

                //execute the query
                $res2 = mysqli_query($conn,$sql2);
                //check whether executed
                if ($res2==true) {
                    $_SESSION['update'] = "<div class='success'>category updated successfully</div>";
                    header("location:".SITEURL.'admin/manage-category.php');
                }else{
                    //category not updated
                    $_SESSION['update'] = "<div class='error'>failed to update category</div>";
                    header("location:".SITEURL.'admin/manage-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

