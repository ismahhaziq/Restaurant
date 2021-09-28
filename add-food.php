<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                $unset($_SESSION['upload']);
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                        <?php 
                            //Create PHP Code to display categories from database
                            //1. Create SQL to get all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //Executing summary
                            $res = mysqli_query($conn, $sql);

                            //Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            //If count is greater than zero, we have categories else we dont have categories
                            if($count>0) {   
                                //We have categories 
                                while($row=mysqli_fetch_assoc($res)) {
                                    //get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];

                                    ?>          
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            }
                            else {
                                //We do not have category
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            
                            //2. Display on dropdown
                        ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            //Check whether the button is clicked or not
            if(isset($_POST['submit'])) {
                //Add the food in database
                //echo "Clicked";

                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radio button for feature and active are checked or not
                if(isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                }
                else {
                    $featured = "No"; //Setting the default value
                }

                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                }
                else {
                    $active = "No"; //Setting the default value
                }

                //2. Upload the image if selected
                //Check whether the selected image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name'])) {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is selected or not and upload image if only selected
                    if($image_name != "") { 
                        //Image is selected
                        //A. Rename the image
                        //Get the extension of selected image(.jpg, .png, .gif, etc)
                        $ext = end(explode('.', $image_name));

                        //Create new name for image
                        $image_name = "Food-Name-".rand(0000,9999).'.'.$ext; //New image name may be "Food-Name-456."
                        
                        //B. Upload the image
                        //Get the src path and destination path

                        //Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finally Upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //Check whether image uploaded or not
                        if($upload==false) {
                            //Failed to upload the image
                            //Redirect to ad food page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //Stop the process
                            die();
                        } 
                    }
                }    
                else {
                    $image_name = ""; //setting default value
                }
                //3. Insert into database

                //Create a SQL Query to save or add food
                //For numerical, we do not need to pass value inside quotes ''. But for string value, it's compulsory to add quotes
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category, /*this is numerical value, so don't have single quote */
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether data inserted or not
                if($res2==true) {
                    //Data inserted successfully
                    $_SESSION['add']  = "<div class='success'>Food Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else {
                    //Failed to insert data
                    $_SESSION['add']  = "<div class='error'>Failed to Add Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                
                //4. Redirect with message to manage food page
            }
        
        
        ?>  

    </div>
</div>





<?php include('partials/footer.php'); ?>