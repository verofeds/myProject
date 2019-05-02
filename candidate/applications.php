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

	echo '<div class="container"><br>
	<pre>>> Browse Jobs</pre><hr>
	<div class="col-md-12 well">
		<div class="col-md-1">
			<label class="control-label">Filters:- </label>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<select class="selectpicker form-control" name="filter_category" id="filter_category">
					<option value="">- Select Category -</option>';
						foreach($get_alljobcategory as $row)
						{
							$code = $row['code'];
							$name = $row['name'];
							echo '<option value="'.$code.'">'.$name.'</option>';
						}
				echo '</select>
			</div> 
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<select class="selectpicker form-control" name="filter_type" id="filter_type">
					<option value="">- Select Type - </option>';
					foreach($get_alljobtype as $row)
					{
						$code = $row['code'];
						$name = $row['name'];
						echo '<option value="'.$code.'">'.$name.'</option>';
					}
				echo '</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<select class="selectpicker form-control" name="filter_location" id="filter_location">
					<option value=""> - Select Location - </option>';
					foreach($get_alljoblocation as $prow)
					{
						if($prow['code'] == $resume_job_location)
							echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
						else
							echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
					}
				echo '</select>
			</div>
		</div>
		<div class="col-md-2">
			<button class="btn btn-info" type="button" onclick=apply_filter();>Apply</button>
		</div>
	</div>
	
	<div class="col-md-12" id="application_body_div">
		
		
	</div>
	</div>
			
<div class="modal fade" id="view_detailsofjob" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Job Details</h4>
        </div>
        <div class="modal-body col-md-12">
			<div id="body_job" class="col-md-12"></div>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
    </div>
  </div>';
		
echo "<script>

$(document).ready(function(){

	$.ajax({
	  type: 'GET',
	  url:'candidate/get_application_body.php',
	  async:true,
	  cache:false,
	  success:function(result){
		$('#application_body_div').html(result);
	  }
	});
  
});

function apply_filter()
{
	var category = $('#filter_category').val();
	var location = $('#filter_location').val();
	var type = $('#filter_type').val();
	
	$.ajax({
	  type: 'POST',
	  url:'candidate/apply_filter.php',
	  data: {
			category : category,
			location : location,
			type : type
		},
	  success:function(result){
			$('#application_body_div').html(result);
		}
	});
}

function getcompanyinfo(userid)
{
	$.ajax({
	  type: 'POST',
	  url:'candidate/showdata.php',
	  data: {
			userid : userid,
		},
	  success:function(result){
			$('#showcompanyinfo').html(result);
		}
	});
}

function getjobdetails(userid,jobid)
{
	$.ajax({
	  type: 'POST',
	  url:'candidate/getjobdetails.php',
	  data: {
			userid : userid,
			jobid : jobid,
		},
	  success:function(result){
			$('#body_job').html(result);
		}
	});
}


</script>";
?>