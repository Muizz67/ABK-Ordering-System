<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Sets</h1>

        <br /><br />

                <!-- Button to Add Food -->
                <a href="add-sets.php" class="btn-primary">Add Sets</a>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Create a SQL Query to Get all the Food
                        $sql = "SELECT * FROM sets";

                        //Execute the qUery
                        $query = mysqli_query($dbconn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($query);

                        if($count>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($query))
                            {
                                //get the values from individual columns
                                $id = $row['set_ID'];
                                $title = $row['set_name'];
                                $price = $row['set_price'];
                                $image_name = $row['set_image'];
                                $status = $row['set_status'];
                                ?>

                                <tr>
                                    <td><?php echo $id; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td>RM <?php echo $price; ?></td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($image_name=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //We Have Image, Display Image
                                                ?>
                                                <img src="../images/set/<?php echo $image_name; ?>" width="150px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($status=="Active")
                                            {
                                                echo "<label style='color: green;'><b>$status</b></label>";
                                            }
                                            elseif($status=="Not Active")
                                            {
                                                echo "<label style='color: red;'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="update-sets.php?id=<?php echo $id; ?>"><img src = "../images/icons/pencil-square.svg"></img></a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Set not Added Yet. </td> </tr>";
                        }

                    ?>

                    
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>