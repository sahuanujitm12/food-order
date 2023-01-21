<?php include("partials/menu.php"); ?>

<div class="main-content">
	<div  class="wrapper">
		<h1>Add Food</h1>
	
		<br><br>

		<?php

			if(isset($_SESSION['upload']))
           	 {
           	 	echo $_SESSION['upload'];
           	 	unset($_SESSION['upload']);
           	 }

		?>

		<form action=""method="POST"enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title"placeholder="title of the food">
					</td>
				</tr>

				<tr>
					<td>Description:</td>
					<td>
						<textarea name="description"cols="30"rows="5"placeholder="Description of the Food"></textarea>
					</td>
				</tr>

				<tr>
					<td>Price</td>
					<td>
						<input type="number" name="price">
					</td>
				</tr>

				<tr>
					<td>Selected Image:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category:</td>
					<td>
						<select>

							<?php
								//create php code to display category from database 
							//1. category sql to get all active category from database
							$sql = "SELECT * FROM tbl_category WHERE active='Yes'";

							//executing query
							$res = mysqli_query($conn, $sql);

							//count row to chack whetherwe have category or not
							$count = mysqli_num_rows($res);

							//if count is greter then zero, we have category else we doont have category
							if($count>0)
							{
								//we have a category
								while($row=mysqli_fetch_assoc($res))
								{
									//get the details of category
									$id = $row['id'];
									$title = $row['title'];

									?>

									<option value="<?php echo $id; ?>"><?php echo $title; ?></option>

									<?php
								}
							}
							else
							{
								//we do not have category
								?>
								<option value="0">No Category Food</option>
								<?php
							}

								//2. 

							?>

							
						</select>
					</td>
				</tr>

				<tr>
					<td>Featured:</td>
					<td>
						<input type="radio" name="featured" value="yes">YES
						<input type="radio" name="featured" value="no">NO
					</td>
				</tr>

				<tr>
					<td>Active:</td>
					<td>
						<input type="radio" name="active" value="yes">YES
						<input type="radio" name="active" value="no">NO
					</td>
				</tr>

				<tr>
					<td>submit:</td>
					<td>
						<input type="submit" name="submit"value="Add Food"class="btn-secondary">
						
					</td>
				</tr>

			</table>
		</form>

<?php 
	
	//check whether the button is clicked or not
	if(isset($_POST['submit']))
	{
		//addthe food in database
		//echo "clicked";

		//1. get the data from form
		$title = $_POST['title'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$category = $_POST['category'];

		//check whether radion button for featured and active are checked or not
		if(isset($_POST['featured']))
		{		
			$featured = $_POST['featured'];
		}
		else
		{
			$featured="NO"; //stting the defaul value
		}

		if(isset($_POST['active']))
		{
			$active = $_POST['active'];
		}
		else
		{
			$active="NO"; //setting default value
		}

		//2. upload the image if selected
		//check whether the selected is imageis clicked or not and upload the image only if the image is selected
	if(isset($_FILES['image']['name']))
		{
			//get the details of the selected image
			$image_name = $_FILES['image']['name'];

			//checked whether the image is selected or not and upload or image only if selected
			if($image_name!="")
			{
				//image is selected 
				//A. remanage the image
				//get the extension of selected image (jpg, png, gif, etc.) "anuj-sahu.jpg"anujsahu jpg
				$ext = end(explode('.', $image_name));

				//create new name for image
				$image_name = "Food-Name-".rand(0000,9999).".".$ext; //new image name may be "food-name-657.jpg"

				//B. upload the image
				//get the src path anddestination path

				//source path is the current location of the image
				$src = $_FILES['image']['tmp_name'];

				//destination path for the imageto be upload
				$dst = "../images/food/".$image_name;

				//finally upload the food image
				$upload = move_uploaded_file($src, $dst);

				//checked  whether image upload or not
				if($upload==false)
				{
					//failed upload the image
					//redirect to add food with error massege
					$_SESSION['upload'] = "<div class='error'>failed to upload image.</div>";	
					header('location:'.SITEURL.'admin/add-food.php');
					//stop the process
					die();

				}
			
			}
		
		}
		else
		{
			$image_name =""; //setting difULT VALUE AS blank
		}

		//3. create a sql query to save or add food 
		//for numrical we do not need to pass value inside quotes '' but for string value it is campulsory is add quotas''
		$sql2 = "INSERT INTO tbl_food SET
			title = '$title',
			description = '$description',
			price = $price,
			image_name = '$image_name',
			category_id = '$category',
			featured = '$featured',
			active = '$active'
		";
		//executed the query
		$res2 = mysqli_query($conn, $sql2);

		//checked whether data inserted or not 
		//4. redirect with message to manage food page
		if($res2 == true)
		{
			//data inserted successfully
			$_SESSION['add'] ="<div class='success'>Food Added Successfully.</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		}
		else
		{
			//Failed to insert data
			$_SESSION['add'] ="<div class='error'>Failed To Add Food.</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
			
		}

	
	}

?>

	</div>
</div>





<?php include("partials/footer.php"); ?>