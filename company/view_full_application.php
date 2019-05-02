<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$userid = $_SESSION['userid'];
$jobid = $_POST['jobid'];
$cand_userid = $_POST['cand_userid'];

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

$getjob_byid = $db->getjob_byid($userid,$jobid);
if($getjob_byid)
{
	foreach($getjob_byid as $row)
	{
		$job_qts1 = $row['job_qts1'];
		$job_qts2 = $row['job_qts2'];
	}
}

$get_candidate_application = $db-> get_candidate_application($jobid,$cand_userid);
if($get_candidate_application)
{
	foreach($get_candidate_application as $prow)
	{
		$cand_userid = $prow['userid'];
		$status = $prow['status'];
		$ans1 = $prow['ans1'];
		$ans2 = $prow['ans2'];
	
		$applied_on = @date('d-m-Y', strtotime($prow["applied_on"]));
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
			$org_start_date = $row['org_start_date'];
			$org_end_date = $row['org_end_date'];
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
		}
	}
	
	$get_candidate_data = $db->get_candidate_data($cand_userid);
	foreach($get_candidate_data as $roww)
	{
		$image = $roww['image'];
		$image_name = $roww['image_name'];
	}
		
	
	echo '<div class="col-md-12">
			<div class="col-md-6">
				<h1>'.$first_name.'  '.$last_name.'</h1>
				<p style="font-size:16px;"><i class="fa fa-map-marker">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </i>'.$resume_address.' , '.$resume_city.' , '.$resume_pincode.' <br />
				<i class="glyphicon glyphicon-envelope">&nbsp; </i>'.$resume_email.'<br />
					<i class="fa fa-phone">&nbsp;&nbsp;&nbsp;&nbsp; </i>'.$resume_mobile.'
											<br />
											<i class="glyphicon glyphicon-gift">&nbsp; </i>'.$date_ofbirth.'</p>
			</div>
			<div class="col-md-2">';
			if($status == "Shortlisted")
			{
				echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;transform: rotate(-10deg);"  src="images/shortlisted.jpg" height=100 width=150/>';
			}
			if($status == "Hired")
			{
				echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;"  src="images/hired.jpg" height=100 width=150/>';
			}
			if($status == "Rejected")
			{
				echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;"  src="images/rejected1.jpg" height=100 width=150/>';
			}
			echo '</div>
			<div class="col-md-4">';
				if($image)
				{
					echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;"  src="data:image/jpeg;base64,'.base64_encode($image_name).'" height=150 width=150/>';
				}
				else{
					echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;"  src="../images/profile.jpg" height=150 width=150/>';
				}
			echo '</div>
			
		</div>
		
		<div class="col-md-12">
			<table class="table ">
			<thead>
				<tr class="warning">
					<th style="text-align:center;" width="25%">Degree</th>
					<th style="text-align:center;" width="25%">Stream / Board</th>
					<th style="text-align:center;" width="25%">Year</th>
					<th style="text-align:center;" width="25%">Percentage / CGPA</th>
				 </tr>
			</thead>
			<tbody>';
				if($school)
				{
					echo '<tr class="table-warning">
						<td style="text-align:center;">'.$resume_school.'</td>
						<td style="text-align:center;">'.$resume_board.'</td>
						<td style="text-align:center;">'.$resume_school_year.'</td>
						<td style="text-align:center;">'.$school_marks.'</td>
					</tr>';
				}
				if($high_school)
				{
					echo '<tr class="table-warning">
						<td style="text-align:center;">'.$resume_college.'</td>
						<td style="text-align:center;">'.$resume_college_stream.'</td>
						<td style="text-align:center;">'.$resume_college_year.'</td>
						<td style="text-align:center;">'.$resume_college_marks.'</td>
					</tr>';
				}
				if($graduation)
				{
					echo '<tr class="table-warning">
						<td style="text-align:center;">'.$resume_degree_name.'</td>
						<td style="text-align:center;">'.$resume_degree_stream.'</td>
						<td style="text-align:center;">'.$resume_degree_year.'</td>
						<td style="text-align:center;">'.$resume_degree_marks.'</td>
					</tr>';
				}
				if($pg)
				{
					echo '<tr class="table-warning">
						<td style="text-align:center;">'.$resume_pg_name.'</td>
						<td style="text-align:center;">'.$resume_pg_stream.'</td>
						<td style="text-align:center;">'.$resume_pg_year.'</td>
						<td style="text-align:center;">'.$resume_pg_marks.'</td>
					</tr>';
				}
			 
			echo '</tbody>
			</table>
		</div>
		
		<hr >';
	if($resume_org_name){
	echo '<div class="col-md-12">
	<div class="col-md-2">
			<h3>Jobs</h3>
		</div>
		<div class="col-md-10" style="padding-top:20px;">
			<p style="font-size:16px;font-weight:bold;">'.$resume_org_name.' 			'.$org_start_date.' - '.$org_end_date.'</p>'.$resume_job_profile.' , '.$resume_job_designation.'<br/>'.$resume_job_description.'
		</div>
	</div>';
	}
	echo '
	<hr>
	<div class="col-md-12">
		<div class="col-md-2" style="padding-top:20px;padding-bottom:20px;">
			<h3 >Skills</h3>
		</div>';
		if($skills)
		{
		echo '<div class="col-md-10" style="padding-top:20px;padding-bottom:20px;">';
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
		}
		echo '</div>
	</div>
	
	<div class="col-md-12" style="border:1px solid #D3D3D3;padding-top:20px;padding-bottom:20px;border-radius: 10px;" id="question_div">
			
		<div class="col-md-12">
				<div class="col-md-6">
					<p style="font-size:14px;font-weight:bold;">Q1) '.$job_qts1.'</p>
				</div>
				
				<div class="col-md-6">
					<p style="font-size:14px;font-weight:bold;">Q2) '.$job_qts2.'</p>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6">
					<p><span style="font-size:14px;font-weight:bold;">A)</span> '.$ans1.'</p>
				</div>
				<div class="col-md-6">
					<p><span style="font-size:14px;font-weight:bold;">A)</span> '.$ans2.'</p>
				</div>
			</div>
	</div>
	
	<div class="col-md-12" style="padding-top:20px;"><center>';
	if($status == "Shortlisted")
	{
		echo '<button type="button" class="btn btn-success" onclick=hire_candidate("'.$cand_userid.'","'.$jobid.'","'.$resume_email.'","'.$first_name.'");>Hire</button>&nbsp;&nbsp;';
	
		echo '<button type="button" class="btn btn-danger" onclick=reject_candidate("'.$cand_userid.'","'.$jobid.'");>Reject</button>&nbsp;&nbsp;';
	}
	
	echo '</div></center>';
}

echo '<script>

function hire_candidate(cand_userid,jobid,email,first_name)
{
	$.ajax({
		type: "POST",
		url: "company/hire_candidate.php",
		data: {
			jobid : jobid,
			cand_userid : cand_userid,
			email : email,
			first_name : first_name
			},
			success:function(result){
				$("#view_cand_resume_modal").modal("hide");
				alert(result);
			}
	});
}
</script>';
?>