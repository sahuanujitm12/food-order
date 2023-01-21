<?php
	//include constants page
	include('../config/constants.php');

	//echo "hello";

	if(isset($_GET['id']) && isset($_GET['image_name'])) //either use "&&" or 'and'
	{
		//process to delete 
		//echo "process to delete";

		//1. get id aND image name
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		//2. remove the image if available
		//check whether the image is available or not and delete only if available
		if($image_name !="")
		{
			//it has image and need to remove from folder
			//get the image path
			$path = "../images/food/".$image_name;

			//remove image file from folder
			$remove = unlink($path);

			//check whether the image is removed or not
			if($remove==false)
			{
				//failed to remove image
				$_SESSION['upload'] = "<div class='error'>Failed to Remove image file.</div>";
				//redirect to image food
				header('location:'.SITEURL.'admin/manage-food.php');
				//stop the remove of deleting food
				die();
			}
		
		}

		//3. delete food from database
		$sql = "DELETE FROM tbl_food WHERE id=$id";
		//execute the query
		$res = mysqli_query($conn, $sql);

		//check whether the query executedor not and set the session massege respectively 
		//4. redirect to manage food with session message
		if($res==true)
		{
			//food deleted
			$_SESSION['delete'] = "<div class='success'>Food delete successfully.</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		} 
		else
		{
			//failed to delete food
			$_SESSION['delete'] = "<div class='error'>Failed to delete food.</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		}
		
	

	}
	else
	{
		//redirect to manage food page
		//echo "redirect";
		$_SESSION['unauthorize'] = "<div class='error'>unauthorize Access.</div>";
		header('location:'.SITEURL.'admin/manage-food.php');

	}


?>