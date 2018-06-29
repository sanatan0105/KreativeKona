<?php 
include ('php/connect.php');
include('php/functions.php');
include('include/header.php');

include('include/headerB4Login.php');

include('include/top_menu.php');
 
 
$user_id=$_COOKIE['user_id'];
$date=datefunction();
$sql_vendor_id=mysqli_query($con,"SELECT `vendor_id` FROM `vendor` WHERE `email` = (SELECT `email` FROM `user` WHERE `user_id`=$user_id)");
$row_vendor_id=mysqli_fetch_assoc($sql_vendor_id);
$vendor_id=$row_vendor_id['vendor_id']; 
?>

</br></br>
<div class="col-md-3"></div>
<?php 
if(isset($_GET['order']))
{
	$order_id=sanitize(base64_decode($_GET['order']));
	$sql_get_order_details=mysqli_query($con,"SELECT * FROM `ord` WHERE `order_id`=$order_id");
	$cou=mysqli_num_rows($sql_get_order_details);
	if($cou==0)
		echo '<h3>Sorry we are not able to find any order with that order value...</h3>';
	else
	{
		?>
		<center>
		<div class="bs-docs-example container-fluid">
				<table class="table table-striped">
				  <thead>
					<tr>
					  <th>Order ID</th>
					  <th>Product Name</th>
					  <th>Quantity</th>
					  <th>Buyer Name</th>
					  <th>Address</th>
					  <th>Total Mrp</th>
					  <th>Accept Order</th>
					</tr>
				  </thead>
				  <tbody>
		<?php 
		$row_get_order_details=mysqli_fetch_assoc($sql_get_order_details);
		$buyer_id=$row_get_order_details['user_id'];
		$buyer_name=$row_get_order_details['buyer_name'];
		$p_id=$row_get_order_details['p_id'];
		$amount=$row_get_order_details['amount'];
		$ad1=$row_get_order_details['ad1'];
		$ad2=$row_get_order_details['ad2'];
		$zip=$row_get_order_details['zip'];
		$city=$row_get_order_details['city'];
		$state=$row_get_order_details['state'];
		$time=$row_get_order_details['time_order'];
		
		
		$sql_p_details=mysqli_query($con,"SELECT * FROM `product` WHERE `p_id`=$p_id");
		$row_p_details=mysqli_fetch_assoc($sql_p_details);
		$p_name=$row_p_details['name'];
		$p_mrp=$row_p_details['mrp'];
		
		?>
		<tr>
                  <td><?php echo $order_id;?></td>
                  <td><?php echo $p_name;?></td>
                  <td><?php echo $amount; ?></td>
                  <td><?php echo $buyer_name; ?></td>
				  <td><?php echo $ad1.'</br> '.$ad2.'</br> '.$zip.' '.$city.'</br> '.$state;?></td>
				  <td><?php echo $mrp*$amount;?></td>
				  <td><a href="order-details.php?status=accept&value=<?php echo base64_encode($order_id);?>"><button class="btn btn-danger">Accept</button></a></td>
                </tr>
				 </tbody>
            </table>
          </div>
</center>
		<?php 
		
	}
}
elseif(isset($_GET['status']) AND isset($_GET['value']))
{
	$ord_id=sanitize(base64_decode($_GET['value']));
	$sql_accept=mysqli_query($con,"UPDATE `ord` SET `accept_reject`=1 WHERE `order_id`=$ord_id");
	if($sql_accept)
		echo '<center><div class="alert alert-danger"><strong>Accepted....Please do the furthur procedure...</strong></div></center>';
	else
		echo '<center><div class="alert alert-danger"><strong>We are facing some technical isseues...</strong></div></center>';
}
elseif(isset($_GET['type']))
{
	$sql_get_order_history=mysqli_query($con,"SELECT * FROM `ord` WHERE `vendor_id`=$vendor_id AND `admin_status`=1 AND `accept_reject`=1 AND `status`=1");
	$order_count=mysqli_num_rows($sql_get_order_history);
	if($order_count==0)
		echo '<div class="container-fluid alert alert-danger"><center><strong>No history of any order yet...</strong></center></div>';
	else
	{
	?>
	<center>
		<div class="bs-docs-example container-fluid">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th>Order ID</th>
				  <th>Product Name</th>
				  <th>Quantity</th>
				  <th>Buyer Name</th>
				  <th>Address</th>
				  <th>Total MRP</th>
				  <th>Time</th>
				</tr>
			  </thead>
			  <tbody>
			<?php 
			
			while($row_get_order_history=mysqli_fetch_assoc($sql_get_order_history))
			{
				$order_id=$row_get_order_history['order_id'];
				$user_id=$row_get_order_history['user_id'];
				$buyer_name=$row_get_order_history['buyer_name'];
				$p_id=$row_get_order_history['p_id'];
				$quantity=$row_get_order_history['amount'];
				$ad1=$row_get_order_history['ad1'];
				$ad2=$row_get_order_history['ad2'];
				$zip=$row_get_order_history['zip'];
				$city=$row_get_order_history['city'];
				$state=$row_get_order_history['state'];
				$time=$row_get_order_history['time_order'];
				
				$sql_p_details=mysqli_query($con,"SELECT * FROM `product` WHERE `p_id`=$p_id");
				$row_p_details=mysqli_fetch_assoc($sql_p_details);
				$p_name=$row_p_details['name'];
				$p_mrp=$row_p_details['mrp'];				
				
				?>
				<tr>
                  <td><?php echo $order_id;?></td>
                  <td><strong><a href="single.php?value=<?php echo base64_encode($p_id);?>"><?php echo $p_name;?></a></strong></td>
                  <td><?php echo $quantity; ?></td>
                  <td><?php echo $buyer_name; ?></td>
				  <td><?php echo $ad1.'</br> '.$ad2.'</br> '.$zip.' '.$city.'</br> '.$state;?></td>
				  <td><?php echo $mrp*$quantity; ?></td>
				  <td><?php echo $time; ?></td>
                </tr>
				<?php 
				
			}
			echo '</tbody>
            </table>
          </div>
		</center>';
	}
}
?>

                
               
             
</br></br>		
	
<?php 
include('include/purchase_des.php');
?>
<?php 
include('include/footer.php');
?>
<!-- //footer -->
<!-- login -->
<?php 
include('include/loginInclude.php');
?>			
<!-- //login -->
</body>
</html>