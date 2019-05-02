<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$userid = $_SESSION['userid'];

$jobid = $_POST['jobid'];
$cand_userid = $_POST['cand_userid'];
$email = $_POST['email'];
$first_name = $_POST['first_name'];

$shortlist_candidate = $db->shortlist_candidate($cand_userid,$jobid);

$get_alljobtype = $db->get_alljobtype();
$get_allsalary = $db->get_allsalary();
$get_alljoblocation = $db->get_alljoblocation();

$getjob_byjobid = $db->getjob_byjobid($jobid);
if($getjob_byjobid)
{
	foreach($getjob_byjobid as $row)
	{
		$comp_id = $row['userid'];
		$get_company_data = $db->get_company_data($comp_id);
		foreach($get_company_data as $crow)
		{
			$company_name = $crow['comp_name'];
		}
		$jobid = $row['jobid'];
		$job_title = $row['job_title'];
		$job_type = $row['job_type'];
		$job_salary = $row['job_salary'];
		$job_location = $row['job_location'];
		
		foreach($get_alljobtype as $row)
		{
			if($row['code'] == $job_type)
			$job_type = $row['name'];
		}
		foreach($get_allsalary as $row)
		{
			if($row['code'] == $job_salary)
			$job_salary = $row['name'];
		}
		foreach($get_alljoblocation as $row)
		{
			if($row['code'] == $job_location)
			$job_location = $row['name'];
		}
	}
}

if($email)
{
	$to = $email;
	$subject = "GETJOBS - Application Update";
$msg= 'Hello '.$first_name.'! 

Your application has been SHORTLISTED for 

Job Title: '.$job_title.'
Company Name: '.$company_name.'
Location: '.$job_location.'
Salary: '.$job_salary.'';
			mail($to,$subject,$msg);
}

if($shortlist_candidate)
{
	echo "Candidate Shortlisted";
}
else
{
	echo "Error! Try Again";
}
?>