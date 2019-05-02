<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];

$comp_name = $_POST['comp_name'];
$comp_email = $_POST['comp_email'];
$comp_pname = $_POST['comp_pname'];
$comp_phone = $_POST['comp_phone'];
$comp_pname_no = $_POST['comp_pname_no'];
$comp_category = $_POST['comp_category'];
$google_link = $_POST['google_link'];
$linked_link = $_POST['linked_link'];
$twitter_link = $_POST['twitter_link'];
$facebook_link = $_POST['facebook_link'];
$about_comp = $_POST['about_comp'];
$estab_since = $_POST['estab_since'];
$team_size = $_POST['team_size'];


$update_comp_details = $db->update_comp_details($userid,$comp_name,$comp_email,$comp_pname,$comp_phone,$comp_pname_no,$comp_category,$google_link,$linked_link,$twitter_link,$facebook_link,$about_comp,$estab_since,$team_size);
if($update_comp_details)
{
	echo "Records Successfully Updated";
}
else
{
	echo "Error! Try Again";
}
?>