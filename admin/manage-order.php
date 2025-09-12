<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
       <h1>manage order</h1>
       <br><br>
       <?php
         if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
       ?>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>food</th>
                        <th>price</th>
                        <th>qty.</th>
                        <th>total</th>
                        <th>order date</th>
                        <th>status</th>
                        <th>customer name</th>
                        <th>contact</th>
                        <th>email</th>
                        <th>address</th>
                        <th>actions</th>
                    </tr>

                    <?php
                        //get all the order from db
                        $sql = "SELECT * FROM `order` ORDER BY id DESC";
                        //execute query
                        $res = mysqli_query($conn,$sql);

                        $count = mysqli_num_rows($res);
                        if ($count>0) {
                             while ($row=mysqli_fetch_assoc($res)){
                                $id=$row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact= $row['customer_contact'];
                                $customer_email= $row['customer_email'];
                                $customer_address= $row['customer_address'];

                              ?>
                                <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $food;?></td>
                                    <td><?php echo $price;?></td>
                                    <td><?php echo $qty;?></td>
                                    <td><?php echo $total;?></td>
                                    <td><?php echo $order_date;?></td>
                                    <td>
                                        <?php
                                        if($status == "ordered"){
                                         echo "<label>$status</label>";
                                        }elseif($status == "on Delivery"){
                                            echo "<label style='color: orange;'>$status</label>";
                                        }elseif($status == "Delivered"){
                                            echo "<label style='color: green;'>$status</label>";
                                        }
                                        elseif($status == "cancelled"){
                                            echo "<label style='color: red;'>$status</label>";
                                        }

                                        ?>
                                    </td>
                                    <td><?php echo $customer_name;?></td>
                                    <td><?php echo $customer_contact;?></td>
                                    <td><?php echo $customer_email;?></td>
                                    <td><?php echo $customer_address;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update order</a>
                                        
                                    </td>
                                </tr>
                               <?php
                            }
                        }else{
                            echo "<tr><td colspan='12'>orders not available</td></tr>";
                        }
                    ?>


                </table>
    </div>
</div>

<?php include ('partials/footer.php')?>