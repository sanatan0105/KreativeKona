<?php
include('../php/functions.php');
setcookie("user_id","",time()-3600);

unset($_COOKIE['user_id']);
if(isset($_COOKIE['user_id']))
	echo 'error';
else
	echo 'Ok';

if(logged_in()==true)
	echo 'Logged_in';
else
	echo 'Logged_out';
?>