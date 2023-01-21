<?php


     //start session
     session_start();
     
     //Create constant to store Non repeating value
     define('SITEURL','http://localhost/Food_order/');


     define('LOCALHOST','localhost');
     define('DB_USERNAME','root');
     define('DB_PASSWORD','');
     define('DB_NAME','food_order');

    

     $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());//database connection

    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());//selecting database

?>