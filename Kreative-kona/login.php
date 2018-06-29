<?php 
include ('php/connect.php');
include('php/functions.php');

if(isset($_POST))
{
	$login_pass=sanitize($_POST['login_pass']);
	$login_email=sanitize($_POST['login_email']);
	
	$sql_email_check=mysqli_query($con,"SELECT `user_id`,`password` FROM `user` WHERE `email`='$login_email'");
	$count=mysqli_num_rows($sql_email_check);
	$row=mysqli_fetch_assoc($sql_email_check);
	$user_id=$row['user_id'];
	$password=$row['password'];
	
	if(empty($login_email) OR empty($login_pass))
	{
		echo 'Both the fields are required...';
	}
	elseif($count==0)
	{
		echo 'We are not able to find that email... Please create an account.';
	}
	elseif($login_pass!=$password)
	{
		echo 'Incorrect password';
	}
	else
	{
		setcookie("user_id", $user_id, time() + 31556926, "/"); 
		?>
		<script>
		window.location.href='../index.php';
		</script>
		<?php
	}
	
		
	
}


?>
