<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$userlogin = $_SESSION['userid'];
$login = $_SESSION['login'];
$userid = $_POST['userid'];
$jobid = $_POST['jobid'];

$get_alljobtype = $db->get_alljobtype();
$get_alljobcategory = $db->get_alljobcategory();
$get_allsalary = $db->get_allsalary();
$get_alljoblocation = $db->get_alljoblocation();
$get_alljobdesignation = $db->get_alljobdesignation();
$get_alljobqualification = $db->get_alljobqualification();
$get_alljobexperience = $db->get_alljobexperience();
$get_alljobskills = $db->get_alljobskills();

$get_jobsapplied_byjobiduserid = $db->get_jobsapplied_byjobiduserid($userlogin,$jobid);

$getjob_byid = $db->getjob_byid($userid,$jobid);
foreach($getjob_byid as $row)
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
	$created_on = $row['created_on'];
}

$get_company_data = $db->get_company_data($userid);
foreach($get_company_data as $row)
{
	$company_name = $row['comp_name'];
	$comp_email = $row['comp_email'];
	$comp_phone = $row['comp_phone'];
	$comp_mobile = $row['comp_mobile'];
	$comp_website = $row['comp_website'];
	$linked_link = $row['linked_link'];
	$twitter_link = $row['twitter_link'];
	$facebook_link = $row['facebook_link'];
	$image_name = $row['image_name'];
}
			
			foreach($get_alljoblocation as $jrow)
			{
				if($jrow['code'] == $job_location)
				$job_location = $jrow['name'];
			}
			
			foreach($get_alljobexperience as $jrow)
			{
				if($jrow['code'] == $job_experience)
				$job_experience = $jrow['name'];
			}
			
			foreach($get_allsalary as $mrow)
			{
				if($mrow['code'] == $job_salary)
				$job_salary = $mrow['name'];
			}
			
			foreach($get_alljobtype as $mrow)
			{
				if($mrow['code'] == $job_type)
				$job_type = $mrow['name'];
			}
			$created_on = date('d-m-Y', strtotime($created_on));

echo '<div class="col-md-12" style="background-color:white;border:1px solid #D3D3D3; border-radius: 10px;">
				<div class="col-md-2">
					<img style="padding-bottom:10px;padding-top:10px;margin-left: auto;margin-right: auto;" height=100 width=100 src="data:image/jpeg;base64,'.base64_encode($image_name).'"/>
				</div>
				<div class="col-md-8">
						<p style="font-size:20px;font-weight:bold;padding-top:10px;">'.$job_title.'</p>
						
					<p><span style="font-size:16px;">'.$company_name.'</span><br/><i class="fa fa-map-marker " style="color:red;" aria-hidden="true"></i>&nbsp;&nbsp;'.$job_location.'&nbsp;&nbsp;<i class="fa fa-money" style="color:green;" aria-hidden="true"></i>&nbsp;&nbsp;'.$job_salary.'&nbsp;&nbsp;<i class="fa fa-calendar" style="color:black;" aria-hidden="true"></i>&nbsp;&nbsp;Posted on '.$created_on.'</p>
				</div>
				<div class="col-md-2" style="padding-top:20px;">
					<p style="color:white;background-color:coral;border-style:solid;border-color: coral;border-radius:10px;font-weight:bold;text-align:center;">'.$job_type.'</p>
				</div>
			
	</div>
	</br>
	<div class="col-md-12" style="background-color:white;border:1px solid #D3D3D3;padding-top:20px;padding-bottom:20px; border-radius: 10px;">
		<p style="font-size:14px;color:grey;"><span style="font-size:16px;font-weight:bold;">Job Description</span></br>'.$job_desc.'</p>
		<p style="font-size:14px;color:grey;"><span style="font-size:16px;font-weight:bold;">Education and Experience</span></br>'.$job_eligibility.'</p>
		<p style="font-size:14px;color:grey;"><span style="font-size:16px;font-weight:bold;">Must Have</span></br>'.$job_musthave.'</p>
		<p style="font-size:14px;color:grey;"><span style="font-size:16px;font-weight:bold;">Perks of Joining</span></br>'.$job_perks.'</p>
		<p style="font-size:14px;color:grey;"><span style="font-size:16px;font-weight:bold;">Number of Positions Available:</span> '.$job_vacancy.'</p>
		<p style="font-size:14px;color:grey;"><span style="font-size:16px;font-weight:bold;">Skills Required: </span>';
		$skills = json_decode($job_skills, true);
                          foreach ((array)$skills as $row) {
                                     $branchstaff[] = $row;
                          }
		foreach ((array)$get_alljobskills as $getrow) {
            $allbranch = $getrow["code"];
            if (array_search($allbranch,$branchstaff)) {
                    echo $getrow["name"].' , ';
					
            }
        }
		echo'</p>
		<p style="font-size:14px;color:grey;"><span style="font-size:16px;font-weight:bold;">Preferred Experience:</span> '.$job_experience.' Years</p>
		<div class="col-md-12 collapse" style="border:1px solid #D3D3D3;padding-top:20px;padding-bottom:20px;border-radius: 10px;" id="question_div">
			<div class="col-md-12">
				<div class="col-md-6">
					<p style="font-size:14px;font-weight:bold;">Q1) '.$job_qts1.'</p>
				</div>
				
				<div class="col-md-6">
					<p style="font-size:14px;font-weight:bold;">Q2) '.$job_qts2.'</p>
				</div>
			</div>
			<div class="col-md-12">
			<form>
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Write Your Answer" id="apply_ans1" name="job_title">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Write Your Answer" id="apply_ans2" name="job_title">
					</div>
				</div>
				<button type="button" class="btn btn-success pull-right" onclick=submit_application("'.$jobid.'");>Submit Application</button>
			</form>
			</div>
		</div>
		<div class="col-md-12">';
			if(!$get_jobsapplied_byjobiduserid)
			{
				echo '<button class="btn btn-warning pull-right abcde" data-toggle="collapse" data-target="#question_div">Apply Now</button>';
			}
			else
			{
				echo '<p style="color:white;background-color:#228B22;border-style:solid;border-color: #228B22;border-radius:10px;font-weight:bold;text-align:center;">Already Applied</p>';
			}
		echo '</div>
	</div>';
	
echo '<script>
$(".abcde").click(function(){
  $(".abcde").hide();
}); 

function submit_application(jobid)
{
	var apply_ans1 = $("#apply_ans1").val();
	var apply_ans2 = $("#apply_ans2").val();
	
	$.ajax({
		type: "POST",
		url: "candidate/submit_application.php",
		data: {
			jobid : jobid,
			apply_ans1 : apply_ans1,
			apply_ans2 : apply_ans2
			},
			success:function(result){
				$("#view_detailsofjob").modal("hide");
				alert(result);
			}
	});
}
</script>';
?>