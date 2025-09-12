<?php
    include('../config/constant.php');

    //check whether the id and image_name is set or not
    if (isset($_GET['id']) AND isset($_GET['image_name'])) {
        //get the value and delete
        //echo "get the value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the image file 
        if ($image_name != "") {
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed add an error message and stop the process
            if ($remove==false) {
                $_SESSION['remove'] = "<div class='error'>failed to remove image</div>";

                header("location:".SITEURL.'admin/manage-category.php');
                die();
            }
        }
        //delete data from db
        $sql = "DELETE FROM category WHERE id=$id";

        $res = mysqli_query($conn,$sql);
        //check whether the data deleted or not
        if ($res==true) {
            $_SESSION['delete'] = "<div class='success'>category removed sucessfully</div>";
            header("location:".SITEURL.'admin/manage-category.php');
        } 
        else {
            $_SESSION['delete'] = "<div class='error'>failed to remove category</div>";
            header("location:".SITEURL.'admin/manage-category.php');
        }

        //redirect to manage category page

    }else{
        //redirect to manage category page
        header("location:".SITEURL.'admin/manage-category.php');
    }
?>