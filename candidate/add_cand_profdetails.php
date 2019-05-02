<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];

$cand_new_pass = $_POST['cand_new_pass'];
$cand_confirm_pass = $_POST['cand_confirm_pass'];
$cand_first_name = $_POST['cand_first_name'];
$cand_last_name = $_POST['cand_last_name'];
$cand_mobile = $_POST['cand_mobile'];
$update_password_comp = 0;

$update_cand_details = $db->update_cand_details($userid,$cand_first_name,$cand_last_name,$cand_mobile);

if($cand_new_pass != "" && $cand_confirm_pass != "")
{
	$escapedpwd = mysqli_real_escape_string($db->db,$cand_confirm_pass);
	$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	$saltedpwd =  $escapedpwd . $salt;
	$hashedpwd = hash('sha256', $saltedpwd);
	date_default_timezone_set('Asia/Kolkata');

	$update_password_comp = $db->update_password_comp($login,$userid,$salt,$hashedpwd);
}
if($update_password_comp == 1 and $update_cand_details == 1)
{
	echo "Records and Password Successfully Updated";
}
else if($update_cand_details)
{
	echo "Records Successfully Updated";
}
else
{
	echo "Error! Try Again";
}
?>