<?php include('partials/menu.php'); ?>


<?php
	//check whether id is set or not
	if(isset($_GET['id']))
	{
		//get all the detalis
		$id = $_GET['id'];

		//sql query to get the selected food
		$sql2 = "SELECT * FROM tbl_food WHERE id=$id";
		//execute the query
		$res2 = mysqli_query($conn, $sql2);

		//get the value based on query execute
		$row2 = mysqli_fetch_assoc($res2);

		//get the individual values of selected food
		$title = $row2['title'];
		$description = $row2['description'];
		$price = $row2['price'];
		$current_image = $row2['image_name'];
		$current_category = $row2['category_id'];
		$featured = $row2['featured'];
		$active = $row2['active'];
	}
	else
	{
		//redirected to manage food
		header('location:'.SITEURL.'admin/manage-food.php');
	}

?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Food</h1>
		<br><br>


		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title"value="<?php echo $title; ?>"></td>
				</tr>

				<tr>
					<td>Description:</td>
					<td>
						<textarea name="description" cols="30"rows="5"><?php echo $description; ?></textarea>
					</td>
				</tr>

				<tr>
					<td>Price:</td>
					<td>
						<input type="number" name="price"value="<?php echo $price; ?>">
					</td>
				</tr>

				<tr>
					<td>Current_image:</td>
					<td>
						<?php
							if($current_image=="")
							{
								//image not available
								echo "<div class='error'>image not availble.</div>";
							}
							else
							{
								//image available
								?>
								<img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>"width="100px">
								<?php
							}

						?>
					</td>
				</tr>

				<tr>
					<td>Select new image:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category:</td>
					<td>
						<select name="category">

							<?php
								//query to get active categories
								$sql = "SELECT * FROM tbl_category WHERE active='Yes'";
								//execute the query
								$res = mysqli_query($conn, $sql);
								//count row
								$count = mysqli_num_rows($res);

								//check whether category available or not
								if($count>0)
								{
									//category available
									while($row=mysqli_fetch_assoc($res))
									{
										$category_title = $row['title'];
										$category_id = $row['id'];

										//echo "<option value='$category_id'>$category_title </option>";
										?>
										<option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?> </option>	
										<?php 
									}
								}
								else
								{
									//category not available
									echo "<option value='0'>Category Not Available.</option>";  
									
								}

							?>

							
						</select>
							
					</td>
				</tr>

				<tr>
					<td>Featured:</td>
					<td>
						<input <?php if($featured =="YES"){echo "checked";} ?> type="radio" name="featured"value="YES">YES

						<input <?php if($featured =="NO"){echo "checked";} ?> type="radio" name="featured"value="NO">NO
					</td>
				</tr>

				<tr>
					<td>Active:</td>
					<td>
						<input <?php if($active =="YES"){echo "checked";} ?> type="radio" name="active"value="YES">YES

						<input <?php if($active =="NO"){echo "checked";} ?> type="radio" name="active"value="NO">NO
					</td>
				</tr>

				<tr>
					<td>submit:</td>
					<td>
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="Current_image" value="<?php echo $current_image ?>">
						<input type="submit" name="submit" value="update Food" class="btn-secondary">
						
					</td>
				</tr>

			</table>

		</form>

		<?php

			if(isset($_POST['submit']))
			{
				//echo "button clicked";

				//1. get all the details from the form
				$id = $_POST['id'];
				$title = $_POST['title'];
				$description = $_POST['description'];
				$price = $_POST['price'];
				$current_image = $_POST['current_image'];
				$category = $_POST['category'];

				$featured = $_POST['featured'];
				$active = $_POST['active'];

				//2. upload the image if selected

				//checked whether upload button is clicked or not
				if(isset($_FILES['image']['name']))
				{
					//upload button clicked
					$image_name = $_FILES['image']['name']; //new image name

					//checked whether the file is available or not
					if($image_name !="")
					{
						//image is availble
						//A. upload the image
						
						//rename the image
						$ext = end(explode('.',$image_name)); //get the extension of the image


						$image_name = "food_name_".rand(000, 999).'.'.$ext; //this will be renamend image

						//get the source path and destination path
						$source_path = $_FILES['image']['tmp_name']; //source path
						$destination_path = "../images/food/".$image_name; //destination path

						//upload the image
						$upload = move_uploaded_file($source_path, $destination_path);

						///checked whether the image upload or not
						if($upload==false)
						{
							//failed the upload file
							$_SESSION['upload'] ="<div class='error'>failed the upload new image.</div>";
							//redirect to manage food
							header('location:'.SITEURL.'admin/manage-food.php');
							//stop the process
							die();
						}
						//3.remove the image if new image is uploaded and current image exists
						//B. remove current image if available
						if($current_image!="")
						{
							//current image is availble
							//remove the image
							$remove_path ="../images/food/".$current_image;
							$remove = unlink($remove_path);

							//check whether the image isremove or not
							if($remove==false)
							{
								//failed to remove current image
								$_SESSION['remove-failed'] ="<div class='error'>failed to remove current image.</div>";
								//redirect to manage food
								header('location:'.SITEURL.'admin/manage-food.php');
								//stop the process
								die();
							
							}
						}
					}
					
				}
				else
				{
					$image_name = $current_image;
				}

				//4. update the food and database
				$sql3 = "UPDATE tbl_food SET
					title = '$title',
					description = '$description',
					price = $price,
					image_name = '$image_name',
					category_id = '$category',
					featured = '$featured',
					active = '$active'
					WHERE id=$id

				";
				
				//execute the sql query
				$res3 = mysqli_query($conn, $sql3);

				//check whether the query is executed or not
				if($res3==true)
				{
					//query executed and food updated
					$_SESSION['update'] ="<div class='success'>Food updated successfully.</div>";
					header('location:'.SITEURL.'admin/manage-food.php');
				}
				else
				{
					//failed to update food 
					$_SESSION['update'] ="<div class='error'>Failed to updated food.</div>";
					header('location:'.SITEURL.'admin/manage-food.php');
					
					
				}

			}
			
		?>

	</div>

</div>


<?php include('partials/footer.php'); ?>