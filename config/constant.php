<?php
    // start the session 
    session_start();

    //create constant to store non repeating values
    define('SITEURL','http://localhost:3000/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food');

     $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());//db connection
     $db_select = mysqli_select_db($conn,'food') or die("Connection failed: " . mysqli_connect_error());//selecting db
?>