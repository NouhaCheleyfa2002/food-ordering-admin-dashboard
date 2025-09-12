<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category Page</h1>
        <br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Category Title">
                    </td>
                    
                </tr>
                <tr>
                    <td>select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                    
                </tr>
                <tr>
                    <td>featured</td>
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
                        <input type="submit" name="submit" value="add category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //check whether the form has been submitted
        if(isset($_POST['submit'])){
            //get the data from the form
            $title = $_POST['title'];

            //for radio input, we need tp check whether the button is selected or not
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }else{
                //set the default value
                $featured = "No";
            }
            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }else{
                $active = "No";
            }
            //check whether the image has been uploaded and set the value for image name
            //print_r($_FILES['image']);
            //die();//break the code here

            if($_FILES['image']['name']){
                //upload image : we need image name,source and destination path
                $image_name = $_FILES['image']['name'];

                //upload the image only if image is selected
                if($image_name!=""){ 

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
                        $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                        header("location:".SITEURL.'admin/add-category.php');
                        die();
                }
             }
            }else{
                //don't upload image and set the image name as blank
                $image_name="";
            }

            //create sql query to insert category into db
            $sql = "INSERT INTO category (title, image_name,  featured, active) VALUES ('$title','$image_name', '$featured','$active')";

            //execute the query and save data
            $res = mysqli_query($conn,$sql);

            //check whether the query executed or not and data added or not
            if($res){
                //echo "Category added successfully";
                $_SESSION['add'] = "<div class='success'>category added successfully</div>";
                header("location:".SITEURL.'admin/manage-category.php');
            }else{
                $_SESSION['add'] = "<div class='error'>failed to add category</div>";
                header("location:".SITEURL.'admin/add-category.php');
            }
        }
        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>