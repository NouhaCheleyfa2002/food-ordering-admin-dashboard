<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
       <h1>update order</h1>
       <br><br>
 
    <?php
    //check whether the id is set or not
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        //create sql query to get all the other details
        $sql = "SELECT * FROM `order` WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //check whether the query is executed or not
        //count rows
        
        $count = mysqli_num_rows($res);
           if ($count==1) {
            $row = mysqli_fetch_assoc($res);

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

         }else{
            header("location:".SITEURL.'admin/manage-order.php');
         }
    }else{
        header("location:".SITEURL.'admin/manage-order.php');
    }
?>

       <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>food name:</td>
                    <td><?php echo $food;?></td>
                </tr>
                <tr>
                    <td>price:</td>
                    <td>$<?php echo $price;?></td>
                </tr>
                <tr>
                    <td>qty:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty;?>">
                    </td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>
                        <select name="status">
                            <option value="ordered">ordered</option>
                            <option value="on delivery">on Delivery</option>
                            <option value="delivered">delivered</option>
                            <option value="cancelled">cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>
                </tr>
                <tr>
                    <td>customer contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>
                <tr>
                    <td>customer email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                    </td>
                </tr>
                <tr>
                    <td>customer address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="update order" class="btn-secondary">
                    </td>
                </tr>
            </table>
       </form>
       <?php
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $order_date = date("Y-m-d h:i:sa");
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact= $_POST['customer_contact'];
                $customer_email= $_POST['customer_email'];
                $customer_address= $_POST['customer_address'];

                //update the values
                    $sql2 = "UPDATE `order` SET
                    food = '$food',
                    price = '$price',
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address' WHERE id=$id
              ";
                    $res2 = mysqli_query($conn,$sql2);


                    if($res2==true){
                        $_SESSION['update'] = "<div class='success'>order updated successfully</div>" ;
                        
                        header('location:'.SITEURL.'admin/manage-order.php');  
                    }else{
                       
                        $_SESSION['update'] = "<div class='error'>order update failed</div>" ;
                        
                        header('location:'.SITEURL.'admin/manage-order.php'); 
                    }
            }
        ?>

    </div>
/</div>

<?php include('partials/footer.php'); ?>