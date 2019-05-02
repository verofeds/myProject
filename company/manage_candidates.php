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

$get_jobsapplied = $db->get_jobsapplied($userid);

echo '
<div class="container"><br>
	
	<div class="col-md-12 well">
		<span style="font-weight:bold;">>> Manage Candidates</span> (Only Shortlisted Candidates Will Be Shown)
		<select class="form-control pull-right" style="max-width:30%;height:30px;" name="select_job" id="select_job">
			<option value=""> - Select Company To Show Candidates - </option>';
				foreach($get_alljobs as $row)
				{
					$value = $row["jobid"];
					$name = $row["job_title"];
					echo '<option value="'.$value.'">'.$name.'</option>';
				}
		echo '</select>
		<hr>
		
		<div class="col-md-12" id="get_candidate_job">
			<h3 style="text-align:center;">Please Select a Job Post</h3>
		</div>
	
	</div>
	
</div>';

echo '<script>
$("#select_job").on("change", function() {
	
	
	var jobid = $("#select_job").val();
	if(jobid)
	{
	   $.ajax({
		type: "POST",
		url: "company/get_shortlisted_candidates.php",
		data: {
			jobid : jobid,
			},
			success:function(result){
				$("#get_candidate_job").html(result);
			}
		});
	
	}
	else{
		$("#get_candidate_job").html("No Candidates Found!");
	}
	});
</script>';
?>
