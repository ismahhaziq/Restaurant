<?php 
    //include constant page
    include('../config/constant.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) { //Either use '&&' or 'AND'
        //Process to delete
        //echo "Process to delete";

        //1. Ge tID and Image Name
        $id = $_GET['id'];
        $image_name = $GET['image_name'];

        //2. Remove the image if available
        //Check whether the image is available or not and delete only if available
        if($image_name != "") {
            //it has image and need to remove from folder 
            //Get the image path
            $path = "../images/food/".$image_name;

            //Remove image file from folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false) {
                //Failed to remove image
                $_SESSION['remove'] = "<div class='error'>Failed to remove Image File</div>";
                //Redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');    
                //Stop the process
                die();
            }
        }

        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //eXECUTE THE QUERY
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed or not and set the session message respectively
        //Redirect to manage food page with session message
        if($res==true) {
            //Food deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else {
            //Failed to delete food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else {
        //Redirect to manage food page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }


?>
