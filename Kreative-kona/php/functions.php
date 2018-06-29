<?php
function datefunction()
{
 return $date = date("F j, Y, g:i a");
}

function generateRandomString($length) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}




function user_data($user_id){
	$data = array();
	$user_id= (int)$user_id;
	$func_num_args = func_num_args();
	$func_get_arg = func_get_args();
	if($func_num_args >1){
		unset($func_get_arg[0]);
		
		$fields = '`' . implode ('`, `',$func_get_arg). '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id"));
		return $data;  
	}
}
function logged_in(){
	return(isset($_COOKIE['user_id'])) ? true : false;
}
function sanitize($data){
	return mysql_real_escape_string(trim($data));
}
function user_exists($username){
	$username = sanitize($username);
	
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'");
	return(mysql_result($query , 0)==1) ? true : false;
}




function getaddress($lat,$lng)
{
$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
$json = @file_get_contents($url);
$data=json_decode($json);
$status = $data->status;
if($status=="OK")
return $data->results[0]->formatted_address;
else
return false;
}	
function getName($id)
{
global $con;
$id=sanitize($id);
$sql_name=mysqli_query($con,"SELECT `name` FROM `users` WHERE `user_id`=$id");
$name_ary=mysqli_fetch_assoc($sql_name);
return $name=$name_ary['name'];
}











function isandroid()
{
$ua=strtolower($_SERVER['HTTP_USER_AGENT']);
return $result=(stripos($ua,'android') == true) ? true : false;
}







function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    elseif (preg_match('/android|win32/i', $u_agent)) {
        $platform = 'android';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    }
    elseif(preg_match('/OPR/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}
function email_validate($email)
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		return true;
	} else {
		return false;
	}
}


function email_exixts($email)
{
	global $con;
	$sql=mysqli_query($con,"SELECT `user_id` FROM `user` WHERE `email`='$email'");
	$sql_count=mysqli_num_rows($sql);
	if($sql_count==0)
	{
		return false;
	}
	else
	{
		return true;
	}
}
function email_v_exists($email)
{
	global $con;
	$sql=mysqli_query($con,"SELECT `vendor_id` FROM `vendor` WHERE `email`='$email'");
	$sql_count=mysqli_num_rows($sql);
	if($sql_count==0)
	{
		return false;
	}
	else
	{
		return true;
	}	
}
 
function check_for_vendor_or_not($email)
{
	global $con;
	$sql=mysqli_query($con,"SELECT `vendor_id` FROM `vendor` WHERE `email`='$email'");
	$count=mysqli_num_rows($sql);
	if($count==1)
		return true;
	else
	
return false;
}

function get_email($id)
{
	global $con;
	$sql=mysqli_query($con,"SELECT `email` FROM `user` WHERE `user_id`=$id");
	$row=mysqli_fetch_array($sql);
	return $email=$row['email'];
} 
?>