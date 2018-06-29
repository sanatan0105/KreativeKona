<?php 
include ('php/connect.php');
include('php/functions.php');
include('include/header.php');

include('include/headerB4Login.php');

include('include/top_menu.php');
$user_id=$_COOKIE['user_id'];
$date=datefunction();

$sql_get_vendor_id=mysqli_query($con,"SELECT `vendor_id` FROM `vendor` WHERE `email`=(SELECT `email` FROM `user` WHERE `user_id`=$user_id)");
if(mysqli_num_rows($sql_get_vendor_id)==0)
{
	echo 'Wrong entry...';
}
else
{
	$row_vendor_id=mysqli_fetch_assoc($sql_get_vendor_id);
	$vendor_id=$row_vendor_id['vendor_id'];
	if($_GET)
	{
		$p_id=sanitize(base64_decode($_GET['product']));
		$sql_get_product_details=mysqli_query($con,"SELECT `p_id`,`uploader` FROM `product` WHERE `p_id`=$p_id");
		$row_get_product_details=mysqli_fetch_assoc($sql_get_product_details);
		$uploader_id=$row_get_product_details['uploader'];
		if(mysqli_num_rows($sql_get_product_details)==0)
		{
			echo 'Sorry wrong product value...';
		}
		elseif($uploader_id!=$vendor_id)
		{
			echo 'You can edit only your product...';
		}
		else
		{
			$sql_get_pro=mysqli_query($con,"SELECT * FROM `product` WHERE `p_id`=$p_id");
			$row_get_pro=mysqli_fetch_assoc($sql_get_pro);
			$name=$row_get_pro['name'];
			$cat=$row_get_pro['cat'];
			$subcat=$row_get_pro['subcat'];
			$sub_cat2=$row_get_pro['sub_cat2'];
			$mrp=$row_get_pro['mrp'];
			$descr=$row_get_pro['descr'];
			?>
			<div class="col-md-3"></div>
			<center>
				<div class="login-grids">
					<div class="login">
						<div class="login-bottom">
						</br>
							<?php 
							if($_POST)
							{
								$p_name=sanitize($_POST['p_name']);
								$p_mrp=sanitize($_POST['mrp']);
								$p_cat=sanitize($_POST['cat']);
								$p_subcat=sanitize($_POST['sub_cat1']);
								$p_sub_cat2=sanitize($_POST['sub_cat2']);
								$p_mrp=sanitize($_POST['mrp']);
								$p_descr=sanitize($_POST['description']);
								
								if(empty($p_name) || empty($p_mrp) || empty($p_cat) || empty($p_subcat)  || empty($p_mrp) || empty($p_descr) )
								{
									echo 'all the fields are required';
								}
								else
								{
									$sql_insert_request=mysqli_query($con,"INSERT INTO `p_edit_request` VALUES (NULL,$vendor_id,$p_id,'$p_name',$p_mrp,'$p_cat','$p_subcat','$p_sub_cat2','$p_descr','$date')");
									if($sql_insert_request)
										echo '<h3>A request has been placed. We will come back to you soon...</h3>
										<h4><a href="vendor-profile.php">Go back to your profile?</a></h4>';
									else
										echo '<h3>We are facing some technical isseues...Please try after sometime...</h3>';
								}
							}
							?>
							</br>
							<form method="post" action="">
								<div class="sign-in">
									<h4>Product name : (<?php echo $name; ?>)</h4>
									<input name="p_name" type="text" value="<?php echo $name;?>" required="">	
								</div>
								<div class="sign-in">
									<h4>Product MRP (In INR) : (<?php echo $mrp; ?>)</h4>
									<input name="mrp" type="text" value="<?php echo $mrp?>" required="">
								</div>
					
					
								<div class="sign-in">
									<h4>Category : (<?php echo $cat;?>) </h4>
									<select value="<?php echo $cat; ?>" id="country1" name="cat" onchange="change_cat(this.value)" class="required sect form-control">
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
									<h4>Sub Category : (<?php echo $subcat;?>)</h4>
									<div id="sub_cat1">
										<select value="<?php echo $subcat; ?>"  id="country1" onchange="change_country(this.value)" class="frm-field required sect form-control">
											<option >SELECT CATEGORY FIRST</option>
										</select>
									</div>
								</div>
								<div class="sign-in">
									<h4>Description : </h4>
									<input name="description" type="text" value="<?php echo $descr; ?>" required="">
								</div>
								</br>
								<div style=" border-bottom: thin solid #ff0000;"></div></br>
								
								<div style="margin-top:10px;" class="sign-in">
									<input type="submit" name="add_pro" value="UPDATE" >
								</div>
							</form>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<p></p>
				</div>
			</center>
			</br></br>
			
			
			
			
			
			<?php 
		}
	}
	else
	{
		echo 'Please select a product first...';
	}
}
?>	
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
</script>

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