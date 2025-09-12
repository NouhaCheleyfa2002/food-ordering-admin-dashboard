<?php include ('partials-front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                //display all categories
                $sql = "SELECT * From category WHERE active='Yes'";
                //execute query
                $res = mysqli_query($conn,$sql); 

                $count = mysqli_num_rows($res);

                if ($count>0) {
                    while($row=mysqli_fetch_assoc($res)){
                        //get the id and title of the active category
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL;?>category-foods.php?id=<?php echo $id;?>">
                           <div class="box-3 float-container">
                             <?php
                               if ($image_name=="") {
                                 echo "<div class='error'>no image available</div>";
                               }else{
                                ?>
                                 <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="pizza" class="img-responsive img-curve">
                                <?php
                               } 
                             ?>


                              <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                        </a>

                    <?php
                    }
               }else{
                echo "<div class='error'>category not found</div>";
               }
            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include ('partials-front/footer.php');?>