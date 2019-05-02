<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$userid = $_SESSION['userid'];
$jobid = $_POST['jobid'];

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


$get_shortlistedcand_only = $db->get_shortlistedcand_only($jobid);
if($get_shortlistedcand_only)
{
	
	echo '<div >
	<table class="table table-bordered table-striped mb-0 table-striped">
    <thead>
      <tr class="warning">
        <th style="text-align:center;" width="5%">Date</th>
		<th style="text-align:center;" width="20%">Name</th>
        <th style="text-align:center;" width="25%">Highest Qualification</th>
        <th style="text-align:center;" width="25%">Location</th>
		 <th style="text-align:center;" width="15%">Profile match</th>
		  <th style="text-align:center;" width="10%">View</th>
      </tr>
    </thead><tbody>';
	
	foreach($get_shortlistedcand_only as $prow)
	{
		$cand_userid = $prow['userid'];
		$status = $prow['status'];
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
				$org_salary = $row['org_salary'];
			
			foreach($get_alljoblocation as $row)
			{
				if($row['code'] == $resume_city)
				$resume_city = $row['name'];
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
		
		
		
			
			 echo '<tr>
				<td style="text-align:center;">'.$applied_on.'</td>
				<td style="text-align:center;">'.$first_name.' '.$last_name.'</td>
				<td style="text-align:center;">';
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
				echo '</td>
				<td style="text-align:center;">'.$resume_address.'  '.$resume_city.' , '.$resume_pincode.'</td>
				<td style="text-align:center;">';
				if($probability > 60 or $probability == 60)
					echo '<p style="background-color:#66bb6a;color:white;width:120px;">'.$probability.' %</p>';
				else
					echo '<p style="background-color:#007bff;color:white;width:120px;">'.$probability.' %</p>';
				
				echo'</td>
				<td style="text-align:center;"><a href="#" onclick=view_cand_application("'.$jobid.'","'.$cand_userid.'") data-toggle="modal" data-target="#view_cand_resume_modal">View Application</a></td>
			  </tr>';
			
		}
	}
	
	echo '</tbody>
	</table>
	</div>
	
	<div class="modal fade" id="view_cand_resume_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Application</h4>
        </div>
        <div class="modal-body col-md-12">
			<div id="view_cand_resume_body" class="col-md-12"></div>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
    </div>
  </div>';
}

echo "<script>
function view_cand_application(jobid,cand_userid)
{
	$.ajax({
		type: 'POST',
		url:'company/view_full_application.php',
		data: {
			jobid : jobid,
			cand_userid : cand_userid
			},
		success:function(result){
			$('#view_cand_resume_body').html(result);
		}
	});
}
</script>";
?>