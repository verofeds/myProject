<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];
$datetime = date("d-m-Y");

$get_alljobtype = $db->get_alljobtype();
$get_allsalary = $db->get_allsalary();
$get_alljoblocation = $db->get_alljoblocation();

$get_jobsapplied = $db->get_jobsapplied($userid);



echo '
<div class="container"><br>
	<pre>>> View Applications	</pre><hr>
	<div class="well">';
if($get_jobsapplied){
		echo '<table class="table table-striped">
    <thead>
      <tr class="warning">
        <th style="text-align:center;" width="10%">Date</th>
		<th style="text-align:center;" width="20%">Job Title</th>
        <th style="text-align:center;" width="20%">Company Name</th>
        <th style="text-align:center;" width="20%">Probability</th>
		 <th style="text-align:center;" width="10%">Status</th>
		  <th style="text-align:center;" width="20%">Actions</th>
      </tr>
    </thead><tbody>';
	foreach($get_jobsapplied as $row)
	{
		$applied_on = date('d-m-Y', strtotime($row["applied_on"]));
		$application_status = $row['status'];
		$jobid = $row['jobid'];
		$getjob_byjobid = $db->getjob_byjobid($row['jobid']);
		foreach($getjob_byjobid as $prow)
		{
			$job_title = $prow['job_title'];
			$comp_userid = $prow['userid'];
			$show = $db->show($prow['userid']);
			foreach($show as $mrow)
			{
				$company_name = $mrow['comp_name'];
			}
		}
		
		$get_resumedetails = $db->get_resumedetails($userid);
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
				$org_salary = $row['org_salary'];
			}
		}
		
		$getjob_byjobid = $db->getjob_byjobid($jobid);
		foreach($getjob_byjobid as $row)
		{
			$job_title = $row['job_title'];
			$job_type = $row['job_type'];
			$expiry_date = @date('d-m-Y', strtotime($row["expiry_date"]));
			$job_category = $row['job_category'];
			$job_designation = $row['job_designation'];
			$job_salary = $row['job_salary'];
			$job_experience = $row['job_experience'];
			$job_qualification = $row['job_qualification'];
			$job_vacancy = $row['job_vacancy'];
			$job_location = $row['job_location'];
			$job_eligibility = $row['job_eligibility'];
			$job_gender = $row['job_gender'];
			$job_desc = $row['job_desc'];
			$job_perks = $row['job_perks'];
			$job_musthave = $row['job_musthave'];
			$job_qts1 = $row['job_qts1'];
			$job_qts2 = $row['job_qts2'];
			$job_skills = $row['job_skills'];
		}
		
		$job_type_code = 0;
		$job_designation_code = 0;
		$job_gender_code = 0;
		$job_category_code = 0;
		$job_qualification_code = 0;
		$job_salary_code = 0;
		$job_location_code = 0;
		$job_skils_code = 0;
		
		$skills_decode_array=array();
        $skills_decode_array[]='';
		$job_skills_decode_array=array();
        $job_skills_decode_array[]='';
		
		if($resume_job_type == $job_type)
		{
			$job_type_code = 10;
		}
		
		
		if($resume_job_designation == $job_designation)
		{
			$job_designation_code = 10;
		}
		
		if(($job_gender == 'A') or ($job_gender == $resume_gender))
		{
			$job_gender_code = 10;
		}
		
		if($job_category == $resume_job_profile)
		{
			$job_category_code = 10;
		}
		
		if($resume_state == $job_qualification)
		{
			$job_qualification_code = 10;
		}
		
		if($job_salary == $org_salary)
		{
			$job_salary_code = 10;
		}
		
		if($job_location == $resume_city)
		{
			$job_location_code = 10;
		}
		
		$skills_decode = json_decode($skills);
		foreach ((array)$skills_decode as $row) 
		{
            $skills_decode_array[]=$row;
        }
		
		$job_skills_decode = json_decode($job_skills);
		foreach ((array)$job_skills_decode as $row) 
		{
            $job_skills_decode_array[]=$row;
        }
		
		$result=array_intersect($skills_decode_array,$job_skills_decode_array);
		if($result)
		{
			foreach($result as $erow)
			{
				//$job_skils_code = $job_skils_code + 10;
				if($erow)
					$job_skils_code = 20;
			}
		}
						  
		$probability = 10 + $job_type_code + $job_designation_code + $job_gender_code + $job_category_code + $job_qualification_code + $job_salary_code + $job_location_code + $job_skils_code;
		
		
    echo '
      <tr>
		<td style="text-align:center;">'.$applied_on.'</td>
        <td style="text-align:center;">'.$job_title.'</td>
        <td style="text-align:center;">'.$company_name.'</td>
        <td style="text-align:center;">
		<div class="progress">
			<div style="width: '.$probability.'%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar" class="green progress-bar">
				<span>'.$probability.' %</span>
			 </div>
		</div>
		</td>
		<td style="text-align:center;">';
			if($application_status == "Hired")
				echo '<p style="background-color:#66bb6a;color:white;width:120px;">'.$application_status.'</p>';
			if($application_status == "Applied")
				echo '<p style="background-color:#26c6da;color:white;width:120px;">'.$application_status.'</p>';
			if($application_status == "Shortlisted")
				echo '<p style="background-color:#007bff;color:white;width:120px;">'.$application_status.'</p>';
			if($application_status == "Rejected")
				echo '<p style="background-color:#ef5350;color:white;width:120px;">'.$application_status.'</p>';
			echo '</td>
		<td style="text-align:center;"><a href="#" onclick=view_dets("'.$comp_userid.'","'.$jobid.'") data-toggle="modal" data-target="#view_job_detail_modal">View Application</a></td>
      </tr>';
	}
  echo '</tbody></table>
	</div>
</div>

<div class="modal fade" id="view_job_detail_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Your Application</h4>
        </div>
        <div class="modal-body col-md-12">
			<div id="view_job_detail_body" class="col-md-12"></div>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
    </div>
  </div>';
}
else
{
	echo '<h1 style="text-align:center;">No Applications Found</h2>';
}
echo "<script>
function view_dets(userid,jobid)
{
	$.ajax({
		type: 'POST',
		url:'candidate/view_details.php',
		data: {
			userid : userid,
			jobid : jobid,
			},
			success:function(result){
				$('#view_job_detail_body').html(result);
			}
	});
}

</script>";

?>
