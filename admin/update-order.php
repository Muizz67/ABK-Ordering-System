<?php include('partials/menu.php'); ?>

<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected Food
        $sql = "SELECT * 
        FROM orderdetail od
        JOIN orders o ON o.order_ID = od.order_ID
        JOIN payment p ON o.order_ID = p.order_ID
        JOIN customer c ON o.cust_ID = c.cust_ID
        WHERE order_detail_ID = '$id'"; 

        //execute the Query
        $res = mysqli_query($dbconn, $sql);

        //Get the value based on query executed
        $row = mysqli_fetch_assoc($res);

        //Get the Individual Values of Selected Order
        $id = $row['order_ID'];
        $date = $row['date'];
        $customer_ID = $row['cust_ID'];
        $customer_username = $row['cust_username'];
        $customer_fullname = $row['cust_fullname'];
        $customer_email = $row['cust_email'];
        $customer_phone = $row['cust_phone'];
        $customer_address = $row['cust_address'];
        $payment_ID = $row['payment_ID'];
        $status = $row['payment_status'];
    }
    else
    {
        //Redirect to Manage Food
        header('manage-alacarte.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Date : </td>
                <td>
                    <b> <?php echo $date; ?> </b>
                </td>
            </tr>

            <tr>
                <td>Order Details : </td>
                <td>
                <a href="show-order.php?id=<?php echo $id; ?>" class="btn-primary">Show Order</a>
                </td>
            </tr>

            <tr>
                <td>Customer Username : </td>
                <td>
                    <input type="text" name="username" value="<?php echo $customer_username; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Fullname : </td>
                <td>
                    <input type="text" name="fullname" value="<?php echo $customer_fullname; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Email : </td>
                <td>
                    <input type="text" name="email" value="<?php echo $customer_email; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Phone : </td>
                <td>
                    <input type="text" name="phone" value="<?php echo $customer_phone; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Address : </td>
                <td>
                    <input type="text" name="address" value="<?php echo $customer_address; ?>">
                </td>
            </tr>

            <tr>
                <td>Status : </td>
                <td>
                    <select name="status">
                        <option> Completed </option>
                        <option> Not Completed </option>
                        <option> Cancelled </option>
                    </select>
                </td>
            </tr>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="cust_ID" value="<?php echo $customer_ID; ?>">
                    <input type="hidden" name="payment_ID" value="<?php echo $payment_ID; ?>">
                    <input type="submit" name="submit" onclick="return confirm('Are you sure want to update');" value="Update Order" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $id = $_POST['id'];
                $cust_ID = $_POST['cust_ID'];
                $cust_username = $_POST['username'];
                $cust_fullname = $_POST['fullname'];
                $cust_email = $_POST['email'];
                $cust_phone = $_POST['phone'];
                $cust_address = $_POST['address'];
                $status = $_POST['status'];
                $payment_ID = $_POST['payment_ID'];                   

                //4. Update the Order in Database
                $sql2 = "UPDATE customer SET 
                cust_username = '$cust_username',
                cust_fullname = '$cust_fullname',
                cust_email = '$cust_email',
                cust_phone = '$cust_phone',
                cust_address = '$cust_address'
                WHERE cust_ID ='$cust_ID'
                ";

                $sql3 = "UPDATE payment SET
                payment_status = '$status'
                WHERE payment_ID = '$payment_ID'
                ";

                //Execute the SQL Query
                $res2 = mysqli_query($dbconn, $sql2);
                $res3 = mysqli_query($dbconn, $sql3);

                //CHeck whether the query is executed or not 
                if($res2==false)
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:manage-order.php');
                    
                }
                else
                {
                    if($res3==false)
                    {
                        //Failed to Update Food
                        $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                        header('location:manage-order.php');
                        
                    }
                    else
                    {
                        //Query Exectued and Food Updated
                        $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                        header('location:manage-order.php');
                    }
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>