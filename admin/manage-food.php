<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
       <h1>manage food</h1> 
       <br/> 
                <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">add food</a>
                <br/> <br/> 

                <?php
                     if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorized'])){
                        echo $_SESSION['unauthorized'];
                        unset($_SESSION['unauthorized']);
                    }
                    if(isset($_SESSION['failed-rmv'])){
                        echo $_SESSION['failed-rmv'];
                        unset($_SESSION['failed-rmv']);
                    }
                 
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>title</th>
                        <th>price</th>
                        <th>image</th>
                        <th>featured</th>
                        <th>active</th>
                        <th>actions</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM tbl_food ";
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if ($count>0) {
                       //get the food from db and display
                       while ($row=mysqli_fetch_assoc($res)) {
                          //get the values from indivual columns
                          $id = $row['id'];
                          $title = $row['title'];
                          $price = $row['price'];
                          $image_name = $row['image_name'];
                          $featured = $row['featured'];
                          $active = $row['active']; 
                          ?>
                                <tr>
                                <td><?php echo $id;?></td>
                                <td><?php echo $title;?></td>
                                <td>$<?php echo $price;?></td>
                                <td><?php 
                                    if ($image_name=="") {
                                        echo "<div class='error'>image not added</div>";
                                    }else{
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px" >
                                        <?php
                                    }
                                ?></td>
                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>

                                </td>
                                </tr>
                          <?php
                       }
                    }else{
                         echo "<tr><td colspan='7' class='error'>food not added yet.</td></tr>";
                    }
                    ?>

                   
                </table>
    </div>
</div>

<?php include ('partials/footer.php')?>