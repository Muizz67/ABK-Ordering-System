<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <?php 
            //1. Get the ID of Selected Order
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>
        <h1>Order Number <?php echo $id?></h1>
        <br /><br />

        <a href="manage-order.php" class="btn-primary">Back</a>

        <br><br><br>
        <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>

                    <?php
                        
                        //Create a SQL Query to Get all the Sets
                        $sql1 = "SELECT *, (set_quantity * set_price) AS set_total FROM orderdetail od
                        JOIN sets s ON s.set_ID = od.set_ID
                        WHERE od.order_detail_ID = '$id'";

                        //Execute the qUery
                        $query1 = mysqli_query($dbconn, $sql1);

                        //Count Rows to check whether we have foods or not
                        $count1 = mysqli_num_rows($query1);

                        if($count1>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($query1))
                            {
                                //get the values from individual columns
                                $set_id = $row['set_ID'];
                                $set_name = $row['set_name'];
                                $set_price = $row['set_price'];
                                $set_image = $row['set_image'];
                                $set_quantity = $row['set_quantity'];
                                $set_total = $row['set_total'];
                                ?>

                                <tr>
                                    <td><?php echo $set_id; ?>. </td>
                                    <td><?php echo $set_name; ?></td>
                                    <td>RM <?php echo $set_price; ?></td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($set_image=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //We Have Image, Display Image
                                                ?>
                                                <img src="../images/set/<?php echo $set_image; ?>" width="150px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $set_quantity; ?></td>
                                    <td>RM <?php echo $set_total; ?></td>
                                </tr>

                                <?php
                            }
                        }

                        //Create a SQL Query to Get all the Food
                        $sql2 = "SELECT *, (food_quantity * food_price) AS food_total FROM orderdetail od
                        JOIN alacarte a ON a.food_ID = od.food_ID
                        WHERE od.order_detail_ID = '$id'";

                        //Execute the qUery
                        $query2= mysqli_query($dbconn, $sql2);

                        //Count Rows to check whether we have foods or not
                        $count2 = mysqli_num_rows($query2);

                        if($count2>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($query2))
                            {
                                //get the values from individual columns
                                $food_id = $row['food_ID'];
                                $food_name = $row['food_name'];
                                $food_price = $row['food_price'];
                                $food_image = $row['food_image'];
                                $food_quantity = $row['food_quantity'];
                                $food_total = $row['food_total'];
                                ?>

                                <tr>
                                    <td><?php echo $food_id; ?>. </td>
                                    <td><?php echo $food_name; ?></td>
                                    <td>RM <?php echo $food_price; ?></td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($food_image=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //We Have Image, Display Image
                                                ?>
                                                <img src="../images/food/<?php echo $food_image; ?>" width="150px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $food_quantity; ?></td>
                                    <td>RM <?php echo $food_total; ?></td>
                                </tr>
                                <?php
                            }
                        }

                        if($count1>0 && $count2>0)
                        {
                            $total = $food_total + $set_total;
                        }
                        else if($count2>0)
                        {
                            $total = $food_total;
                        }
                        else
                        {
                            $total = $set_total;
                        }
                        

                    ?>
                    <tr>
                        <td><h3>Total<h3></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>RM <?php echo number_format($total,2); ?></td>
                    </tr>

                    
                </table>

    </div> 
</div>

<?php include('partials/footer.php'); ?>