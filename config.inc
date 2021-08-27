<?php 
//error_reporting(0);
date_default_timezone_set('Asia/Calcutta');
$site = "http://dekodenate.com";
$mail = "support@kryptonix.tk"; 
$username = "u249508664_kxinc";	
$password = "warmachine68"; 
$database = "u249508664_kxinc"; 
$hostname = "mysql.hostinger.in"; 	
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");

$selected = mysql_select_db($database,$dbhandle) 
  or die("Could not select examples");

$dbc = @mysqli_connect($hostname, $username, $password, $database);

if(isset($_SESSION['Username']))
{
$un = $_SESSION['Username'];

$query = "SELECT * FROM members WHERE Username = '$un'"; 
	 
$result = mysql_query($query) or die(mysql_error());

$user = mysql_fetch_array($result) or die(mysql_error());
}
function validate($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
function encrypt($pass){
	$pass = md5($pass);
	$pass = sha1($pass);
	return $pass;
}

?>