<?php
	//include constants file
	include('../config/constants.php');

	//echo "delete page";
	//check whether the id and image_name value is set or not
	if(isset($_GET['id'])AND isset($_GET['image_name']))
	{
		//Get the value and delete
		//echo get value and delete
		$id = $_GET['id'];
		$image_name =$_GET['image_name'];

		//remove the physical image file is available
		if(image_name !="")
		{
			//image is availeble. so remove it
			$path = "../images/category/".$image_name;
			//remove the image
			$remove = unlink($path);

			//if failed to remove image the add an erroe message and stop the process
			if($remove==false)
			{
				//set the session message
				$_SESSION['remove'] = "<div class='error'>failed to remove category image.</div>";
				//redirect to massege category page
				header('location:'.SITEURL.'admin/manage-category.php');
				//stop the process
				die();
			}
		}

		//delete data from database
		//sql query to delete data from datadase
		$sql = "DELETE FROM tbl_category WHERE id=$id";

		//execute the query
		$res = mysqli_query($conn, $sql);

		//check WHETHER THE data IS DELETE FROM DATABASE or not 
		if($res==true)
		{
			//set success massege and redirect
			$_SESSION['delete'] = "<div class='success'>category deleted successfully.</div>";
				//redirect to massege category 
				header('location:'.SITEURL.'admin/manage-category.php');
			
			
		}
		else
		{
			//set fail massege category
			$_SESSION['delete'] = "<div class='error'>failed to delete category.</div>";
				//redirect to massege category page
				header('location:'.SITEURL.'admin/manage-category.php');

		}
	




	}
	else
	{
		//redirect to manage category page
		header('location:'.SITEURL.'admin/manage-category.php');
	}

?>