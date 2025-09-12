<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>
        <br>

    <?php
        //check whether the id is set or not
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //create sql query to get all the other details
            $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //check whether the query is executed or not
            //count rows
            
                $row2 = mysqli_fetch_assoc($res2);

                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
           
        }else{
            header("location:".SITEURL.'admin/manage-food.php');
        }
    ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>description:</td>
                    <td>
                         <textarea name="description" cols="30" rows="5" placeholder="description of the food"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>current image:</td>
                    <td>
                        <?php 
                            if ($current_image == "") {
                                
                                echo "<div class='error'>image not added</div>";
                               
                            }else{
                                
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="100px" >
                                <?php
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
                    <td>category:</td>
                    <td>
                        <select name="category">
                        <?php
                            //display categories from db 
                            //1.create aql to get all active categories from db
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            //execute query
                            $res = mysqli_query($conn,$sql);

                            $count = mysqli_num_rows($res);
                            if ($count>0) {
                                while ($row=mysqli_fetch_assoc($res)) {
                                    //get details of category
                                    $category_id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option <?php if ($current_category==$category_id) {
                                        echo "selected";
                                    }?> value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php
                                }
                            }else{
                                ?>
                                <option value="0">no category found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
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
                        <input type="submit" name="submit" value="update food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if (isset($_POST['submit'])) {
                //get all the values from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
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

                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/food/".$image_name;

                    //finaly upload the image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    //check whether the image uploaded or not(stop the process if it's not)
                    if($upload==false){
                        $_SESSION['upload'] = "<div class='error'>failed to load new image</div>";
                        header("location:".SITEURL.'admin/manage-food.php');
                        die();
                     }

                    //remove the current image
                    if ($current_image!="") {
                        $remove_path = "../images/food/".$current_image;
                        $remove = unlink($remove_path);

                    //check whether the image is removed or not
                    //if failed to remove then stop the process
                        if ($remove==false) {
                            $_SESSION['failed-rmv'] = "<div class='error'>failed to remove image</div>";
                            header("location:".SITEURL.'admin/manage-food.php');
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
                $sql3 = "UPDATE tbl_food SET 
                   title = '$title',
                   description = '$description',
                   price = $price,
                   image_name = '$image_name',
                   category_id = '$category',
                   featured = '$featured',
                   active = '$active' WHERE id = $id";

                //execute the query
                $res3 = mysqli_query($conn,$sql3);
                //check whether executed
                if ($res3==true) {
                    $_SESSION['update'] = "<div class='success'>food updated successfully</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                }else{
                    //category not updated
                    $_SESSION['update'] = "<div class='error'>failed to update food</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

