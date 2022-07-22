<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            //1. Get the ID of Selected Admin
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>


        <form action="" method="POST">    
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" onclick="return confirm('Are you sure want to update');" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php 

            //Check whether the Submit Button is Clicked on Not
            if(isset($_POST['submit']))
            {
                //1. Get the Data from Form
                $id=$_POST['id'];
                $cur_password = $_POST['current_password'];
                $new_password = $_POST['new_password'];
                $con_password = $_POST['confirm_password'];


                //2. Check whether the user with current ID and Current Password Exists or Not
                $sql = "SELECT * FROM admin 
                WHERE admin_ID='$id'
                AND admin_password='$cur_password'
                ";

                //Execute the Query
                $query = mysqli_query($dbconn, $sql);

                if($query==true)
                {
                    //Check whether data is available or not
                    $count=mysqli_num_rows($query);

                    if($count==1)
                    {
                        //User Exists and Password Can be CHanged
                        //echo "User FOund";

                        //Check whether the new password and confirm match or not
                        if($new_password==$con_password)
                        {
                            //Update the Password
                            $sql2 = "UPDATE admin SET 
                            admin_password = '$new_password'
                            WHERE admin_ID='$id'
                            ";

                            //Execute the Query
                            $query2 = mysqli_query($dbconn, $sql2);

                            //CHeck whether the query exeuted or not
                            if($query2==true)
                            {
                                //Display Succes Message
                                //REdirect to Manage Admin Page with Success Message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                //Redirect the User
                                header('location:manage-admin.php');
                            }
                            else
                            {
                                //Display Error Message
                                //Redirect to Manage Admin Page with Error Message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                                //Redirect the User
                                header('location:manage-admin.php');
                            }
                        }
                        else
                        {
                            //REdirect to Manage Admin Page with Error Message
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Match. </div>";
                            //Redirect the User
                            header('location:manage-admin.php');

                        }
                    }
                    else
                    {
                        //Display Error Message
                        $_SESSION['user-not-found'] = "<div class='error'>Failed to Change Password. </div>";
                        //Redirect the User
                        header('location:manage-admin.php');
                    }
                }
                //3. Check Whether the New Password and Confirm Password Match or not

                //4. Change Password if all above is true
            }

?>


<?php include('partials/footer.php'); ?>