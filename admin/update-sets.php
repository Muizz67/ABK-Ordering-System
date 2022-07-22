<?php include('partials/menu.php'); ?>

<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected Food
        $sql2 = "SELECT * FROM sets WHERE set_ID=$id";
        //execute the Query
        $res2 = mysqli_query($dbconn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected Food
        $title = $row2['set_name'];
        $description = $row2['set_desc'];
        $price = $row2['set_price'];
        $current_image = $row2['set_image'];
        $status = $row2['set_status'];
    }
    else
    {
        //Redirect to Manage Food
        header('manage-sets.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Set</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Name : </td>
                <td>
                    <input type="text" name="name" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Description : </td>
                <td>
                    <textarea name="desc" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price : </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php 
                        if($current_image == "")
                        {
                            //Image not Available 
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image Available
                            ?>
                            <img src="../images/set/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image : </td>
                <td>
                    <input type="file" name="image">
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
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="submit" name="submit" onclick="return confirm('Are you sure want to update');" value="Update Set" class="btn-secondary">
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
                $name = $_POST['name'];
                $description = $_POST['desc'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $status = $_POST['status'];

                //2. Upload the image if selected

                //CHeck whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload BUtton Clicked
                    $image_name = $_FILES['image']['name']; //New Image NAme

                    //CHeck whether th file is available or not
                    if($image_name!="")
                    {
                        //IMage is Available
                        //A. Uploading New Image

                        //REname the Image
                        $ext = end(explode('.', $image_name)); //Gets the extension of the image

                        $image_name = "Set-Name-".rand(0000, 9999).'.'.$ext; //THis will be renamed image

                        //Get the Source Path and DEstination PAth
                        $src = $_FILES['image']['tmp_name']; //Source Path
                        $dst = "../images/set/".$image_name; //Destination Path

                        //Upload the image
                        $upload = move_uploaded_file($src, $dst);

                        /// CHeck whether the image is uploaded or not
                        if($upload==false)
                        {
                            //Failed to Upload the image
                            //REdirect to Add Food Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:update-sets.php');
                            //Stop the process
                            die();
                        }

                    }
                    else
                    {
                        $image_name = $current_image; //Default Image when Image is Not Selected
                    }
                }
                else
                {
                    $image_name = $current_image; //Default Image when Button is not Clicked
                }

                

                //4. Update the Food in Database
                $sql3 = "UPDATE sets SET 
                    set_name = '$name',
                    set_desc = '$description',
                    set_price = $price,
                    set_image = '$image_name',
                    set_status = '$status'
                    WHERE set_ID=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($dbconn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:manage-sets.php');
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Successfully.</div>";
                    header('location:manage-sets.php');
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>