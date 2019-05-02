<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$userid = $_SESSION['userid'];
$jobid = $_POST['jobid'];

$getjob_byjobid = $db->getjob_byjobid($jobid);
if($getjob_byjobid)
{
	foreach($getjob_byjobid as $row)
	{
		$qts1 = $row['job_qts1'];
		$qts2 = $row['job_qts2'];
	}
}

$get_year = $db->get_year();
$get_alljobtype = $db->get_alljobtype();
$get_alljobcategory = $db->get_alljobcategory();
$get_allsalary = $db->get_allsalary();
$get_alljoblocation = $db->get_alljoblocation();
$get_alljobdesignation = $db->get_alljobdesignation();
$get_alljoblocation = $db->get_alljoblocation();
$get_alljobqualification = $db->get_alljobqualification();
$get_alljobexperience = $db->get_alljobexperience();
$get_alljobskills = $db->get_alljobskills();

$get_jobsapplied_only = $db->get_jobsapplied_only($jobid);
if($get_jobsapplied_only)
{
foreach($get_jobsapplied_only as $prow)
{
	$cand_userid = $prow['userid'];
	$status = $prow['status'];
	$get_resumedetails = $db->get_resumedetails($prow['userid']);
	foreach($get_resumedetails as $row)
	{
	
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$date_ofbirth = @date('d-m-Y', strtotime($row["date_of_birth"]));
		$resume_gender = $row['gender'];
		$resume_city = $row['city'];
		$resume_state = $row['state'];
		$resume_email = $row['email'];
		$resume_mobile = $row['mobile'];
		$resume_pincode = $row['pincode'];
		$resume_pan = $row['pan_no'];
		$resume_aadhar = $row['aadhar_no'];
		$resume_address = $row['address'];
		
		$resume_school = $row['school_name'];
		$resume_board = $row['school_board'];
		$resume_school_year = $row['school_year'];
		$school_marks = $row['school_marks'];
		$resume_college = $row['high_school_name'];
		$resume_college_stream = $row['high_school_stream'];
		$resume_college_year = $row['high_school_year'];
		$resume_college_marks = $row['high_school_marks'];
		$resume_degree_name = $row['graduation_name'];
		$resume_degree_stream = $row['graduation_stream'];
		$resume_degree_year = $row['graduation_year'];
		$resume_degree_marks = $row['graduation_marks'];
		$resume_pg_name = $row['pg_name'];
		$resume_pg_stream = $row['pg_stream'];
		$resume_pg_year = $row['pg_year'];
		$resume_pg_marks = $row['pg_marks'];
		$school = $row['school'];
		$high_school = $row['high_school'];
		$graduation = $row['graduation'];
		$pg = $row['pg'];
		
		$resume_org_name = $row['org_name'];
		$resume_job_description = $row['org_desc'];
		$resume_job_exp = $row['org_experience'];
		$resume_job_profile = $row['org_profile'];
		$resume_job_designation = $row['org_designation'];
		$resume_worksamp = $row['work_sample'];
		$resume_job_type = $row['job_type'];
		$resume_job_location = $row['job_location'];
		$skills = $row['skills'];
		
		foreach($get_alljoblocation as $row)
		{
			if($row['code'] == $resume_city)
			$resume_city = $row['name'];
		}
		foreach($get_alljobdesignation as $row)
		{
			if($row['code'] == $resume_job_designation)
			$resume_job_designation = $row['name'];
		}
		foreach($get_alljobcategory as $row)
		{
			if($row['code'] == $resume_job_profile)
			$resume_job_profile = $row['name'];
		}
		foreach($get_alljobtype as $row)
		{
			if($row['code'] == $resume_job_type)
			$resume_job_type = $row['name'];
		}

		$get_candidate_data = $db->get_candidate_data($prow['userid']);
		foreach($get_candidate_data as $roww)
		{
			$image = $roww['image'];
			$image_name = $roww['image_name'];
		}
		
		foreach($get_year as $rrow)
		{
			if($rrow['code'] == $resume_pg_year)
			$resume_pg_year = $rrow['name'];		

			if($rrow['code'] == $resume_degree_year)
			$resume_degree_year = $rrow['name'];		
			
			if($rrow['code'] == $resume_college_year)
			$resume_college_year = $rrow['name'];		
			
			if($rrow['code'] == $resume_school_year)
			$resume_school_year = $rrow['name'];		
		}
		
		if($resume_degree_stream == 100)
		{
			$resume_degree_stream = "Bachelors in Commerce";
		}
		if($resume_degree_stream == 101)
		{
			$resume_degree_stream = "BAF";
		}
		if($resume_degree_stream == 102)
		{
			$resume_degree_stream = "BMM";
		}
		if($resume_degree_stream == 103)
		{
			$resume_degree_stream = "BBA";
		}
		if($resume_degree_stream == 104)
		{
			$resume_degree_stream = "BMS";
		}
		if($resume_degree_stream == 105)
		{
			$resume_degree_stream = "BA";
		}
		if($resume_degree_stream == 106)
		{
			$resume_degree_stream = "BScIT";
		}
		
		
		
		if($resume_pg_stream == 100)
		{
			$resume_pg_stream = "Masters in Commerce";
		}
		if($resume_pg_stream == 101)
		{
			$resume_pg_stream = "Masters in Literature";
		}
		if($resume_pg_stream == 102)
		{
			$resume_pg_stream = "MCA";
		}
		if($resume_pg_stream == 103)
		{
			$resume_pg_stream = "Masters in Business Management";
		}
		if($resume_pg_stream == 104)
		{
			$resume_pg_stream = "Master of Science (M.Sc.)";
		}
		if($resume_pg_stream == 105)
		{
			$resume_pg_stream = "Master of Financial Management (M.F.M. )";
		}
		if($resume_pg_stream == 106)
		{
			$resume_pg_stream = "MScIT";
		}
		
		if($resume_college_stream == 100)
		{
			$resume_college_stream = "Arts";
		}
		if($resume_college_stream == 101)
		{
			$resume_college_stream = "Science";
		}
		if($resume_college_stream == 102)
		{
			$resume_college_stream = "Commerce";
		}
		
		echo '<div class="col-md-12" style="border:1px solid #D3D3D3;padding-top:20px;padding-bottom:20px; border-radius: 10px;">
			<div class="col-md-7">
				<p style="font-size:14px;"><span style="font-size:16px;font-weight:bold;">'.$first_name.'  '.$last_name.'</span><br><i class="fa fa-map-marker" style="color:red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </i>'.$resume_address.' , '.$resume_city.' , '.$resume_pincode.'<br><i class="fa fa-book" style="color:blue"></i>&nbsp;&nbsp;';
				if($pg)
				{
					echo $resume_pg_name.', '.$resume_pg_stream.' , ('.$resume_pg_year.')';
				}
				else if($graduation)
				{
					echo $resume_degree_name.'. '.$resume_degree_stream.' , ('.$resume_degree_year.')';
				}
				else if($high_school)
				{
					echo $resume_college.', '.$resume_college_stream.' , ('.$resume_college_year.')';
				}
				else if($school)
				{
					echo $resume_school.', '.$resume_board.' , ('.$resume_school_year.')';
				}
				echo '
				<br><span style="font-weight:bold;">Skills </span>';
				
				$skills = json_decode($skills, true);
                          foreach ((array)$skills as $row) {
                                     $branchstaff[] = $row;
                          }
		foreach ((array)$get_alljobskills as $getrow) {
            $allbranch = $getrow["code"];
            if (array_search($allbranch,$branchstaff)) {
                    echo $getrow["name"].' , ';
					
            }
        }
				
				echo'<br><span title="'.$qts1.'" style="font-weight:bold;">Answer 1)</span> '.$prow['ans1'].'<br><span title="'.$qts2.'" style="font-weight:bold;">Answer 2)</span> '.$prow['ans2'].'</p>
				
			</div>
			<div class="col-md-2">';
				if($status == "Shortlisted")
				{
					echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;transform: rotate(-10deg);"  src="images/shortlisted.jpg" height=80 width=120/>';
				}
				if($status == "Hired")
				{
					echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;"  src="images/hired.jpg" height=90 width=110/>';
				}
				if($status == "Rejected")
				{
					echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;"  src="images/rejected1.jpg" height=80 width=130/>';
				}
			echo '</div>
			<div class="col-md-3">';
				if($image)
				{
					echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:10px;padding-bottom:10px;"  src="data:image/jpeg;base64,'.base64_encode($image_name).'" height=110 width=110/><p>';
				}
				else{
					echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:10px;"  src="../images/profile.jpg" height=70 width=70/><p>';
				}
		if($status == 'Applied')
		{
		echo '<button type="button" class="btn btn-info" onclick=shortlist_candidate("'.$cand_userid.'","'.$jobid.'","'.$resume_email.'","'.$first_name.'");>Shortlist</button>&nbsp;&nbsp;<button type="button" class="btn btn-danger" onclick=reject_candidate("'.$cand_userid.'","'.$jobid.'");>Reject</button>';
		}
		
		if($status == 'Shortlisted'){
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" onclick=reject_candidate("'.$cand_userid.'","'.$jobid.'","'.$first_name.'");>Reject</button>';
		}
		
		echo '</div>
		</div>';
	}
}
}
else{
echo '<h3 style="text-align:center;">No Applicants Found</h3>';
}
echo '<script>

function shortlist_candidate(cand_userid,jobid,email,first_name)
{
	$.ajax({
		type: "POST",
		url: "company/shortlist_candidate.php",
		data: {
			jobid : jobid,
			cand_userid : cand_userid,
			email : email,
			first_name : first_name
			},
			success:function(result){
				$("#show_applicants").modal("hide");
				alert(result);
			}
	});
}

function reject_candidate(cand_userid,jobid)
{
	$.ajax({
		type: "POST",
		url: "company/reject_candidate.php",
		data: {
			jobid : jobid,
			cand_userid : cand_userid,
			},
			success:function(result){
				$("#show_applicants").modal("hide");
				alert(result);
			}
	});
}
</script>';
?>