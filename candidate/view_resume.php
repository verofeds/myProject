<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];
$get_resumedetails = $db->get_resumedetails($userid);
$get_alljobtype = $db->get_alljobtype();
$get_alljobcategory = $db->get_alljobcategory();
$get_allsalary = $db->get_allsalary();
$get_alljoblocation = $db->get_alljoblocation();
$get_alljobdesignation = $db->get_alljobdesignation();
$get_alljoblocation = $db->get_alljoblocation();
$get_alljobqualification = $db->get_alljobqualification();
$get_alljobexperience = $db->get_alljobexperience();
$get_alljobskills = $db->get_alljobskills();

if($get_resumedetails){
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
	}
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

	$get_candidate_data = $db->get_candidate_data($userid);
	foreach($get_candidate_data as $roww)
	{
		$image = $roww['image'];
		$image_name = $roww['image_name'];
	}
			
	echo '<div class="container">

	  <div class="card-body">
		<div class="col-md-12">
			<div class="col-md-8">
				<h1>'.$first_name.'  '.$last_name.'</h1>
				<p style="font-size:16px;"><i class="fa fa-map-marker">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </i>'.$resume_address.' , '.$resume_city.' , '.$resume_pincode.' <br />
				<i class="glyphicon glyphicon-envelope">&nbsp; </i>'.$resume_email.'<br />
					<i class="fa fa-phone">&nbsp;&nbsp;&nbsp;&nbsp; </i>'.$resume_mobile.'
											<br />
											<i class="glyphicon glyphicon-gift">&nbsp; </i>'.$date_ofbirth.'</p>
			</div>
			<div class="col-md-4">';
				if($image)
				{
					echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;"  src="data:image/jpeg;base64,'.base64_encode($image_name).'" height=150 width=150/><p>';
				}
				else{
					echo '<img style="display: block;margin-left: auto;margin-right: auto;padding-top:20px;"  src="../images/profile.jpg" height=150 width=150/><p>';
				}
			echo '</div>
		</div>
	<hr style="clear:both;" class="style18">

	<div class="col-md-12">
		<div class="col-md-2">
			<h3>Education</h3>
		</div>
		<div class="col-md-10">
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
						<td style="text-align:center;">'.$resume_school.'</td>
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
		<div class="col-md-2">
			<h3>Skills</h3>
		</div>';
		if($skills)
		{
		echo '<div class="col-md-10" style="padding-top:20px;">';
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
	</div></div></div>';
}
else{
	echo '<h1 style="text-align:center;padding-top:20px;">Please fill in the Resume</h2>';
}

?>