<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];
$school = 0;
$high_school = 0;
$graduation = 0;
$post_graduation = 0;
$resume_first_name = $_POST['resume_first_name'];
$resume_last_name = $_POST['resume_last_name'];
$date_ofbirth = @date('Y-m-d', strtotime($_POST["date_ofbirth"]));
$resume_gender = $_POST['resume_gender'];
$resume_city = $_POST['resume_city'];
$resume_state = $_POST['resume_state'];
$resume_email = $_POST['resume_email'];
$resume_mobile = $_POST['resume_mobile'];
$resume_pincode = $_POST['resume_pincode'];
$resume_pan = $_POST['resume_pan'];
$resume_aadhar = $_POST['resume_aadhar'];
$resume_address = $_POST['resume_address'];

$resume_school = $_POST['resume_school'];
$resume_board = $_POST['resume_board'];
$resume_school_year = $_POST['resume_school_year'];
$school_marks = $_POST['school_marks'];
$resume_college = $_POST['resume_college'];
$resume_college_stream = $_POST['resume_college_stream'];
$resume_college_year = $_POST['resume_college_year'];
$resume_college_marks = $_POST['resume_college_marks'];
$resume_degree_name = $_POST['resume_degree_name'];
$resume_degree_stream = $_POST['resume_degree_stream'];
$resume_degree_year = $_POST['resume_degree_year'];
$resume_degree_marks = $_POST['resume_degree_marks'];
$resume_pg_name = $_POST['resume_pg_name'];
$resume_pg_stream = $_POST['resume_pg_stream'];
$resume_pg_year = $_POST['resume_pg_year'];
$resume_pg_marks = $_POST['resume_pg_marks'];

$resume_org_name = $_POST['resume_org_name'];
$resume_job_description = $_POST['resume_job_description'];
$resume_start_date = @date('Y-m-d', strtotime($_POST['resume_start_date']));
$resume_end_date = @date('Y-m-d', strtotime($_POST['resume_end_date']));
$resume_job_exp = $_POST['resume_job_exp'];
$resume_job_profile = $_POST['resume_job_profile'];
$resume_job_designation = $_POST['resume_job_designation'];
$resume_worksamp = $_POST['resume_worksamp'];
$resume_job_type = $_POST['resume_job_type'];
$resume_job_location = $_POST['resume_job_location'];
$job_skillstring = $_POST['job_skillstring'];

if($resume_school)
{
	$school = 1;
}
if($resume_college)
{
	$high_school = 1;
}
if($resume_degree_name)
{
	$graduation = 1;
}
if($resume_pg_name)
{
	$post_graduation = 1;
}

$add_resumedetails = $db->add_resumedetails($userid,$resume_first_name,$resume_last_name,$date_ofbirth,$resume_gender,$resume_city,$resume_state,$resume_email,$resume_mobile,$resume_pincode,$resume_pan,$resume_aadhar,$resume_address,$resume_school,$resume_board,$resume_school_year,$school_marks,$resume_college,$resume_college_stream,$resume_college_year,$resume_college_marks,$resume_degree_stream,$resume_degree_year,$resume_degree_marks,$resume_pg_name,$resume_pg_stream,$resume_pg_year,$resume_pg_marks,$resume_org_name,$resume_job_description,$resume_job_exp,$resume_job_profile,$resume_degree_name,$resume_job_designation,$resume_worksamp,$resume_job_type,$resume_job_location,$job_skillstring,$school,$high_school,$graduation,$post_graduation,$resume_start_date,$resume_end_date);

if($add_resumedetails)
{
	echo "Records Successfully Added";
}
else
{
	echo "Error! Try Again";
}
?>