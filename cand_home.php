<?php
@session_start();
include('functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];
$get_name = $db->get_name($username,$login);
$get_jobsapplied_only = $db->get_jobsapplied_only($userid);
$get_jobsapplied = $db->get_jobsapplied($userid);
$get_candidate_data = $db->get_candidate_data($userid);
$get_number_of_applicants_shortlisted = $db->get_number_of_applicants_shortlisted($userid);
$get_number_of_applicants_pend_cand = $db->get_number_of_applicants_pend_cand($userid);


$count = 0;
$count1 = 0;
$count2 = 0;

if($login == 1)
{

	$show = $db->show($userid);
	if($show)
	{
		foreach($show as $srow)
		{
			$company_name = $srow['comp_name'];
			$image = $srow['image'];
			$image_name = $srow['image_name'];
		}
	}
	
	$get_number_of_posts = $db->get_number_of_posts($userid);
	
	$get_alljobs = $db->get_alljobs($userid);
	if($get_alljobs)
	{
		foreach($get_alljobs as $row)
		{
			$get_number_of_applicants = $db->get_number_of_applicants($row['jobid']);
			$count = $count + $get_number_of_applicants;
			
			$get_number_of_applicants_hired = $db->get_number_of_applicants_hired($row['jobid']);
			$count1 = $count1 + $get_number_of_applicants_hired;
			
			$get_number_of_applicants_pending = $db->get_number_of_applicants_pending($row['jobid']);
			$count2 = $count2 + $get_number_of_applicants_pending;
		}
	}
	
	echo '
	<div class="content" style="padding-top:10px;">
		<div class="container">
			<div class="col-md-1" style="margin-bottom:20px;padding-top:10px;">';
				if($image_name)
				echo '<img style="margin-left: auto;margin-right: auto;border-radius:50px;" src="data:image/jpeg;base64,'.base64_encode($image_name).'" height=70 width=70/>';
			echo'</div>
			<div class="col-md-10">
				<span style="color:#696969;font-size:30px;padding-top:10px;">'.$company_name.'</span><hr>
			</div>
			
	<div class="col-md-12 row" style="padding-bottom:20px;">
		<div class="col-md-3">
		  <div class="card-counter primary">
			<i class="fa fa-code-fork"></i>
			<span class="count-numbers">'.$get_number_of_posts.'</span>
			<span class="count-name">Job Openings</span>
		  </div>
		</div>

		<div class="col-md-3">
		  <div class="card-counter danger">
			<i class="fa fa-ticket"></i>
			<span class="count-numbers">'.$count.'</span>
			<span class="count-name">Applications</span>
		  </div>
		</div>

		<div class="col-md-3">
		  <div class="card-counter success">
			<i class="fa fa-database"></i>
			<span class="count-numbers">'.$count1.'</span>
			<span class="count-name">Hired</span>
		  </div>
		</div>

		<div class="col-md-3">
		  <div class="card-counter info">
			<i class="fa fa-users"></i>
			<span class="count-numbers">'.$count2.'</span>
			<span class="count-name">Pending</span>
		  </div>
		</div>
	</div>

<div class="col-md-12" style="border: 1px solid #DCDCDC; border-radius:25px;padding:20px;">
 <table class="table table-striped" id="office_table">
    <thead>
      <tr class="warning">
        <th style="text-align:center;" width="20%">Job Posted On</th>
		<th style="text-align:center;" width="20%">Job Title</th>
        <th style="text-align:center;" width="20%">Candidate Name</th>
        <th style="text-align:center;" width="20%">Vacancies</th>
		 <th style="text-align:center;" width="20%">Status</th>
      </tr>
    </thead><tbody>';
	if($get_alljobs)
	{
		foreach($get_alljobs as $xrow)
		{	
			$job_vacancy = $xrow["job_vacancy"];
			$get_jobsapplied_only = $db->get_jobsapplied_only($xrow['jobid']);
			if($get_jobsapplied_only)
			{
				foreach($get_jobsapplied_only as $prow)
				{
					
					$cand_userid = $prow['userid'];
					$status = $prow['status'];
					$applied_on = date('d-m-Y', strtotime($prow["applied_on"]));
					$application_status = $prow['status'];
					$jobid = $prow['jobid'];
					
					$getjob_byjobid = $db->getjob_byjobid($prow['jobid']);
					foreach($getjob_byjobid as $wrow)
					{
						$job_title = $wrow['job_title'];
						$comp_userid = $wrow['userid'];
						$show = $db->show($wrow['userid']);
						foreach($show as $mrow)
						{
							$company_name = $mrow['comp_name'];
						}
					}
					
					$get_resumedetails = $db->get_resumedetails($prow['userid']);
					foreach($get_resumedetails as $row)
					{
						$first_name = $row['first_name'];
						$last_name = $row['last_name'];
					}
				
				
			
		echo '
		  <tr>
			<td style="text-align:center;">'.$applied_on.'</td>
			<td style="text-align:center;">'.$job_title.'</td>
			<td style="text-align:center;">'.$first_name.'  '.$last_name.'</td>
			<td style="text-align:center;">'.$job_vacancy.'</td>
			<td style="text-align:center;padding-left:30px;">';
			if($application_status == "Hired")
				echo '<p style="background-color:#66bb6a;color:white;width:120px;">'.$application_status.'</p>';
			if($application_status == "Applied")
				echo '<p style="background-color:#26c6da;color:white;width:120px;">'.$application_status.'</p>';
			if($application_status == "Shortlisted")
				echo '<p style="background-color:#007bff;color:white;width:120px;">'.$application_status.'</p>';
			if($application_status == "Rejected")
				echo '<p style="background-color:#ef5350;color:white;width:120px;">'.$application_status.'</p>';
			echo '</td>
		  </tr>';
		  }
			}
	}
	}
  echo '</tbody></table>
  </div>
	  
	  </div>
	</div>
	</div>';
}
else
{

	if($get_candidate_data)
	{
		foreach($get_candidate_data as $rrow)
		{
			$first_name = $rrow['first_name'];
			$last_name = $rrow['last_name'];
			$image = $rrow['image'];
			$image_name = $rrow['image_name'];
		}
	}
	$count = 0;
	if($get_jobsapplied)
	{
		foreach($get_jobsapplied as $rrow)
		{
			$count = $count + 1;
		}
	}
	$get_number_of_applications_dash = $db->get_number_of_applications_dash();
	
	echo '<div class="content" style="padding-top:10px;">
		<div class="container">
			<div class="col-md-1" style="margin-bottom:20px;padding-top:10px;">';
				if($image_name)
				echo '<img style="margin-left: auto;margin-right: auto;border-radius:50px;" src="data:image/jpeg;base64,'.base64_encode($image_name).'" height=70 width=70/>';
			echo'</div>
			<div class="col-md-10">
				<span style="color:#696969;font-size:30px;padding-top:10px;">'.$first_name.'  '.$last_name.'</span><hr>
			</div>
			
			<div class="col-md-12">
				<div class="col-md-3">
				  <div class="card-counter primary">
					<i class="fa fa-code-fork"></i>
					<span class="count-numbers">'.$get_number_of_applications_dash.'</span>
					<span class="count-name">Job Openings</span>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="card-counter danger">
					<i class="fa fa-ticket"></i>
					<span class="count-numbers">'.$count.'</span>
					<span class="count-name">Applications</span>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="card-counter success">
					<i class="fa fa-database"></i>
					<span class="count-numbers">'.$get_number_of_applicants_shortlisted.'</span>
					<span class="count-name">Shortlisted</span>
				  </div>
				</div>

				<div class="col-md-3">
				  <div class="card-counter info">
					<i class="fa fa-users"></i>
					<span class="count-numbers">'.$get_number_of_applicants_pend_cand.'</span>
					<span class="count-name">Pending</span>
				  </div>
				</div>
			</div>
	
			<div class="row">
					<div class="col-md-12">
						<div class="page-header">
						  <h1></h1>
						</div>
						<div style="display:inline-block;width:100%;overflow: hidden;">
						<ul class="timeline timeline-horizontal">
							<li class="timeline-item">
								<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>
								<div class="timeline-panel">
									
										<p>"Always do something that you are a little not ready to do. That’s how you grow. When there’s that moment of ‘Wow, I’m not really sure I can do this,’ and you push through those moments, that’s when you have a breakthrough."
-Marissa Mayer</p>
								</div>
							</li>
							<li class="timeline-item">
								<div class="timeline-badge success"><i class="glyphicon glyphicon-check"></i></div>
								<div class="timeline-panel">
									<p> “If You Are Working On Something That You Really Care About, You Don’t Have To Be Pushed. The Vision Pulls You.” – Steve Jobs</p>
								</div>
							</li>
							<li class="timeline-item">
								<div class="timeline-badge info"><i class="glyphicon glyphicon-check"></i></div>
								<div class="timeline-panel">
									
										<p>"Don’t limit yourself. Many people limit themselves to what they think they can do. You can go as far as your mind lets you. What you believe, remember, you can achieve."
-Mary Kay Ash</p>
									
								</div>
							</li>
							
							
						</ul>
					</div>
					</div>
			</div>
		</div>
		</div>';
}


echo "<script>
	$(document).ready(function() {

		$('#office_table').dataTable({
		stateSave: true,
		'deferRender': true,
		'pageLength': 10,
        dom: 'Blfrtip',
        buttons: [
		{
            text: 'Refresh',
			className: 'btn btn-default',
            action: function ( e, dt, node, config ) {
				genbranch_datatable();
            }
		}],
		});
		$('div.dataTables_wrapper').addClass('form-group');
		$('div.dt-buttons').css({'display':'inline-block','margin-left':'2%'});
		$('div.dataTables_length').css({'float':'left','font-family':'Open Sans','font-size':'14px'});
		$('div.dataTables_filter input').addClass('form-control');
		$('div.dataTables_filter input').attr('placeholder', 'Search' );
		$('div.dataTables_filter').css({'color':'transparent','font-size':'1px'});
	});";
?>
