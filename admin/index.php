<?php include('partials/menu.php'); ?>
        <!--Main Content Section -->
        <div class="main-content">
             <div class="wrapper">
                <h1>DASHBOARD</h1>
                <?php
                    if (isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    ?> <br>
                <div class="col-4 text-center">

                    <?php
                       $sql = "SELECT * FROM category";
                       $res = mysqli_query($conn,$sql);

                       $count=mysqli_num_rows($res);
                       
                    ?>

                    <h1><?php echo $count;?></h1>
                    <br />
                    Categories
                </div>
                <div class="col-4 text-center">
                    <?php
                       $sql2 = "SELECT * FROM tbl_food";
                       $res2 = mysqli_query($conn,$sql2);

                       $count2=mysqli_num_rows($res2);
                       
                    ?>
                    <h1><?php echo $count2;?></h1>
                    <br />
                    Foods
                </div>
                <div class="col-4 text-center">
                    <?php
                       $sql3 = "SELECT * FROM `order`";
                       $res3 = mysqli_query($conn,$sql3);

                       $count3=mysqli_num_rows($res3);
                       
                    ?>
                    <h1><?php echo $count3;?></h1>
                    <br />
                    Total orders
                </div>
                <div class="col-4 text-center">
                    <?php
                        //aggregate functions in sql
                       $sql4 = "SELECT SUM(total) AS Total FROM `order` WHERE status = 'delivered'";
                       $res4 = mysqli_query($conn,$sql4);
                        //get the values
                       $row4 = mysqli_fetch_assoc($res4);
                        //get the toatl revenue
                        $total_revenue = $row4['Total'];
                       
                    ?>
                    <h1><?php echo $total_revenue;?></h1>
                    <br />
                    Revenues
                </div>
                <div class="clearfix"></div>
             </div>
        </div>

        <!--Footer Section -->
        <div class="footer">
             <div class="wrapper">
                <p class="text-center">2024 all rights reseved</p>
            </div>
        </div>
    </body>
</html>