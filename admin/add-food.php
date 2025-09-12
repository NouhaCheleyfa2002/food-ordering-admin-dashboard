<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Food Title">
                    </td>
                </tr>
                <tr>
                     <td>description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>select image:</td>
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
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $title;?></option>
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
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //check if submit button is clicked
        if (isset($_POST['submit'])) {
            //get all the values from form
          
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            }else{
                $featured = "No";
            }
            if (isset($_POST['featured'])) {
                $active = $_POST['active'];
            }else{
                $active = "No";
            }
            //upload image if selected
            if (isset($_FILES ['image']['name'])) {
               //get the details of the selected image
                $image_name = $_FILES['image']['name'];
                //upload the image if selected
                if ($image_name!="") {
                    //image is selected
                        //rename the image: get the extension of selected image
                    $ext = end (explode('.', $image_name));

                        // create new name for image
                    $image_name = "food_name_".rand(0000, 9999).'.'.$ext;
                    //upload the image
                      //get the src path and destination path

                      //source path is the current location of the image
                      $src = $_FILES['image']['tmp_name'];

                      //destination path for the image to be downloaded
                      $dst ="../images/food/".$image_name;
                      
                      $upload = move_uploaded_file($src, $dst);

                      //check whether the image uploaded or not(stop the process if it's not)
                    if($upload==false){
                        $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                        header("location:".SITEURL.'admin/add-food.php');
                        die();
                     }
                }
            }else{
                $image_name = "";
            }
            //insert the food in database
               //create a query to insert data into database
               $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'";
                
                $res2 = mysqli_query($conn,$sql2);

                if ($res2 == true) {
                    $_SESSION['add'] = "<div class='success'>food added successfully</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                }else{
                    $_SESSION['add'] = "<div class='error'>failed to add food</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                }

        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>