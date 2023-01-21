<?php include("partials/menu.php"); ?>

<div class="main-content">
      <div class="wrapper">
            <h1>Add Admin</h1>

        <br><br><br>
  
             <?php
                 if(isset($_SESSION['add'])) //checking whether the SEssion is set of not 
                 {
                    echo $_SESSION['add']; //Display the SEsstion message the SET
                    unset($_SESSION['add']); //Remove session message
                 }
             ?>
         
            <form action=""method="post">
                  <table class="tbl-30">
                        <tr>
                              <td> full_Name</td>
                              <td>
                                    <input type="text" name="full_name"placeholder="Enter Your Name">
                              </td>
                        </tr>

                        <tr>
                              <td>username</td>
                              <td>
                                    <input type="text" name="username"placeholder="Enter  username">
                              </td>
                        </tr>

                        <tr>
                              <td>password</td>
                              <td>
                                    <input type="password" name="password"placeholder="Enter Your password">
                              </td>
                        </tr>

                        <tr>
                              <td colspan="2">
                                    <input type="submit" name="submit"value="Add Admin"class="btn-secondary">
                              </td>
                        </tr>

                  </table>
            </form>      
      </div>
</div>

<?php include("partials/footer.php"); ?>

<?php
    //process the value from and save it in database
        //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
            // button clicked
            //echo "button clicked";
    
        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption with MD5 

        //2. SQL Query to save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'    
          ";

                //3. executing Query and saving data into database
        $res = mysqli_query($conn, $sql) or die (mysqli_error());

        //4. check whether the (query is executed) data is inserted or not and display appropriate message 
        if($res==TRUE)
        {
            //data inserted
            //echo "Data Inserted";
            //create a session variable to display masssge
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            // Redirect page
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
             //failed to insert data
             //echo"Faile to Insert";
            //create a session variable to display masssge
            $_SESSION['add'] = "failed to Add Admin";
            // Redirect page
            header("location:".SITEURL.'admin/add-admin.php');
        }

    } 

?> 

