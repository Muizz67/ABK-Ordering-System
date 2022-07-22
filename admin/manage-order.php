<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Order Details</th>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT * 
                        FROM orderdetail od
                        JOIN orders o ON o.order_ID = od.order_ID
                        JOIN payment p ON o.order_ID = p.order_ID
                        JOIN customer c ON o.cust_ID = c.cust_ID"; 

                        //Execute Query
                        $query = mysqli_query($dbconn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($query);

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($query))
                            {
                                //Get all the order details
                                $id = $row['order_ID'];
                                $date = $row['date'];
                                $customer_name = $row['cust_username'];
                                $customer_contact = $row['cust_phone'];
                                $status = $row['payment_status'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo $id; ?> </td>
                                        <td><?php echo $date; ?></td>
                                        <td><a href="show-order.php?id=<?php echo $id; ?>" class="btn-primary">Show Order</a></td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($status=="Not Completed")
                                                {   
                                                    echo "<label style='color: blue;'>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Completed")
                                                {
                                                    echo "<label style='color: green;'><b>$status</b></label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="update-order.php?id=<?php echo $id; ?>"><img src = "../images/icons/pencil-square.svg"></img></a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>