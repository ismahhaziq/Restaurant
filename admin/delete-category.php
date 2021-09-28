<?php 
    //Include constant.php file here
    include('../config/constant.php');

   //Check whether the id and image_name value is set or not
   if(isset($_GET['id']) AND isset($_GET['image_name'])) {
       //Get the value and Delete
       //echo "Get Value and Delete";                         
       $id = $_GET['id'];
       $image_name = $_GET['image_name'];

        //Remove the physical image file is available
        if($image_name != "") {
            //Image is available. SO remove it
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //If failed to remove image then add an error message
            if($remove==false) {
                //Set the session message
                $_SESSION['remove'] = "<div class='error>Failed to remove the image</div>";
                //Redirect to Manage Category
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the process
                die();

            }
        }

        //Delete data from database
        //SQL Query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from database or not
        if($res==true) {
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else {
            //Set the failed message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }    
   else {
       //redirect to Manage Category Page
       header('location:'.SITEURL.'admin/manage-category.php');
   }




?>