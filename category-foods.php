<?php include ('partials-front/menu.php');?>

<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //get the category title based on category id
        $sql = "SELECT title FROM category WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        $row = mysqli_fetch_assoc($res);
        //get the title
        $title = $row['title'];
    }else{
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2 = "SELECT * From tbl_food WHERE category_id=$id";

                $res2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($res2);
                if($count2>0){
                    while($row2 = mysqli_fetch_assoc($res2)){
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                          <div class="food-menu-box">
                    <div class="food-menu-img">
                   <?php
                               if ($image_name=="") {
                                 echo "<div class='error'>no image available</div>";
                               }else{
                                ?>
                                 <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="pizza" class="img-responsive img-curve">
                                <?php
                               } 
                             ?>
                   </div>

                  <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php echo $price;?></p>
                    <p class="food-detail">
                    <?php echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                  </div>
                  </div>
                        <?php
                    }
                }else{
                    echo "<div class='error'>No food available</div>";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include ('partials-front/footer.php');?>