<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
         <h1>MANAGE FOOD</h1>
         <br>

                <?php
                    if(isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['remove'])) {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['delete'])) {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                                        
                    if(isset($_SESSION['upload'])) {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize'])) {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }
                ?>
                
                <br><br>
                <!-- Button to Add Food -->
                <a href="add-food.php" class="btn-primary">Add Food</a>
                <br/><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price(RM)</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                        //Query to get all Admin
                        $sql = "SELECT * FROM tbl_food";
                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Check whether the Query is Executed or Not
                        if($res==TRUE) {
                            //Count Rows to check whether we have data in ther database
                            $count = mysqli_num_rows($res); //Function to get all the rows in database
                            
                            $sn=1; //Create a variable and Assign the value

                            //Check the num of rows
                            if($count>0) {
                                //We have data in database
                                while($rows=mysqli_fetch_assoc($res)) {
                                    //using while loop to get all the data from database
                                    //adn While loop will run as long as we have data in database

                                    //Get individual data 
                                    $id=$rows['id'];
                                    $title=$rows['title'];
                                    $description=$rows['description'];
                                    $price=$rows['price'];
                                    $image_name=$rows['image_name'];
                                    $category_id=$rows['category_id'];
                                    $featured=$rows['featured'];
                                    $active=$rows['active'];

                                    //Display the values in out table
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++ ?></td>
                                        <td><?php echo $title ?></td>
                                        <td><?php echo $description ?></td>
                                        <td><?php echo "RM".$price ?></td>
                                        <td>
                                            <?php 
                                                //Check whether image name is available or not
                                                if($image_name!="") {
                                                    //Display the image
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                                    <?php
                                                }
                                                else {
                                                    //Display the message
                                                    echo "<div class='error'>Image not added</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured ?></td>
                                        <td><?php echo $active ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name?>" class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else {
                                //We do not have data in database
                                ?>
                                
                                <tr>
                                    <td colspan="6"><div class="error">No Food Added</div></td>
                                </tr> 
                                <?php
                            }
                        }
                    ?>

                </table>
            </div>
        </div>
        <!-- Main Content Section Ends -->
<?php include('partials/footer.php'); 