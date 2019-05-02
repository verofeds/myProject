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
$resupfirst_name = $_POST['resupfirst_name'];
$resuplast_name = $_POST['resuplast_name'];
$date_ofbirth = @date('Y-m-d', strtotime($_POST["date_ofbirth"]));
$resupgender = $_POST['resupgender'];
$resupcity = $_POST['resupcity'];
$resupstate = $_POST['resupstate'];
$resupemail = $_POST['resupemail'];
$resupmobile = $_POST['resupmobile'];
$resuppincode = $_POST['resuppincode'];
$resuppan = $_POST['resuppan'];
$resupaadhar = $_POST['resupaadhar'];
$resupaddress = $_POST['resupaddress'];

$resupschool = $_POST['resupschool'];
$resupboard = $_POST['resupboard'];
$resupschool_year = $_POST['resupschool_year'];
$school_marks = $_POST['school_marks'];
$resupcollege = $_POST['resupcollege'];
$resupcollege_stream = $_POST['resupcollege_stream'];
$resupcollege_year = $_POST['resupcollege_year'];
$resupcollege_marks = $_POST['resupcollege_marks'];
$resupdegree_name = $_POST['resupdegree_name'];
$resupdegree_stream = $_POST['resupdegree_stream'];
$resupdegree_year = $_POST['resupdegree_year'];
$resupdegree_marks = $_POST['resupdegree_marks'];
$resuppg_name = $_POST['resuppg_name'];
$resuppg_stream = $_POST['resuppg_stream'];
$resuppg_year = $_POST['resuppg_year'];
$resuppg_marks = $_POST['resuppg_marks'];

$resuporg_name = $_POST['resuporg_name'];
$resupjob_description = $_POST['resupjob_description'];
$resupstart_date = @date('Y-m-d', strtotime($_POST['resupstart_date']));
$resupend_date = @date('Y-m-d', strtotime($_POST['resupend_date']));
$resupjob_exp = $_POST['resupjob_exp'];
$resupjob_profile = $_POST['resupjob_profile'];
$resupjob_designation = $_POST['resupjob_designation'];
$resupworksamp = $_POST['resupworksamp'];
$resupjob_type = $_POST['resupjob_type'];
$resupjob_location = $_POST['resupjob_location'];
$job_skillstring = $_POST['job_skillstring'];

if($resupschool)
{
	$school = 1;
}
if($resupcollege)
{
	$high_school = 1;
}
if($resupdegree_name)
{
	$graduation = 1;
}
if($resuppg_name)
{
	$post_graduation = 1;
}

$update_resumedetails = $db->update_resumedetails($userid,$resupfirst_name,$resuplast_name,$date_ofbirth,$resupgender,$resupcity,$resupstate,$resupemail,$resupmobile,$resuppincode,$resuppan,$resupaadhar,$resupaddress,$resupschool,$resupboard,$resupschool_year,$school_marks,$resupcollege,$resupcollege_stream,$resupcollege_year,$resupcollege_marks,$resupdegree_stream,$resupdegree_year,$resupdegree_marks,$resuppg_name,$resuppg_stream,$resuppg_year,$resuppg_marks,$resuporg_name,$resupjob_description,$resupjob_exp,$resupjob_profile,$resupdegree_name,$resupjob_designation,$resupworksamp,$resupjob_type,$resupjob_location,$job_skillstring,$school,$high_school,$graduation,$post_graduation,$resupstart_date,$resupend_date);
echo $update_resumedetails;
if($update_resumedetails)
{
	echo "Records Successfully Updated";
}
else
{
	echo "Error! Try Again";
}
?>