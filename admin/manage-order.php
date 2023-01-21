<?php include("partials/menu.php"); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>manage order</h1>
	
       

		     <br> <br> <br>

		     <?php
		     	if(isset($_SESSION['update']))
		     	 {
		     	 	echo $_SESSION['update'];
		     	 	unset($_SESSION['update']);
		     	 }

		     	 if(isset($_SESSION['delete']))
		     	 {
		     	 	echo $_SESSION['delete'];
		     	 	unset($_SESSION['delete']);
		     	 }

		     ?>
		     <br><br>

		     <table class="tbl-full">
		     	<tr>
		     		<th>S.N</th>
		     		<th>Food.</th>
		     		<th>Price.</th>
		     		<th>Qty.</th>
		     		<th>Total.</th>
		     		<th>Order Date.</th>
		     		<th>Status</th>
		     		<th>Customer Name.</th>
		     		<th>Concact.</th>
		     		<th>Email.</th>
		     		<th>Address.</th>
		     		<th>Actions.</th>
		     	</tr>

		     	<?php 
		     		//get all the order from datavase
		     	$sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //DISPLAY THE latest order ot first
		     	//execute the query
		     	$res = mysqli_query($conn, $sql);
		     	//count the rows
		     	$count = mysqli_num_rows($res);

		     	$sn = 1; //create a serial number and set its instal the value

		     	if($count>0)
		     	{
		     		//order available
		     		while($row=mysqli_fetch_assoc($res))
		     		{
		     			//get order the other detail
		     			$id = $row['id'];
		     			$food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                        ?>
			               	<tr>
					     		<td><?php echo $sn++; ?></td>
					     		<td><?php echo $food; ?></td>
					     		<td><?php echo $price; ?></td>
					     		<td><?php echo $qty; ?></td>
					     		<td><?php echo $total; ?></td>
					     		<td><?php echo $order_date; ?></td>

					     		<td>
					     			<?php
					     				//
					     				if($status=="ordered")
					     				{
					     					echo "<label style='color: blue;'>$status</label>";
					     				}
					     				elseif($status=="on delivery")
					     				{
					     					echo "<label style='color: red;'>$status</label>";
					     				}
					     				elseif($status=="delivered")
					     				{
					     					echo "<label style='color: green;'>$status</label>";
					     				}
					     				elseif($status=="cancelled")
					     				{
					     					echo "<label style='color: orange;'>$status</label>";
					     				}

					     			?>
					     			
					     		</td>

					     		<td><?php echo $customer_name; ?></td>
					     		<td><?php echo $customer_contact; ?></td>
					     		<td><?php echo $customer_email; ?></td>
					     		<td><?php echo $customer_address; ?></td>
					     		<td>
					     			<a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"class="btn-secondary"> update order</a>
					     			<a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>"class="btn-secondary"> delete order</a>
					     		</td>
					     		
					     	</tr>

                        <?php

		     		}
		     	}
		     	else
		     	{
		     		//order not available
		     		echo "<tr><td colspan='12' class='error'>order not available.</td></tr>";

		     	}

		     	?>

		     	

		     		

		     </table>

	</div>

</div>

<?php include("partials/footer.php"); ?>