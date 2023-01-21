<html>
	<head>
		<title>login - Car sales and inventory management system</title>
		<link rel="stylesheet" href="../css/admin.css">
	</head>
	<style>
		background-image: url="https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/2020-Chevrolet-Corvette-Stingray/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&width=960";

	</style>

	<body>

		<div class="login">
			<h1 class="text-center">login</h1>
             <br><br>

             <?php
             	 if(isset($_SESSION['login']))
             	 {
             	 	echo $_SESSION['login'];
             	 	unset($_SESSION['login']);
             	 }

             	 if(isset($_SESSION['no-login-message']))
             	  {
             	  	echo $_SESSION['no-login-message'];
             	 	unset($_SESSION['no-login-message']);
             	  }


             ?>

            <!-- login forn start here  -->
             <form action=""method="POST"class="text-center">
             	Username: <br>
             	<input type="username" name="username"placeholder="Enter username"><br><br>

             	password: <br>
             	<input type="password" name="password"placeholder="Enter password"> <br><br>

             	<input type="submit" name="submit"value="login"class="btn-primary">
				<br>
				</form>
				<br>

            <!-- login form end here -->

			<p class="text-center">Created By - <a href="www.anujsahu.com"> <br>
				<br> Anuj Sahu <br> Tushar Agarwal <br> Sumit Kushwaha <br> Priya Jain</a></p>
		</div>
	</body>
</html>

<?php
    //check whether the submit button is clicked or not
	if(isset($_POST['submit']))
	{
		//process for login 
	    //1. Get the data from login form 
		 $username = $_POST['username'];
		 $password = md5($_POST['password']);

		//2. sql to check whether the user with username and password exists or not
         $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

		//3. execute the query
		$res = mysqli_query($conn, $sql);

		//4. count row to check whether the user exists or not 
        $count = mysqli_num_rows($res);
		
        if($count==1)
        {
         	//user available and login success
         	$_SESSION['login'] = "<div class='success'>login successful.</div>";
         	($_SESSION)['user'] = $username;			//to check whether the user is logout in or not and logout will unset it
		//	($_SESSION)['password'] = $password;

         	//Redirect to home page/dashdoard
        	header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available and login success
         	$_SESSION['login'] = "<div class='error text-center'>username and password did not match.</div>";
         	//Redirect to home page/dashdoard
         	header('location:'.SITEURL.'admin/login.php');
        }

	}
	


?>