<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
            //1. Get the ID of Selected Admin
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM admin 
            WHERE admin_ID='$id'
            ";

            //Execute the Query
            $query=mysqli_query($dbconn, $sql);

            //Check whether the query is executed or not
            if($query==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($query);
                //Check whether we have admin data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($query);

                    $fullname = $row['admin_fullname'];
                    $username = $row['admin_username'];
                    $email = $row['admin_email'];
                    $phone = $row['admin_phone'];
                }
                else
                {
                    //Redirect to Manage Admin PAge
                    header('location:manage-admin.php');
                }
            }
        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name : </td>
                    <td>
                        <input type="text" name="fullname" value="<?php echo $fullname; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username : </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email : </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Phone : </td>
                    <td>
                        <input type="text" name="phone" value="<?php echo $phone; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status : </td>
                    <td>
                        <select name="status">
                            <option> Active </option>
                            <option> Not Active </option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" onclick="return confirm('Are you sure want to update');" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or not    
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE admin SET 
        admin_fullname = '$fullname', 
        admin_username = '$username',
        admin_email = '$email',
        admin_phone = '$phone',
        admin_status = '$status'
        WHERE admin_ID='$id'
        ";

        //Execute the Query
        $query = mysqli_query($dbconn, $sql);

        //Check whether the query executed successfully or not
        if($query==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:manage-admin.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            //Redirect to Manage Admin Page
            header('location:manage-admin.php');
        }
    }
    

?>


<?php include('partials/footer.php'); ?>