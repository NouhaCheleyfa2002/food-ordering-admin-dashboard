<?php include('../config/constant.php');

    if (isset($_GET['id']) && isset($_GET['image_name'])) {
        // delete
            //get id and image name 
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];
        //delete image from folder
            if ($image_name!="") {
                $path = "../images/food/".$image_name;
                $remove = unlink($path);

                //check whether the image is removed or not
                if ($remove==false) {
                    $_SESSION['upload'] = "<div class='error'>failed to remove image</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                    die();
                }
            } 
            //delete from database
            $sql = "DELETE FROM tbl_food WHERE id=$id";
            $res = mysqli_query($conn,$sql);

            if ($res==true) {
                $_SESSION['delete'] = "<div class='success'>food deleted successfully</div>";
                header("location:".SITEURL.'admin/manage-food.php');
            }else{
                $_SESSION['delete'] = "<div class='error'>failed to remove food</div>";
                header("location:".SITEURL.'admin/manage-food.php');
            }
    }else{
        $_SESSION['unauthorized'] = "<div class='error'>unauthorized access</div>";
        header("location:".SITEURL.'admin/manage-food.php');
    }


?>