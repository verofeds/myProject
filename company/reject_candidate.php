<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$userid = $_SESSION['userid'];

$jobid = $_POST['jobid'];
$cand_userid = $_POST['cand_userid'];

$reject_candidate = $db->reject_candidate($cand_userid,$jobid);
if($reject_candidate)
{
	echo "Candidate Rejected";
}
else
{
	echo "Error! Try Again";
}
?>