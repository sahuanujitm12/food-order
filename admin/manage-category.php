<?php include("partials/menu.php"); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Manage Category</h1>

        <br> <br>

        <?php
             if(isset($_SESSION['add']))
           	 {
           	 	echo $_SESSION['add'];
           	 	unset($_SESSION['add']);
           	 }

           	 if(isset($_SESSION['remove']))
           	 {
           	 	echo $_SESSION['remove'];
           	 	unset($_SESSION['remove']);
           	 }

           	 if(isset($_SESSION['delete']))
           	 {
           	 	echo $_SESSION['delete'];
           	 	unset($_SESSION['delete']);
           	 }

           	 if(isset($_SESSION['no-category-found']))
           	 {
           	 	echo $_SESSION['no-category-found'];
           	 	unset($_SESSION['no-category-found']);
           	 }

           	 if(isset($_SESSION['update']))
           	 {
           	 	echo $_SESSION['update'];
           	 	unset($_SESSION['update']);
           	 }

           	 if(isset($_SESSION['upload']))
           	 {
           	 	echo $_SESSION['upload'];
           	 	unset($_SESSION['upload']);
           	 }

           	 if(isset($_SESSION['failed-remove']))
           	 {
           	 	echo $_SESSION['failed-remove'];
           	 	unset($_SESSION['failed-remove']);
           	 }
       
        ?> 

        <br><br>

		     <!--Button to Add Admin-->
		     <a href="<?php echo SITEURL; ?>admin/add-category.php"class="btn-primary">Add category</a>

		     <br> <br> <br>

		     <table class="tbl-full">
		     	<tr>
		     		<th>S.N</th>
		     		<th>title</th>
		     		<th>image</th>
		     		<th>featured</th>
		     		<th>active</th>
		     	</tr>

		     	<?php

		     		//query to get all categories from database
		     		$sql = "SELECT * FROM tbl_category";

		     		//execute the query
		     		$res = mysqli_query($conn, $sql);

		     		//count row
		     		$count = mysqli_num_rows($res);

		     		//check whether we have data and database or not
		     		$sn=1;

		     		//chack whether we have data in database or not
		     		if($count>0)
		     		{
		     			//wehave data in database
		     			//get the data and display
		     			while($row=mysqli_fetch_assoc($res))
		     			{
		     				$id = $row['id'];
		     				$title = $row['title'];
		     				$image_name = $row['image_name'];
		     				$featured =$row['featured'];
		     				$active = $row['active'];

		     				?>

		     					<tr>
		     						<td><?php echo $sn++; ?></td>
		     						<td><?php echo $title; ?></td>

		     						<td>
		     							<?php
		     								//ckeck whether image is available or not
		     							 	if($image_name!="")
		     							 	{
		     							 		//display the image
		     							 		?>

		     							 		<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="50px">
		     							 		
		     							 		<?php
		     							 	}
		     							 	else
		     							 	{
		     							 		//display the message
		     							 		echo "<div class='error'>Image Not Add.</div>";
		     							 	} 

		     							?>
		     								
		     						</td>

		     						<td><?php echo $featured; ?></td>
		     						<td><?php echo $active; ?></td>
		     	
		     						<td>
		     							<a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>"class="btn-secondary"> update category</a>
		     							<a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"class="btn-danger"> Delete category</a>
		     						</td>
		    				 	
								</tr>

		     				<?php
		     			}
		     		}
		     		else
		     		{
		     			//we do not have data
		     			//we'll display the massage inside teble
		     			?>
		     			<tr>
		     				<td colspan="6"><div class="error">No Category Add.</div></td>
		     			</tr>

		     			<?php
		     		}

		     	?>

		     	

		        
		     </table>

	</div>

</div>

<?php include("partials/footer.php"); ?>