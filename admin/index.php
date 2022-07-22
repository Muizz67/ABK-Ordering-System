<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="row">
                    <div class="col-4 box text-center">

                        <?php 
                            //Sql Query 
                            $sql1 = "SELECT * FROM customer";
                            //Execute Query
                            $query1 = mysqli_query($dbconn, $sql1);
                            //Count Rows
                            $count1 = mysqli_num_rows($query1);
                        ?>

                        <h1><?php echo $count1; ?></h1>
                        <br />
                        Total Customer(s)
                    </div>

                    <div class="col-4 box text-center">

                        <?php 
                            //Sql Query 
                            $sql2 = "SELECT * FROM sets WHERE set_status = 'Active'";
                            //Execute Query
                            $query2 = mysqli_query($dbconn, $sql2);
                            //Count Rows
                            $count2 = mysqli_num_rows($query2);
                        ?>

                        <h1><?php echo $count2; ?></h1>
                        <br />
                        Active Set(s)
                    </div>
                    
                    <div class="col-4 box text-center">

                        <?php 
                            //Sql Query 
                            $sql3 = "SELECT * FROM alacarte WHERE food_status = 'Active'";
                            //Execute Query
                            $query3 = mysqli_query($dbconn, $sql3);
                            //Count Rows
                            $count3 = mysqli_num_rows($query3);
                        ?>

                        <h1><?php echo $count3; ?></h1>
                        <br />
                        Active Add-On(s)
                    </div>

                    <div class="col-4 box text-center">
                        
                        <?php 
                            //Sql Query 
                            $sql4 = "SELECT * FROM orders where date > now() - INTERVAL 7 day";
                            //Execute Query
                            $query4 = mysqli_query($dbconn, $sql4);
                            //Count Rows
                            $count4 = mysqli_num_rows($query4);
                        ?>

                        <h1><?php echo $count4; ?></h1>
                        <br />
                        Total Order This Week
                    </div>

                    <div class="col-4 box text-center">
                        
                        <?php 
                            //Sql Query 
                            $sql5 = "SELECT * FROM orders where date > now() - INTERVAL 7 day";
                            //Execute Query
                            $query5 = mysqli_query($dbconn, $sql5);
                            //Count Rows
                            $count5 = mysqli_num_rows($query5);
                        ?>

                        <h1><?php echo $count5; ?></h1>
                        <br />
                        Total Order This Month
                    </div>

                    <div class="col-4 box text-center">
                        
                        <?php 
                            //Sql Query 
                            $sql6 = "SELECT * FROM payment WHERE payment_status = 'Not Completed'";
                            //Execute Query
                            $query6 = mysqli_query($dbconn, $sql6);
                            //Count Rows
                            $count6 = mysqli_num_rows($query6);
                        ?>

                        <h1><?php echo $count6; ?></h1>
                        <br />
                        Payment Not Completed
                    </div>

                    <div class="col-4 box text-center">
                        
                    <?php 
                            //Sql Query 
                            $sql7 = "SELECT * FROM payment WHERE payment_status = 'Completed'";
                            //Execute Query
                            $query7 = mysqli_query($dbconn, $sql7);
                            //Count Rows
                            $count7 = mysqli_num_rows($query7);
                        ?>

                        <h1><?php echo $count7; ?></h1>
                        <br />
                        Payment Completed
                    </div>


                    <div class="col-4 box text-center">
                        
                    <?php 
                            //Sql Query 
                            $sql8 = "SELECT * FROM payment WHERE payment_status = 'Cancelled'";
                            //Execute Query
                            $query8 = mysqli_query($dbconn, $sql8);
                            //Count Rows
                            $count8 = mysqli_num_rows($query8);
                        ?>

                        <h1><?php echo $count8; ?></h1>
                        <br />
                        Cancelled Orders
                    </div>
                    <div class="col-4 box text-center">
                        
                        <?php 
                            //Creat SQL Query to Get Total Revenue Generated
                            //Aggregate Function in SQL
                            $sql9 = 
                            "SELECT SUM(p.total_price) AS Total
                            FROM payment p
                            JOIN orders o ON p.order_ID = o.order_ID
                            WHERE p.payment_status='Completed' AND o.date > now() - INTERVAL 7 day";

                            //Execute the Query
                            $query9 = mysqli_query($dbconn, $sql9);

                            //Get the Value
                            $count9 = mysqli_fetch_assoc($query9);
                            
                            //Get the Total Revenue
                            $total_revenue = $count9['Total'];

                        ?>
                        
                        <h1>RM <?php echo $total_revenue; ?></h1>
                        <br />
                        Revenue Generated This Week
                    </div>

                    <div class="col-4 box text-center">
                        
                        <?php 
                            //Creat SQL Query to Get Total Revenue Generated
                            //Aggregate Function in SQL
                            $sql10 = 
                            "SELECT SUM(p.total_price) AS Total
                            FROM payment p
                            JOIN orders o ON p.order_ID = o.order_ID
                            WHERE p.payment_status='Completed' AND o.date > now() - INTERVAL 30 day";

                            //Execute the Query
                            $query10 = mysqli_query($dbconn, $sql10);

                            //Get the Value
                            $count10 = mysqli_fetch_assoc($query10);
                            
                            //Get the Total Revenue
                            $total_revenue = $count10['Total'];

                        ?>
                        
                        <h1>RM <?php echo $total_revenue; ?></h1>
                        <br />
                        Revenue Generated This Month
                    </div>

                    <div class="col-4 box text-center">
                        
                        <?php 
                            //Sql Query 
                            $sql11 = "SELECT * FROM admin";
                            //Execute Query
                            $query11 = mysqli_query($dbconn, $sql11);
                            //Count Rows
                            $count11 = mysqli_num_rows($query11);
                        ?>

                        <h1><?php echo $count11; ?></h1>
                        <br />
                        System Administrator
                    </div>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>