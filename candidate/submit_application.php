<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$userid = $_SESSION['userid'];
$jobid = $_POST['jobid'];
$apply_ans1 = $_POST['apply_ans1'];
$apply_ans2 = $_POST['apply_ans2'];
$apply_job = $db->apply_job($userid,$jobid,$apply_ans1,$apply_ans2);
if($apply_job)
{
	echo "Records Successfully Added";
}
else
{
	echo "Error! Try Again";
}
?>