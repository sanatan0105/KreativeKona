<?php 
include ('../php/connect.php');
include('../php/functions.php');
$date=datefunction();
if(isset($_POST))
{
	$p_id=sanitize($_POST['p_id']);
	if(isset($_COOKIE['user_id']))
	{
		$user_id=$_COOKIE['user_id'];
		$sql_insert_into_cart=mysqli_query($con,"INSERT INTO `cart` VALUES (NULL,$user_id,$p_id,'$date',0)");
		if($sql_insert_into_cart)
		{
			echo 'Added';
		}
	}
	else
	{
		if(isset($_COOKIE['random_user_code']))
		{
			$user_code=$_COOKIE['random_user_code'];
			$sql_get_code_id=mysqli_query($con,"SELECT `random_user_id` FROM `random_code_user` WHERE `random_number`='$user_code'");
			$row_code_id=mysqli_fetch_array($sql_get_code_id);
			$code_id=$row_code_id['random_user_id`'];
			
			$sql_insert_in_cart=mysqli_query($con,"INSERT INTO `cart_without_login` VALUES (NULL, $code_id, '$date',$p_id,0)");
			if($sql_insert_in_cart)
				echo 'Added';
		}
		else
		{
			$cou_check=1;
			while($cou_check==1)
			{
				$random_cart_number=generateRandomString(6);
				$sql_check_number=mysqli_query($con,"SELECT `random_user_id` FROM `random_code_user` WHERE `random_number`='$random_cart_number'");
				$cou_check=mysqli_num_rows($sql_check_number);
				if($cou_check==0)
				{
					$final_number=$random_cart_number;
				}
				else
				{
					$cou_check==0;
				}
			}
			$user_code=$final_number;
			
			setcookie('random_user_code', $user_code, time() + 31556926, "/");
			$sql_insert_code=mysqli_query($con,"INSERT INTO `random_code_user` VALUES (NULL,'$user_code','$date','Chrome')");
			
			$last_inserted_id=mysqli_insert_id($con); 
			$sql_insert_in_cart=mysqli_query($con,"INSERT INTO `cart_without_login` VALUES (NULL, $last_inserted_id, '$date',$p_id,0)");
			if($sql_insert_code AND $sql_insert_in_cart)
				echo 'Added';
			
		}
	}
}
else
{
	echo 'Wrong page entry...';
}

?>