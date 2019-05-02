<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];
$datetime = date("d-m-Y");
$get_alljobs = $db->get_alljobs($userid);
$get_alljobtype = $db->get_alljobtype();
$get_allsalary = $db->get_allsalary();
$get_alljoblocation = $db->get_alljoblocation();
$count = 0;
echo '
<div class="container"><br>
	<pre>>> Manage Jobs	</pre><hr>
	<div class="well">';
if($get_alljobs)
{
		echo '<table class="table table-striped">
    <thead>
      <tr class="warning">
        <th style="text-align:center;" width="10%">Date</th>
		<th  width="30%">Job Title</th>
        <th style="text-align:center;" width="7%">Applicants</th>
        <th style="text-align:center;" width="15%">Job Type</th>
		 <th style="text-align:center;" width="20%">Status</th>
		  <th style="text-align:center;" width="10%">Actions</th>
      </tr>
    </thead><tbody>';

	foreach($get_alljobs as $row)
	{
		$jobid = $row['jobid'];
		$job_title = $row['job_title'];
		$job_type = $row['job_type'];
		$expiry_date = date('d-m-Y', strtotime($row["expiry_date"]));
		$created_on = date('d-m-Y', strtotime($row["created_on"]));
		$job_salary = $row['job_salary'];
		$job_location = $row['job_location'];
		$team_size = $row['job_vacancy'];
		
		$get_jobsapplied_only = $db->get_jobsapplied_only($jobid);
		$count = 0;
		if($get_jobsapplied_only)
		{
			foreach($get_jobsapplied_only as $wrow)
			{
				$count++;
			}
		}
		
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
    echo '
      <tr>
		<td style="text-align:center;">'.$created_on.'</td>
        <td >'.$job_title.'<br/><p style="font-size:12px;"><i class="fa fa-map-marker " style="color:red;" aria-hidden="true"></i>&nbsp;&nbsp;'.$job_location.'&nbsp;&nbsp;<i class="fa fa-calendar" style="color:black;" aria-hidden="true"></i>&nbsp;&nbsp;Expiring on '.$expiry_date.'<br/><i class="fa fa-money" style="color:green;" aria-hidden="true"></i>&nbsp;&nbsp;'.$job_salary.' <i class="fa fa-users" style="color:#FF7F50;" aria-hidden="true"></i>&nbsp;&nbsp;'.$team_size.'</p></td>
        <td style="text-align:center;"><a href="#" data-toggle="modal" data-target="#show_applicants" onclick=show_applicants("'.$jobid.'");>'.$count.'</a></td>
        <td style="text-align:center;">'.$job_type.'</td>
		<td style="text-align:center;">';
		//$diff= date_diff(date_create($expiry_date),date_create($datetime),absolute);
		if(strtotime($expiry_date) < strtotime($datetime))
		{
			
			echo '<span style="color:black;">Expired</span></td>';
		}
		else
		{
			echo '<span style="color:red;">Active</span></td>';
		}
		echo '<td style="text-align:center;"><a onclick=edit_jobposts("'.$jobid.'") data-toggle="modal" data-target="#edit_jobposts" class="btn btn-warning btn-xs"><span class="fa fa-pencil" title="Edit" aria-hidden="true"></span></a>&nbsp;
			<a class="btn btn-danger btn-xs" title="Delete this Post" onclick=delete_job("'.$userid.'","'.$jobid.'");><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;
			<a class="btn btn-info btn-xs" title="View Selected Candidates" data-toggle="modal" data-target="#v_selected_cand" onclick=view_hired("'.$jobid.'");><span class="fa fa-address-card-o" aria-hidden="true"></span></a></td>
      </tr>';
	}

  echo '</tbody></table>';
  }
  else{
	  echo '<h1 style="text-align:center;">No applications found</h1>';
  }
	echo '</div>
</div>

<div class="modal fade" id="edit_jobposts" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Edit Job Details</h4>
        </div>
        <div class="modal-body col-md-12">
			<div id="edit_jobposts_body" class="col-md-12"></div>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="v_selected_cand" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Listing Selected Candidates</h4>
        </div>
        <div class="modal-body col-md-12">
			<div id="v_selected_cand_body" class="col-md-12"></div>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="show_applicants" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Applicants</h4>
        </div>
        <div class="modal-body col-md-12">
			<div id="show_applicants_body" class="col-md-12"></div>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
    </div>
  </div>';

echo "<script>
function delete_job(userid,jobid)
{
	$.ajax({
		type: 'POST',
		url:'company/delete_jobposts.php',
		data: {
			userid : userid,
			jobid : jobid,
			},
			success:function(result){
				alert(result);
				managejobs();
			}
	});
}

function edit_jobposts(jobid)
{
	$.ajax({
		type: 'POST',
		url:'company/edit_jobposts.php',
		data: {
			jobid : jobid,
			},
		success:function(result){
			$('#edit_jobposts_body').html(result);
		}
	});
}

function show_applicants(jobid)
{
	$.ajax({
		type: 'POST',
		url:'company/show_applicants.php',
		data: {
			jobid : jobid,
			},
		success:function(result){
			$('#show_applicants_body').html(result);
		}
	});
}

function view_hired(jobid)
{
	$.ajax({
		type: 'POST',
		url:'company/view_hired.php',
		data: {
			jobid : jobid,
			},
		success:function(result){
			$('#v_selected_cand_body').html(result);
		}
	});
}
</script>";

?>
