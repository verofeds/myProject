<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];

$get_alljobtype = $db->get_alljobtype();
$get_alljobcategory = $db->get_alljobcategory();
$get_alljobsfordashboard = $db->get_alljobsfordashboard();
$get_alljoblocation = $db->get_alljoblocation();
$get_allsalary = $db->get_allsalary();

echo '<div class="col-md-7 well">';
		foreach($get_alljobsfordashboard as $prow)
		{
			$get_company_data = $db->get_company_data($prow['userid']);
			foreach($get_company_data as $row)
			{
				$company_name = $row['comp_name'];
				$comp_email = $row['comp_email'];
				$comp_pname = $row['comp_pname'];
				$comp_phone = $row['comp_phone'];
				$comp_mobile = $row['comp_mobile'];
				$team_size = $row['team_size'];
				$estab_since = $row['established_since'];
				$comp_website = $row['comp_website'];
				$linked_link = $row['linked_link'];
				$twitter_link = $row['twitter_link'];
				$facebook_link = $row['facebook_link'];
				$comp_about = $row['comp_about'];
				$comp_category = $row['comp_category'];
				$image_name = $row['image_name'];
			}
			
			$job_location = $prow['job_location'];
			foreach($get_alljoblocation as $jrow)
			{
				if($jrow['code'] == $job_location)
				$job_location = $jrow['name'];
			}
			
			$job_salary = $prow['job_salary'];
			foreach($get_allsalary as $mrow)
			{
				if($mrow['code'] == $job_salary)
				$job_salary = $mrow['name'];
			}
			$created_on = date('d-m-Y', strtotime($prow["created_on"]));
			
			echo '<div class="col-md-12" style="background-color:white;border:1px solid #D3D3D3; border-radius: 10px;">
				<div class="col-md-2">
					<img style="padding-bottom:10px;padding-top:10px;margin-left: auto;margin-right: auto;border-radius: 50%;"  src="data:image/jpeg;base64,'.base64_encode($image_name).'" height=70 width=70/>
				</div>
				<div class="col-md-10">
					<div class="col-md-12">
						<div class="col-md-9">
						<p style="font-size:16px;font-weight:bold;padding-top:10px;">'.$prow["job_title"].'</p>
						</div>
						<div class="col-md-3" style="padding-top:10px;">
							<button class="btn btn-default" data-toggle="modal" data-target="#view_detailsofjob" onclick=getjobdetails("'.$prow['userid'].'","'.$prow['jobid'].'");>View Details&nbsp;<i class="fa fa-angle-double-right"></i></button>
						</div>
					</div>
					<p><a href="#" onclick=getcompanyinfo("'.$prow['userid'].'");>'.$company_name.'</a><br/><i style="color:red;" class="fa fa-map-marker " aria-hidden="true"></i>&nbsp;&nbsp;'.$job_location.'&nbsp;&nbsp;<i class="fa fa-money" style="color:green;" aria-hidden="true"></i>&nbsp;&nbsp;'.$job_salary.'&nbsp;&nbsp;<i class="fa fa-calendar" style="color:black;" aria-hidden="true"></i>&nbsp;&nbsp;Posted on '.$created_on.'</p>
				</div>
			</div>';
		}
		echo '</div>
		<div class="col-md-5" id="showcompanyinfo" style="position:fixed;left:67%;width: 430px;height: 300px;">
			
		</div>';
?>