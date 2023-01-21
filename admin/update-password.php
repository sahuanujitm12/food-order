<?php include("partials/menu.php"); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>chang password</h1>
		<br><br>

		<?php
             if(isset($_GET['id']))
             {
             	$id=$_GET['id'];
             }

		?>

		<form action=""method="POST">
			<table class="tbl-30">
				<tr>
					<td>Curent password</td>
					<td>
						<input type="password" name="current_password"placeholder="current_password">
					</td>
				</tr>

				<tr>
					<td>	New password</td>
					<td>
						<input type="password" name="new_password"placeholder="new_password">
					</td>
				</tr>

				<tr>
					<td>Confirm password</td>
					<td>
						<input type="password" name="confirm_password"placeholder="confirm_password">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden"name="id"value="<?php echo $id;?>">
						<input type="submit" name="submit"value="change_password"class="btn-secondary">
					</td>
				</tr>
			</table>
			
		</from>

	</div>
	
</div>

<?php
     //check whether the submit button is clicked on not
     if(isset($_POST['submit']))
     {
     	  //echo "button clicked";
     	  //1. get the data from form 
            $id =$_POST['id'];
    	   $current_password = md5($_POST['current_password']);
          $new_password = md5($_POST['new_password']);
          $confirm_password = md5($_POST['confirm_password']);

          //2. check whether the user name white current ID and current password exists or not
          $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'"; 

     	

     	  	  //execute the Query
     	  $res = mysqli_query($conn, $sql);

        if($res==true)
        {
        	//check whether the data is availble or not
        	$count=mysqli_num_rows($res);

        	if($count==1)
        	{
        		//user exists and password can be chang 
        		//echo"user found"

        		//check whether the new password and confirm match or not
        		if($new_password==$confirm_password)
        		{
        			//update the password
        			//echo "password match";
        			$sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
        			";

        			//execute the query
        			$res2 = mysqli_query($conn, $sql2);

        			//check whether the query execute or not
        			if($res2==true)
        			{
        				//display sueecs the massege
        				//redirect to massege admin page with success massege
                         $_SESSION['change-pwd'] ="<div class='success'>password change successfuly. </div>";
        			//redirect the user
        			header('location:'.SITEURL.'admin/manage-admin.php');
                         
        			}
        			else
        			{
        				//display error massege
        				//redirect to massege admin page with error massege
                         $_SESSION['change-pwd'] ="<div class='error'>failed to chang password. </div>";
        			//redirect the user
        			header('location:'.SITEURL.'admin/manage-admin.php');
                        
        			}
        		}
        		else
        		{
        			//redirect to message admin page with erroe message
        			$_SESSION['pwd-not-match'] ="<div class='error'>password did not match. </div>";
        			//redirect the user
        			header('location:'.SITEURL.'admin/manage-admin.php');
        		}
        	}	
        	else
        	{
       			//user does not exist set manage and redirect
       		     $_SESSION['user-not-found'] ="<div class='error'>user not found. </div>";
       			//redirect the user
       			header('location:'.SITEURL.'admin/manage-admin.php');	
       		}
        	
        }
 
     }

?>


<?php include("partials/footer.php"); ?>