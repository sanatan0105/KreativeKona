<?php 
include ('php/connect.php');
include('php/functions.php');
include('include/header.php');

include('include/headerB4Login.php');

include('include/top_menu.php');
 
if(isset($_POST['email']) AND isset($_POST['type']))
{
	$email=sanitize($_POST['email']);
	$type=sanitize($_POST['type']);
	$sql_insert=mysqli_query($con,"INSERT INTO `email_and_type` VALUES (NULL, '$email','$type')");
	if($type=='user')
	{
		?>
		</br></br>
<div class="col-md-3"></div>
<center>
	<div class="login-grids">
		<div class="login">
			<div class="login-bottom">
			
				<h3>Welcome <?php echo $email; ?></h3>
				<h4>Please choose a unique password</h4>
				<form method="post" action="">
					<div class="sign-up">
						<h4>Password :</h4>
						<input name="pass" type="password" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					<input type="hidden" name="email1" value="<?php echo $email;?>">
					<input type="hidden" name="type1" value="<?php echo $type; ?>">
					<div class="sign-up">
						<h4>Re-Password :</h4>
						<input name="re_pass" type="password" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>	
					</br>
					<div style="margin-top:10px;" class="sign-up">
						<input type="submit" value="REGISTER NOW" >
					</div>
				</form>
			</div>
			
			<div class="clearfix"></div>
		</div>
		<p>By regestring you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>
	</div>
</center>
</br></br>		
		<?php
	}
	elseif($type=='vendor')
	{
			?>
		</br></br>
<div class="col-md-3"></div>
<center>
	<div class="login-grids">
		<div class="login">
			<div class="login-bottom">
			
				<h3>Welcome <?php echo $email; ?></h3>
				<h4>Please fill the required details...</h4>
				<form method="post" action="">
					<div class="sign-up">
						<h4>Full Name :</h4>
						<input name="name_v" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					<input type="hidden" name="email_v" value="<?php echo $email;?>">
					<div class="sign-up">
						<h4>Password :</h4>
						<input name="pass_v" type="password" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					<div class="sign-up">
						<h4>Re-Password :</h4>
						<input name="re_pass_v" type="password" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					<div class="sign-up">
						<h4>Contact Number</h4>
						<input name="con_v" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					<div class="sign-up">
						<h4>Link of the website (If any). (http://www.example.com/)</h4>
						<input name="web_v" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					
					<div class="sign-up">
						<h4>Write somthing about you...</h4>
						<input name="about_v" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
					</div>
					</br>
					<div style="margin-top:10px;" class="sign-up">
						<input type="submit" value="REGISTER NOW" >
					</div>
				</form>
			</div>
			
			<div class="clearfix"></div>
		</div>
		<p>By regestring you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>
	</div>
</center>
</br></br>		
		<?php
	}
	
	
	?>
	

	<?php 
}
elseif(isset($_POST['name_v']))
{
	echo '</br></br></br>';
	$email_v=sanitize($_POST['email_v']);
	$name_v=sanitize($_POST['name_v']);
	$password_v=sanitize($_POST['pass_v']);
	$repass_v=sanitize($_POST['re_pass_v']);
	$con_v=sanitize($_POST['con_v']);
	$web_v=sanitize($_POST['web_v']);
	$about_v=sanitize($_POST['about_v']);
	$date=datefunction();
	if(empty($email_v)==true OR empty($name_v)==true OR empty($password_v)==true OR empty($repass_v)==true OR empty($con_v)==true OR empty($about_v)==true)
	{
		echo '<div class="container-fluid"><div class="alert alert-danger"><center><strong>Fill the required fields...<strong></center></div></div>';
	}
	elseif(email_v_exists($email_v))
	{
		echo '<div class="container-fluid"><div class="alert alert-danger"><center><strong>Email already taken...If you are an existing vendor please login insted...<strong></center></div></div>';
	}
	elseif($password_v!=$repass_v)
	{
		echo '<div class="container-fluid"><div class="alert alert-danger"><center><strong>Password and repassword should match...<strong></center></div></div>';
	}
	elseif(strlen($con_v)!=10)
	{
		echo '<div class="container-fluid"><div class="alert alert-danger"><center><strong>Invalid contact number...<strong></center></div></div>';
	}
	
	else
	{
		$sql_reg_as_user=mysqli_query($con,"INSERT INTO `user` (`user_id`,`password`,`con_num`,`email`,`doj`) VALUES (NULL,'$password_v','$con_v','$email_v','$date')");
		$sql_reg=mysqli_query($con,"INSERT INTO `vendor` (`vendor_id`,`name`,`con_num`,`website`,`email`,`password`,`about_you`,`doj`) VALUES (NULL,'$name_v','$con_v','$web_v','$email_v','$password_v','$about_v','$date')");
		if($sql_reg)
		{
			echo '<div class="container-fluid"><div class="alert alert-success"><center><strong>Registered sucessufully...<strong></center></div></div>';
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
elseif(isset($_POST['pass']))
{
	echo '</br></br></br>';
	$email1=sanitize($_POST['email1']);
	$type1=sanitize($_POST['type1']);
	$password=sanitize($_POST['pass']);
	$re_pass=sanitize($_POST['re_pass']);
	if(email_validate($email1)==false)
	{
		echo '<div class="container-fluid"><div class="alert alert-danger"><center><strong>Wrong email...<strong></center></div></div>';
	}
	elseif($password!=$re_pass)
	{
		echo '<div class="container-fluid"><div class="alert alert-danger"><center><strong>Password and re-password does\'t match... <strong></center></div></div>';
	}
	elseif(email_exixts($email1))
	{
		echo '<div class="container-fluid"><div class="alert alert-danger"><center><strong>Email already taken...Login insted.<strong></center></div></div>';
	}
	elseif($password=='')
	{
		echo '<div class="container-fluid"><div class="alert alert-danger"><center><strong>Enter the password...<strong></center></div></div>';
	}
	else
	{
		$date=datefunction();
		$sql_register=mysqli_query($con,"INSERT INTO `user` (`user_id`,`email`,`password`,`doj`) VALUES (NULL,'$email1','$password','$date')");
		echo '<div class="container-fluid"><div class="alert alert-success"><center><strong>Successfully registered...<strong></center></div></div>';
	}
}
else
{
	echo 'email and type both are required...';
}

?>


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