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



<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3>Some header</h3>
	</div>
</div>
<!-- //banner -->
<!-- mens -->
<div class="men-wear">
	<div class="container">
		<div class="col-md-4 products-left">
			
			
			<div class="community-poll">
				<h4>Settings</h4>
				<div class="swit form">	
					
				
					<?php 
					$sql_user_email=mysqli_query($con,"SELECT `email` FROM `user` WHERE `user_id`=$user_id");
					$row_user_email=mysqli_fetch_array($sql_user_email);
					$email_user=$row_user_email['email'];
					if(check_for_vendor_or_not($email_user))
					{
						$sql_get_order_count=mysqli_query($con,"SELECT `order_id` FROM `ord` WHERE `vendor_id`=$vendor_id AND`accept_reject`=0 AND `status`=0");
						$count_order=mysqli_num_rows($sql_get_order_count);
						$ord_count=($count_order==0) ? 0 : $count_order ;
					?>
					<div id="new_pro" class="check_box ven"> <div class="radio"> <label><input type="radio" name="vendor_profile"><i></i>Add new Product</label> </div></div>	
					<div id="outlet_name" class="check_box ven"> <div class="radio"> <label><input type="radio" name="vendor_profile"><i></i>Update outlet name</label> </div></div>
					<div id="outlet_profile" class="check_box ven"> <div class="radio"> <label><input type="radio" name="vendor_profile"><i></i>Update outlet profile</label> </div></div>
					<div id="edit_pro" class="check_box ven"> <div class="radio"> <label><input type="radio" name="vendor_profile"><i></i>Edit product</label> </div></div>	
					<div id="order_details" class="check_box ven "> <div class="radio"> <label><input type="radio" name="vendor_profile"><i></i>Order details (<?php echo $ord_count; ?>)</label> </div></div>	
					<div id="order_history" class="check_box ven "> <div class="radio"> <label><input type="radio" name="vendor_profile"><i></i>Order history</label> </div></div>	
					
					<?php 
					}
					?>
					<input type="submit" value="SEND">
					
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-8 products-right">
			<h5>Update your profile</h5>
			
			
			
			<div class="sort-grid">
				<div class="sorting">
					<h6 id="head_select">Select settings from left...</h6>
					
					<div class="clearfix"></div>
				</div>
				
				<div class="clearfix"></div>
			</div>
			
			<?php 
			if(isset($_POST['add_pro']))
			{
				$p_name=sanitize($_POST['p_name']);
				$mrp=sanitize($_POST['mrp']);
				$cat=sanitize($_POST['cat']);
				$sub_cat1=sanitize($_POST['sub_cat1']);
				$sub_cat2=sanitize($_POST['sub_cat2']);
				$description=sanitize($_POST['description']);
				if(empty($p_name) OR empty($mrp) OR empty($cat) OR empty($sub_cat1) OR empty($sub_cat2) OR empty($description))
				{
					echo '<center><div class="alert alert-danger">All the fields are required...</div></center>';
				}
				else
				{
					$sql_insert_new_pro=mysqli_query($con,"INSERT INTO `product_upload_request` VALUES(NULL,$vendor_id,'$p_name',$mrp,'$cat','$sub_cat1','$sub_cat2','$description','','','','','$date')");
					if($sql_insert_new_pro)
						echo '<center><div class="alert alert-danger">Request has been placed. Please upload another product. We will soon add that in your profile.</div></center>';
					else
						echo mysqli_error($con);
				}
			}
			elseif(isset($_POST['outlet_name']))
			{
				$out_name=sanitize($_POST['outlet_name']);
				$sql_insert_outlet_name=mysqli_query($con,"UPDATE `vendor` SET `outlet_name`='$out_name' WHERE `vendor_id`=$vendor_id");
				if($sql_insert_outlet_name)
					echo '<center><div class="alert alert-danger">Outlet name updated.</div></center>';
			}
			elseif(isset($_POST['outlet_profile']))
			{
				echo '<center><div class="alert alert-danger">Outlet profile updated.</div></center>';
			}
			
			?>	
			
			</br>
			
			
			
			<!--Add new product-->
			<div id="product_upload_form" class="login-right">
				<h3 >Fill all the fields</h3>
				<form method="post" action="">
					<div class="sign-in">
						<h4>Product name :</h4>
						<input name="p_name" type="text" value="Enter the product name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					<div class="sign-in">
						<h4>Product MRP (In INR) :</h4>
						<input name="mrp" type="text" value="Enter the MRP" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
					</div>
					
					
					<div class="sign-in">
						<h4>Category</h4>
						<select id="country1" name="cat" onchange="change_cat(this.value)" class="required sect form-control">
							<option value="">SELECT CATEGORY</option>
							<?php 
							$sql_get_cat_form=mysqli_query($con,"SELECT DISTINCT(`category`) FROM `cat_subcat`");
							while($row_get_cat_form=mysqli_fetch_assoc($sql_get_cat_form))
							{
								$cat=$row_get_cat_form['category'];
								echo '<option value="'.$cat.'" >'.$cat.'</option>';
							}
							?>								
						</select>
					</div>
					</br>
					<div class="sign-in">
						<h4>Sub Category</h4>
						<div id="sub_cat1">
							<select id="country1" onchange="change_country(this.value)" class="frm-field required sect form-control">
								<option >SELECT CATEGORY FIRST</option>
							</select>
						</div>
					</div>
					<div class="sign-in">
						<h4>Description :</h4>
						<input name="description" type="text" value="Enter complete description..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
					</div>
					</br>
					<div style=" border-bottom: thin solid #ff0000;"></div></br>
					<h4>Please Upload 4 images.</h4>
					<h4>Only square size image will be accepted.</h4>
					</br>
					<div class="sign-in">
						<h4>Image 1</h4>
						
						<input name="image1" type="file"  class="btn btn-danger" >
					</div>
					</br>
					<div class="sign-in">
						<h4>Image 2</h4>
						
						<input name="image2" type="file" class="btn btn-danger" >
					</div>
					</br>
					<div class="sign-in">
						<h4>Image 3</h4>
						
						<input name="image3" type="file" class="btn btn-danger" >
					</div>
					</br>
					<div class="sign-in">
						<h4>Image 4</h4>
						
						<input name="image4" type="file" class="btn btn-danger" >
					</div>
					</br>
					<div style="margin-top:10px;" class="sign-in">
						<input type="submit" name="add_pro" value="UPDATE" >
					</div>
				</form>
			</div>
			<!--outlet name-->
			<div id="outlet_name_form" class="login-right">
				<h3>Update your outlet name :</h3>
					<form method="post" action="">
					<div class="sign-in">
						<h4>Outlet name</h4>
						<input name="outlet_name" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					
					
					
					<div style="margin-top:10px;" class="sign-in">
						<input type="submit" value="UPDATE" >
					</div>
				</form>
			</div>
			<!--outlet profile-->
			<div id="outlet_profile_form" class="login-right">
				<h3>Update your outlet profile :</h3>
					<form method="post" action="">
					<div class="sign-in">
						<h4>Choose and square size image</h4></br>
						<input name="outlet_profile" type="file" class="btn btn-danger" required="">	
					</div>
					
					
					
					<div style="margin-top:10px;" class="sign-in">
						<input type="submit" value="UPDATE" >
					</div>
				</form>
			</div>
			
			
			<!--edit product-->
			<div style="width:100%" id="edit_product_form" class="login-right">
				<div class="container">
					<h3>Select the product you want to edit</h3>
				</div>
				<div class="table" data-wow-delay=".5s">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Product name</th>
								<th>Image</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$sql_vendor_id=mysqli_query($con,"SELECT `vendor_id` FROM `vendor` WHERE `email`=(SELECT `email` FROM `user` WHERE `user_id`=$user_id)");
						$row_vendor_id=mysqli_fetch_array($sql_vendor_id);
						$vendor_id=$row_vendor_id['vendor_id'];
						$sql_get_pro_edit=mysqli_query($con,"SELECT `p_id`,`name` FROM `product` WHERE `uploader`=$vendor_id");
						while($row_get_pro_edit=mysqli_fetch_assoc($sql_get_pro_edit))
						{
							$name=$row_get_pro_edit['name'];
							$p_id=base64_encode($row_get_pro_edit['p_id']);
							?>
							<tr class="rem1">
								<td class="invert"><?php echo $name;?></td>
								<td class="invert-image"><a href="single.php?value=<?php echo $link_id; ?>"><img src="images/productimage.PNG" alt=" " class="img-responsive" /></a></td>
								<td class="invert"><a href=""><a href="edit.php?product=<?php echo $p_id; ?>"><button class="btn btn-danger">Edit</button></a></td>
							</tr>
							<?php
						}
						?>
							
					
						</tbody>				
					</table>
				</div>
						
			</div>
			<!--order details-->
			<div id="order_details_form" class="login-right">
				<?php 
				if($ord_count==0)
				{
					echo '<h3>No new order to display';
				}
				else
				{
					
					echo '<h3>'.$ord_count;
					echo ' ';
					echo ($ord_count==1) ? 'Order' : 'Orders';
					echo '</h3>';
					?>
					<div class="bs-docs-example">
						<table class="table table-striped">
							<thead>
								<tr>
								  <th>Order ID</th>
								  <th>Buyer email</th>
								  <th>Product name</th>
								  <th>Quantity</th>
								  <th>Details</th>
								</tr>
							</thead>
							<tbody>
					<?php 		
					$sql_get_order=mysqli_query($con,"SELECT * FROM `ord` WHERE `vendor_id`=$vendor_id AND`accept_reject`=0 AND `status`=0");
					while($row_get_order=mysqli_fetch_assoc($sql_get_order))
					{
						$order_id=$row_get_order['order_id'];
						$user_id_id=$row_get_order['user_id'];
						$p_id=$row_get_order['p_id'];
						$quantity=$row_get_order['amount'];
						
						$sql_get_p_name=mysqli_query($con,"SELECT `name` FROM `product` WHERE `p_id`=$p_id");
						$row_get_p_name=mysqli_fetch_array($sql_get_p_name);
						$p_name=$row_get_p_name['name'];
						
						
						$email=get_email($user_id_id);
						
						?>
						<tr>
							<td><?php echo $p_id;?></td>
							<td><?php echo $email;?></td>
							<td><?php echo $p_name;?></td>
							<td><?php echo $quantity;?></td>
							<td><a href="order-details.php?order=<?php echo base64_encode($order_id);?>"><button class="btn btn-danger">Details</button></a></td>
						</tr>
						<?php 
						
					}
					?>
					
					</tbody>
            </table>
          </div><?php 
					
				}
				?>
				
			</div>
			<!--order history-->
			<div id="order_history_form" class="login-right">
				<h3>Order history :</h3>
				
			</div>
			
			
		</div>	
	</div>
</div>	
<!-- //mens -->
<!-- //product-nav -->

<script>

function change_cat(cat)
{
        if(cat){
            $.ajax({
                type:'POST',
                url:'process/sub_cat1.php',
                data:'cat='+cat,
                success:function(html){
                    $('#sub_cat1').html(html);
                }
            }); 
        }else{
            $('#sub_cat1').html('<option value="">Select category first</option>'); 
        }
 }

$("#order_history").click(function(){
	window.location.href="order-details.php?type=history";
});

$("#product_upload_form").show();
$("#outlet_name_form").hide();
$("#outlet_profile_form").hide();
$("#edit_product_form").hide();
$("#order_details_form").hide();
$("#order_history_form").hide();

$("#new_pro").click(function(){
	$("#product_upload_form").show();
	$("#outlet_name_form").hide();
	$("#outlet_profile_form").hide();
	$("#edit_product_form").hide();
	$("#order_details_form").hide();
	$("#order_history_form").hide();
});
$("#outlet_name").click(function(){
	$("#product_upload_form").hide();
	$("#outlet_name_form").show();
	$("#outlet_profile_form").hide();
	$("#edit_product_form").hide();
	$("#order_details_form").hide();
	$("#order_history_form").hide();
});
$("#outlet_profile").click(function(){
	$("#product_upload_form").hide();
	$("#outlet_name_form").hide();
	$("#outlet_profile_form").show();
	$("#edit_product_form").hide();
	$("#order_details_form").hide();
	$("#order_history_form").hide();
});
$("#edit_pro").click(function(){
	$("#product_upload_form").hide();
	$("#outlet_name_form").hide();
	$("#outlet_profile_form").hide();
	$("#edit_product_form").show();
	$("#order_details_form").hide();
	$("#order_history_form").hide();
});
$("#order_details").click(function(){
	$("#product_upload_form").hide();
	$("#outlet_name_form").hide();
	$("#outlet_profile_form").hide();
	$("#edit_product_form").hide();
	$("#order_details_form").show();
	$("#order_history_form").hide();
});
$("#order_history").click(function(){
	$("#product_upload_form").hide();
	$("#outlet_name_form").hide();
	$("#outlet_profile_form").hide();
	$("#edit_product_form").hide();
	$("#order_details_form").hide();
	$("#order_history_form").show();
});

</script>

<?php 
include('include/purchase_des.php');
include('include/footer.php');
include('include/loginInclude.php');
?>

</body>
</html>
