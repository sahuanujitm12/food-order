<?php
	
	//Authorization - access control
	//check whether the user is logged in or not
	if(isset($_SESSION['user']['password'])) //if user session is not
	{
		//user is not login
		//redirect to login page with message
		$_SESSION['no-login-message'] ="<div class='error text-center'>please login to access admin panel.<div>";
		
		//redirect to login
		header('location:'.SITEURL.'admin/login.php');
	}

?>