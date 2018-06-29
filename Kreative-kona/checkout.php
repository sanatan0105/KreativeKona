<?php 
include ('php/connect.php');
include('php/functions.php');
include('include/header.php');

include('include/headerB4Login.php');

include('include/top_menu.php');
?>

<div class="page-head">
	<div class="container">
		<h3>Check Out</h3>
	</div>
</div>
<!-- //banner -->
<!-- check out -->
<div class="checkout">
	<div class="container">
		<h3>My Shopping Bag</h3>
		<div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
			<table class="timetable_sub">
				<thead>
					<tr>
						<th>Remove</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Product Name</th>
						<th>Price</th>
					</tr>
				</thead>
				<?php 
				$user_id;
				if(logged_in()==true)
				{
					
					$sql_get_carts_pro=mysqli_query($con,"SELECT `p_id` FROM `cart` WHERE `user_id`=$user_id AND `status`=0");
					$count=mysqli_num_rows($sql_get_carts_pro);
					while($row_get_c_pro=mysqli_fetch_assoc($sql_get_carts_pro))
					{
						$p_id=$row_get_c_pro['p_id'];
						$sql_get_pro=mysqli_query($con,"SELECT *  FROM `product` WHERE `p_id`=$p_id");
						$row_get_pro=mysqli_fetch_assoc($sql_get_pro);
						$mrp=$row_get_pro['mrp'];
						$name=$row_get_pro['name'];
						$link_id=base64_encode($p_id);
						?>
					<tr class="rem1">
						<td class="invert-closeb">
							<div class="rem">
								<div class="close1"> </div>
							</div>
							<script>$(document).ready(function(c) {
								$('.close1').on('click', function(c){
									$('.rem1').fadeOut('slow', function(c){
										$('.rem1').remove();
									});
									});	  
								});
						   </script>
						</td>
						<td class="invert-image"><a href="single.php?value=<?php echo $link_id; ?>"><img src="images/productimage.PNG" alt=" " class="img-responsive" /></a></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                           
									<div class="entry value-minus">&nbsp;</div>
									<div class="entry value"><span>1</span></div>
									<div class="entry value-plus active">&nbsp;</div>
								</div>
							</div>
						</td>
						<td class="invert"><?php echo $name;?></td>
						<td class="invert">Rs <?php echo $mrp; ?></td>
					</tr>						
						<?php 
					}
				}
				else
				{
					$random_code=$_COOKIE['random_user_code'];
					$total_mrp=0;
					$sql_get_cart=mysqli_query($con,"SELECT `p_id` FROM `cart_without_login` WHERE `random_user_id`=(SELECT `random_user_id` FROM `random_code_user` WHERE `random_number`='$random_code')");
					$count=mysqli_num_rows($sql_get_cart);
					if($count>0)
					{
						while($row_get_cart=mysqli_fetch_assoc($sql_get_cart))
						{
							$p_id=$row_get_cart['p_id'];
							$sql_get_mrp=mysqli_query($con,"SELECT * FROM `product` WHERE `p_id`=$p_id");
							$row_get_mrp=mysqli_fetch_assoc($sql_get_mrp);
							$mrp=$row_get_mrp['mrp'];
							$name=$row_get_mrp['name'];
							?>
							<tr class="rem1">
						<td class="invert-closeb">
							<div class="rem">
								<div class="close1"> </div>
							</div>
							<script>$(document).ready(function(c) {
								$('.close1').on('click', function(c){
									$('.rem1').fadeOut('slow', function(c){
										$('.rem1').remove();
									});
									});	  
								});
						   </script>
						</td>
						<td class="invert-image"><a href="single.php?value=<?php echo $link_id; ?>"><img src="images/productimage.PNG" alt=" " class="img-responsive" /></a></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                           
									<div class="entry value-minus">&nbsp;</div>
									<div class="entry value"><span>1</span></div>
									<div class="entry value-plus active">&nbsp;</div>
								</div>
							</div>
						</td>
						<td class="invert"><?php echo $name;?></td>
						<td class="invert">Rs <?php echo $mrp; ?></td>
					</tr>
							<?php 
						}
					}
				}
				
				?>

					
					
								<!--quantity-->
									<script>
									$('.value-plus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
										divUpd.text(newVal);
									});

									$('.value-minus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
										if(newVal>=1) divUpd.text(newVal);
									});
									</script>
								<!--quantity-->
			</table>
		</div>
		<div class="checkout-left">	
				
				<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href=""><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To Shopping</a>
				</div>
				<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
					<h4>Shopping basket</h4>
					<ul>
						<?php 
						if(logged_in()==true)
						{
							$total_mrp=0;
							$sql_get_cart=mysqli_query($con,"SELECT * FROM `cart` WHERE `user_id`=$user_id AND `status`=0");
							$count=mysqli_num_rows($sql_get_cart);
							if($count>0)
							{
								while($row_get_cart=mysqli_fetch_assoc($sql_get_cart))
								{
									$p_id=$row_get_cart['p_id'];
									$sql_get_mrp=mysqli_query($con,"SELECT `mrp`,`name` FROM `product` WHERE `p_id`=$p_id");
									$row_get_mrp=mysqli_fetch_assoc($sql_get_mrp);
									$mrp=$row_get_mrp['mrp'];
									$name=$row_get_mrp['name'];
									$total_mrp=$total_mrp+$mrp;
									?>
									<li><?php echo $name; ?><i>-</i> <span>Rs <?php echo $mrp;?></span></li>
						
									<?php 
								}
							}
							
							
						}
						else
						{
							$random_code=$_COOKIE['random_user_code'];
							$total_mrp=0;
							$sql_get_cart=mysqli_query($con,"SELECT `p_id` FROM `cart_without_login` WHERE `random_user_id`=(SELECT `random_user_id` FROM `random_code_user` WHERE `random_number`='$random_code')");
							$count=mysqli_num_rows($sql_get_cart);
							if($count>0)
							{
								while($row_get_cart=mysqli_fetch_assoc($sql_get_cart))
								{
									$p_id=$row_get_cart['p_id'];
									$sql_get_mrp=mysqli_query($con,"SELECT `mrp` FROM `product` WHERE `p_id`=$p_id");
									$row_get_mrp=mysqli_fetch_assoc($sql_get_mrp);
									$mrp=$row_get_mrp['mrp'];
									$total_mrp=$total_mrp+$mrp;
									?>
									<li><?php echo $name; ?><i>-</i> <span>Rs <?php echo $mrp;?></span></li>
									<?php 
								}
							}
							
						}
						if($count==0)
						{
							echo '<li>No product <i>-</i> <span>Rs. 0 </span><li>';	
						}
						?>
						
						
						<li>Total <i>-</i> <span> Rs <?php echo $total_mrp;?></span></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
	</div>
</div>	
<?php 
include('include/purchase_des.php');
?>
<?php 
include('include/footer.php');
?>

<?php 
include('include/loginInclude.php');
?>	
</body>
</html>
