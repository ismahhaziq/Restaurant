<?php 
        //Start Session
        session_start();
        
        //Create Constant to Store Non Repeating Values
        define('SITEURL', 'http://localhost/Restaurant/');
        define('LOCALHOST', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'food-order');

        //3. Execute Query and Save Data in Database                                           
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
                                //^^
    //nanti kena kaji balik ayat ni    //here if you doing your web project, put the original database name, eg: username, password
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database
                                            //^^
                                        //database name

?>
