<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];

$job_title = $_POST['job_title'];
$job_type = $_POST['job_type'];
$expiry_date = @date('Y-m-d', strtotime($_POST["expiry_date"]));
$job_category = $_POST['job_category'];
$job_designation = $_POST['job_designation'];
$job_salary = $_POST['job_salary'];
$job_experience = $_POST['job_experience'];
$job_qualification = $_POST['job_qualification'];
$job_vacancy = $_POST['job_vacancy'];
$job_location = $_POST['job_location'];
$job_eligibility = $_POST['job_eligibility'];
$job_gender = $_POST['job_gender'];
$job_desc = $_POST['job_desc'];
$job_perks = $_POST['job_perks'];
$job_musthave = $_POST['job_musthave'];
$job_qts1 = $_POST['job_qts1'];
$job_qts2 = $_POST['job_qts2'];
$job_skillstring = $_POST['job_skillstring'];
$jobid_for_update = $_POST['jobid_for_update'];

$update_jobposts = $db->update_jobposts($userid,$jobid_for_update,$job_title,$job_type,$expiry_date,$job_category,$job_designation,$job_salary,$job_experience,$job_qualification,$job_vacancy,$job_location,$job_eligibility,$job_gender,$job_desc,$job_perks,$job_musthave,$job_qts1,$job_qts2,$job_skillstring);
if($update_jobposts)
{
	echo "Records Successfully Updated";
}
else
{
	echo "Error! Try Again";
}
?>