<?php include("partials/menu.php"); ?>

<div class="main content">
	<div class="wrapper">
		<h1>Update Category</h1>

		<br><br>

		<?php
			//check whether the id is set or not
			if(isset($_GET['id']))
			{
				//get the id and oe oyher ditels
				//echo "getting the data";
				$id = $_GET['id'];
				//create the sql query to get all other ditial
				$sql = "SELECT * FROM tbl_category WHERE id=$id";

				//executed the query 
				$res = mysqli_query($conn, $sql);

				//count the rows to check whether the id is valid or not
				$count = mysqli_num_rows($res);

				if($count==1)
				{
					//get all the data
					$row = mysqli_fetch_assoc($res);
					$title = $row['title'];
					$current_image = $row['image_name'];
					$featured = $row['featured'];
					$active = $row['active'];
				}
				else
				{
					//redirect to manage category with session massege
					$_SESSION['no-category-found'] ="<div class='error'>Category not found.</div>";
						
						header('location:'.SITEURL.'admin/manage-category.php');
					
				}
			}
			else
			{
				//redirect to manage category
				header('location:'.SITEURL.'admin/manage-category.php');
			}



		?>

		<form action=""method="POST"enctype="multipart/form-data">
			
			<table class="tbl_30">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title"value="<?php echo $title; ?>">
					</td>
				</tr>

				<tr>
					<td>Current Image:</td>
					<td>
						<?php
							if($current_image !="")
							{
								//displat the image
								?>
									<img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>"width="100px">
								<?php
							}
							else
							{
								//display massege
								echo "<div class='error'>Image Not Add.</div>";
							}

						?>
					</td>
				</tr>

				<tr>
					<td>New Image:</td>
					<td>
						<input type="file" name="image">
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
					<td>
						<input type="hidden" name="current_image"value="<?php echo $current_image; ?>">
						<input type="hidden" name="id"value="<?php echo $id; ?>">
						<input type="submit" name="submit"value="Updata Category"class="btn-secondary">
					</td>
				
				</tr>
			</table>
		</form>
		<?php
			if(isset($_POST['submit']))
			{
				//echo "clicked";
				//1. get all the value from our form
				$id = $_POST['id'];
				$title = $_POST['title'];
				$current_image = $_POST['current_image'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];


				//2. updating news image if selecter
				//chackwhether the image is selected or not
				if(isset($_FILES['image']['name']))
				{
					//get the image ditials
					$image_name = $_FILES['image']['name'];

					//check whether the image is available or not
					if($image_name !="")
					{
						//image available
						//a. upload the new image

						//auto rename or image
						//get the extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
						$ext =end(explode('.',$image_name));

						//rename the image
						$image_name = "food_category_".rand(000, 999).'.'.$ext; //e.g. food_category_834.jpg

						$source_path = $_FILES['image']['tmp_name'];

						$destination_path ="../images/category/".$image_name;

						//finally uplod the image
						$upload = move_uploaded_file($source_path, $destination_path);

						//check whether the image is upload or not
						//add if the image is not uploaded they will stop the process and redirect whit error message
						if($upload==false)
						{
						//set massege
						$_SESSION['upload'] ="<div class='error'>failed to upload image.</div>";
						//redirect to add category page
						header('location:'.SITEURL.'admin/manage-category.php');
						//stop the process
						die();
						}

						//B. remove the current image if availble
						if($current_image !="")
						{

							$remove_path ="../images/category/".$current_image;

							$remove = unlink($remove_path);

							//check whether the image is removed or not
							//it failed to remove them display massege on top the process
							if($remove==false)
							{
								//failed to remove image
								$_SESSION['failed-remove'] ="<div class='error'>Failed Remove Current Image .</div>";
								header('location:'.SITEURL.'admin/manage-category.php');
							
								die(); //stop the process
							}

						}
						
					}
					else
					{
						$image_name = $current_image;
					}
				}
				

				//3. update the database
				$sql2 = " UPDATE tbl_category SET
					title = '$title',
					image_name = '$image_name',
					featured = '$featured',
					active = '$active'
					WHERE id=$id
				";

				//executed the query
				$res2 = mysqli_query($conn, $sql2);

				//4. redirect to manage category with massege
				//check whether executed with massege
				if($res2==true)
				{
					//category update
					$_SESSION['update'] ="<div class='success'>Category update seccessfull.</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
					

				}
				else
				{
					//falled to update category
					$_SESSION['update'] ="<div class='error'>failed to update category.</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}
			}

		?>


	</div>
</div>





<?php include("partials/footer.php"); ?>