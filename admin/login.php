<?php include('../config/constant.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>

            <?php 
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['login']);
                }
            ?>

            <br>


            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"> <br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter password"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>

            <!-- Login Form Ends Here -->
        

            <p class="text-center">Created By - <a href="">'Ismah Haziq</a></p>
        </div>
    </body>
</html>

<?php 
    //Check whether the Submit Button is Clicked or Not
    if(isset($_POST['submit'])) {
        //Process for login
        //1. Get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);


        //2. SQL to check whether the user with username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1){
            //User available and login success
            $_SESSION['login'] = "<div class='success '>Login Successful</div>";
            $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it
            
            //Redirect to home page/dashboard
            header('location:'.SITEURL.'admin/index.php');
        }
        else {
            //user not available and login fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
            //Redirect to home page/dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>