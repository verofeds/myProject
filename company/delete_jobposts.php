<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];

$jobid = $_POST['jobid'];

$delete_jobposts = $db->delete_jobposts($userid,$jobid);
if($delete_jobposts)
{
	echo "Post Deleted Successfully";
}
else
{
	echo "Error! Try Again";
}
?>