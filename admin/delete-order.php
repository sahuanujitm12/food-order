<?php

     //include the constants.php file here
      include('../config/constants.php'); 
     
     // 1. get the id of admin to be delete
     $id = $_GET['id'];

     // 2. create sql query to delete admin
     $sql = "DELETE FROM tbl_order WHERE ID=$id";

     //Execute the query
     $res =mysqli_query($conn, $sql);

     //check whether the query executed successfully or not
     if($res==true)
     {
          // query successfully and admin delete
          //echo "Admin Deleted";
          // create session variable to display massge
          $_SESSION['delete'] = "<div class='success'> orderd Deleted successfully.</div>";
          //redirect to manage admin page
          header("location:".SITEURL.'admin/manage-order.php');
     }
     else
     {
     // failed to display admin
           //echo "failed to delete admin";

          $_SESSION['delete'] = "<div class='error'> Falied to orderd, Try Again Later.</div>";
          header("location:".SITEURL.'admin/manage-order.php');
     }

?>
