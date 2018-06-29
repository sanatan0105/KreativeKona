<?php 
include ('php/connect.php');
include('php/functions.php');
include('include/header.php');
include('include/headerB4Login.php');
include('include/top_menu.php');
$user_id=$_COOKIE['user_id'];
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
					<form>
					<div id="addr" class="check_box"> <div class="radio"> <label><input type="radio" name="address" checked=""><i></i>Address</label> </div></div>
					<div id="email" class="check_box"> <div class="radio"> <label><input type="radio" name="email"><i></i>Email</label> </div></div>	
					<div id="con_num" class="check_box"> <div class="radio"> <label><input type="radio" name="con_num"><i></i>Contact Number</label> </div></div>
					<div id="order_history" class="check_box"> <div class="radio"> <label><input type="radio" name="order_history"><i></i>Order History</label> </div></div>	
					<div id="logout" class="check_box"> <div class="radio"> <label><input type="radio" name="logout"><i></i>Logout</label> </div></div>		
					<div style="border-width:2px;border-bottom-style:inset;"></div>
					<?php 
					$sql_user_email=mysqli_query($con,"SELECT `email` FROM `user` WHERE `user_id`=$user_id");
					$row_user_email=mysqli_fetch_array($sql_user_email);
					$email_user=$row_user_email['email'];
					if(check_for_vendor_or_not($email_user))
					{
					?>
					
					<div id="vendor_profile" class="check_box"> <div class="radio"> <label><input type="radio" name="vendor_profile"><i></i>Vendor Profile</label> </div></div>
						
					
					<?php 
					}
					?>
					<input type="submit" value="SEND">
					</form>
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
			
				if(isset($_POST))
				{
					if(isset($_POST['ad1']))
					{
						$ad1=sanitize($_POST['ad1']);
						$ad2=sanitize($_POST['ad2']);
						$zip=sanitize($_POST['zip']);
						$city=sanitize($_POST['city']);
						$state=sanitize($_POST['state']);
						if(empty($ad1) OR empty($ad2) OR empty($zip) OR empty($city) OR empty($state))
						{
							echo 'All the fields are required...';
						}
						$sql_insert_address=mysqli_query($con,"UPDATE `user` SET `ad1`='$ad1', `ad2`='$ad2', `zip`=$zip,`city`='$city',`state`='$state' WHERE `user_id`=$user_id");
						if($sql_insert_address)
						{
							echo 'Address Updated.';
						}
						else
						{
							echo 1;
						}
						
					}
					elseif(isset($_POST['update_email']))
					{
						$email=sanitize($_POST['update_email']);
						if(empty($email))
							array_push($error,'Please fill the email field.');
						else
						{
							$sql_update_email=mysqli_query($con,"UPDATE `user` SET `email`='$email' WHERE `user_id`=$user_id");
							if($sql_update_email)
							{
								echo 'Email Updated.';
							}
							else
							{
								echo 2;
							}
						}
						
					}
					elseif(isset($_POST['con_num']))
					{
						$con_num=sanitize($_POST['con_num']);
						if(empty($con_num))
							echo 'Please fill the email field.';
						else
						{
							$sql_update_email=mysqli_query($con,"UPDATE `user` SET `con_num`='$con_num' WHERE `user_id`=$user_id");
							if($sql_update_email)
							{
								echo 'Contact number Updated.';
							}
							else
							{
								echo 3;
							}
						}
					}
					elseif(isset($_POST['logout']))
					{
						?>
						<script>
						window.location.href='process/logout.php';
						</script>
						<?php
					}
				}
				


				?>
			
			</br></br>
			<div id="address_form" class="login-right">
				<h3 >Fill all the required fields...</h3>
				<form method="post" action="">
					<div class="sign-in">
						<h4>Address Line1: Street address, P.O. box, company name, c/o</h4>
						<input name="ad1" type="text" value="Address Line1" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					<div class="sign-in">
						<h4>Address Line2: Apartment, suite , unit, building, floor, etc</h4>
						<input name="ad2" type="text" value="Address Line2" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
					</div>
					
					<div class="sign-in">
						<h4>Zip/Postal code</h4>
						<input name="zip" type="text" value="Zip/Postal Code" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
					</div>
					<div class="sign-in">
						<h4>City</h4>
						<input name="city" type="text" value="City" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
					</div>
					<div class="sign-in">
						<h4>State</h4>
						<input name="state" type="text" value="state" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
					</div>
					
					<div style="margin-top:10px;" class="sign-in">
						<input type="submit" name="addr" value="SIGNIN" >
					</div>
				</form>
			</div>
			<div id="email_form" class="login-right">
				<h3>Update Your Email</h3>
					<form method="post" action="">
					<div class="sign-in">
						<h4>Email :</h4>
						<input name="update_email" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					
					
					
					<div style="margin-top:10px;" class="sign-in">
						<input type="submit" value="SIGNIN" >
					</div>
				</form>
			</div>
			<div id="con_num_form" class="login-right">
				<h3>Update your contact number :</h3>
					<form method="post" action="">
					<div class="sign-in">
						<h4>Contact number</h4>
						<input name="con_num" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					
					
					
					<div style="margin-top:10px;" class="sign-in">
						<input type="submit" value="UPDATE" >
					</div>
				</form>
			</div>
			<div id="order_history_form" class="login-right">
				<h3>You haven't purchased any product till now...</h3>
					<div class="bs-docs-example">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>
				
			</div>
			<div id="logout_form" class="login-right">
				<h3>Are you sure you want to logout from your account?</h3>
					<form method="post" action="">
					
					
					
					<div style="margin-top:10px;" class="sign-in">
						<input type="submit" name="logout" value="LOGOUT" >
					</div>
				</form>
			</div>

			
			
		</div>	
	</div>
</div>	
<!-- //mens -->
<!-- //product-nav -->
<?php 
include('include/purchase_des.php');
include('include/footer.php');
include('include/loginInclude.php');
?>

</body>
</html>
