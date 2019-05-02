<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];
$confirm_password = $_POST['confirm_password'];

$escapedpwd = mysqli_real_escape_string($db->db,$confirm_password);
$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$saltedpwd =  $escapedpwd . $salt;
$hashedpwd = hash('sha256', $saltedpwd);
date_default_timezone_set('Asia/Kolkata');

$update_password_comp = $db->update_password_comp($login,$userid,$salt,$hashedpwd);
if($update_password_comp)
{
	echo "Password Successfully Updated";
}
else
{
	echo "Error! Try Again";
}
?>