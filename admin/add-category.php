<?php include("partials/menu.php"); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>

		<br><br>

		<?php
             if(isset($_SESSION['add']))
           	 {
           	 	echo $_SESSION['add'];
           	 	unset($_SESSION['add']);
           	 }

           	 if(isset($_SESSION['upload']))
           	 {
           	 	echo $_SESSION['upload'];
           	 	unset($_SESSION['upload']);
           	 }
        ?> 

        <br><br>
		<!--add category from starts-->
		<form action=""method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title"placeholder="Category Title">
					</td>
				
				</tr>
				
				<tr>
					<td>Select Image</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Featured:</td>
					<td>
						<input type="radio" name="featured"value="YES">YES
						<input type="radio" name="featured"value="NO">NO
					</td>
				
				</tr>

				<tr>
					<td>Active:</td>
					<td>
						<input type="radio" name="active"value="YES">YES
						<input type="radio" name="active"value="NO">NO
					</td>
				
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit"value="Add Category"class="btn-secondary">
					</td>
				
				</tr>
			</table>
		</form>

		<!--add category from end-->

		<?php
			//check whether the submit button is click or not 
			if(isset($_POST['submit']))
			{
				//echo "clicked";


				//1. get the value from category form
				$title = $_POST['title'];

				//for radio input, we need to check whether the button is selectes or not
				if(isset($_POST['featured']))
				{
					//get the value from form
					$featured = $_POST['featured'];
				}
				else
				{
					//set the difault value
					$featured ="NO";
				}
				if(isset($_POST['active']))
				{
					$active = $_POST['active'];
				}
				else
				{
					//set the difualt value
					$active ="NO";
				}

				//check whether the image is select or not and set the value for image name accorodingly
				//print_r($_FILES[image]);

				//die();//brack the color here

				if(isset($_FILES['image']['name']))
				{
					//uplod the image
					//to uplod image we need image name source path and destination path
					$image_name = $_FILES['image']['name'];

					//uplode the image only if image selected
					if($image_name !="")
					{

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
						header('location:'.SITEURL.'admin/add-category.php');
						//stop the process
						die();
						}

					}	
				

				}
				else
				{
					//Dont't uplode image and set image_name value as blank
					$image_name="";
				}

				//2. create sql query to insert category into database
				$sql ="INSERT INTO tbl_category SET
					title='$title',
					image_name='$image_name',
					featured='$featured',
					active='$active'
				";

				//3. execute the query and save datebase
				$res = mysqli_query($conn, $sql);

				//4. checked whether the query  executer or not and database
				if($res==true)
				{
					//query executed and category added
					$_SESSION['add'] ="<div class='success'>Category Added Successfully.</div>";
					////redirect to manage category page
					header('location:'.SITEURL.'admin/add-category.php');
				}
				else
				{
					//failed to add category
					$_SESSION['add'] ="<div class='error'>Category Failed To Add Category.</div>";
					//redirect to manage category page
					header('location:'.SITEURL.'admin/add-category.php');
				}
			}

		?>

	</div>
</div> 

<?php include("partials/footer.php"); ?>