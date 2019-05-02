<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];

$get_alljobtype = $db->get_alljobtype();
$get_alljobcategory = $db->get_alljobcategory();
$get_allsalary = $db->get_allsalary();
$get_alljoblocation = $db->get_alljoblocation();
$get_alljobdesignation = $db->get_alljobdesignation();
$get_alljobqualification = $db->get_alljobqualification();
$get_alljobexperience = $db->get_alljobexperience();
$get_alljobskills = $db->get_alljobskills();

$jobid = $_POST['jobid'];
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
}
echo '
	<div class="col-md-12">
	<form id="edit_jobposts_form">
				
				 <div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="edit_job_title">Job Title <span style="color:red;">*</span></label>
						<input type="text" class="form-control" value="'.$job_title.'" placeholder="Job Title" id="edit_job_title" name="edit_job_title">
						<input type="hidden" id="jobid_for_update" value="'.$jobid.'"/>
					 </div>
					<div class="form-group">
						<label class="control-label" for="edit_job_category">Job Category <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="edit_job_category" id="edit_job_category">
						<option value="">- Select Job Category -</option>';
						foreach($get_alljobcategory as $prow)
						{
							if($prow['code'] == $job_category)
							{
								echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
							}
							else
							{
								echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
							}
						}
					echo '</select>
					</div> 
					<div class="form-group">
						<label for="edit_job_gender">Gender</label>
						<select class="selectpicker form-control" name="edit_job_gender" id="edit_job_gender">
						<option value="">- Select Gender -</option>';
						if($job_gender == "A")
						{
							echo '<option value="A" selected>Any</option>
							<option value="M">Male</option>
							<option value="F">Female</option>
							<option value="T">Transgender</option>
							<option value="O">Others</option>';
						}
						if($job_gender == "M")
						{
							echo '<option value="A">Any</option>
							<option value="M" selected>Male</option>
							<option value="F">Female</option>
							<option value="T">Transgender</option>
							<option value="O">Others</option>';
						}
						if($job_gender == "F")
						{
							echo '<option value="A">Any</option>
							<option value="M" >Male</option>
							<option value="F" selected>Female</option>
							<option value="T">Transgender</option>
							<option value="O">Others</option>';
						}
						if($job_gender == "T")
						{
							echo '<option value="A">Any</option>
							<option value="M" >Male</option>
							<option value="F">Female</option>
							<option value="T" selected>Transgender</option>
							<option value="O">Others</option>';
						}
						if($job_gender == "O")
						{
							echo '<option value="A">Any</option>
							<option value="M" >Male</option>
							<option value="F">Female</option>
							<option value="T" >Transgender</option>
							<option value="O" selected>Others</option>';
						}
						echo '</select>
					</div> 
					
				</div>
				
				 <div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="edit_job_type">Job Type <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="edit_job_type" id="edit_job_type">
						<option value="">- Select Job Type - </option>';
						foreach($get_alljobtype as $prow)
						{
							if($prow['code'] == $job_type)
							{
								echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
							}
							else
							{
								echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
							}
						}
					echo '</select>
					 </div>
					 <div class="form-group">
						<label class="control-label" for="edit_job_designation">Designation <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="edit_job_designation" id="edit_job_designation">
							<option value=""> - Select Designation -</option>';
							foreach($get_alljobdesignation as $prow)
							{
								if($prow['code'] == $job_designation)
								{
									echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
								}
								else
								{
									echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
								}
							}
						echo '</select>

					</div>
					<div class="form-group">
						<label class="control-label" for="edit_job_vacancy">Vacancy <span style="color:red;">*</span></label>
						<input type="text" class="form-control" value="'.$job_vacancy.'" maxlength="4" placeholder="Vacancy" id="edit_job_vacancy" name="edit_job_vacancy">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="edit_expiry_date">Expiry Date <span style="color:red;">*</span></label>
						<input type="text" placeholder="Expiry Date" value="'.$expiry_date.'" id="edit_expiry_date" name="edit_expiry_date" class="form-control" />
		            </div>
					<div class="form-group">
						<label class="control-label" for="edit_job_experience">Experience <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="edit_job_experience" id="edit_job_experience">
							<option value=""> - Select Number of Years - </option>';
							foreach($get_alljobexperience as $prow)
							{
								if($prow['code'] == $job_experience)
									echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
								else
									echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
							}
							echo '</select>
					</div>
					<div class="form-group">
					<label for="edit_job_location">Job Location <span style="color:red;">*</span></label>
					<select class="selectpicker form-control" name="edit_job_location" id="edit_job_location">
						<option value=""> - Select City - </option>';
							foreach($get_alljoblocation as $prow)
							{
								if($prow['code'] == $job_location)
									echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
								else
									echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
							}
					echo '</select>
				  </div>
				</div>
				 
				   <div class="col-md-3">
					<div class="form-group">
						<label for="edit_job_salary"> Salary Offered <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="edit_job_salary" id="edit_job_salary">
							<option value="">- Select Range - </option>';
							foreach($get_allsalary as $prow)
							{
								if($prow['code'] == $job_salary)
									echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
								else
									echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
							}
					echo '</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="edit_job_qualification">Qualification <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="edit_job_qualification" id="edit_job_qualification">
						<option value="">- Highest Qualification Required -</option>';
							foreach($get_alljobqualification as $prow)
							{
								if($prow['code'] == $job_qualification)
									echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
								else
									echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
							}
						echo '</select>
					</div>
					<div class="form-group">
						<label>Select Skills Required <span style="color:red;">*</span></label>
						<select class="form-control js-example-basic-multiple" style="width:200px" id="edit_job_skills_new" name="edit_job_skills[]" multiple="multiple">';
						  $branchstaff=array();
                          $branchstaff[]='';
						  $branch = "";
                          $branches = json_decode($job_skills, true);
                          foreach ((array)$branches as $row) {
                                    $branchstaff[]=$row;
                          }
                          foreach ((array)$get_alljobskills as $getrow) {
                              $allbranch = $getrow["code"];
                              if (array_search($allbranch,$branchstaff)) {
                                                echo '<option value="' . $getrow["code"] . '" selected>'.$getrow["name"].'</option>';
                                            }
                                            else{
                                                 echo '<option value="' . $getrow["code"] . '">'.$getrow["name"].'</option>';
                                            }
                                        }
						echo '</select>
					</div>
				  </div>
				 
				 <hr style="border:0;clear:both;display:block;width: 96%;height: 1px;">
				 <div class="col-md-6">
				 
					<div class="form-group">
						<label for="edit_job_eligibility">Education and Experience <span style="color:red;">*</span></label>
						<textarea class="form-control" rows="5" id="edit_job_eligibility" name="edit_job_eligibility" placeholder="Eligibility Criteria">'.$job_eligibility.'</textarea>
					</div>
					<div class="form-group">
						<label for="edit_job_perks">Perks of Joining:</label>
						<textarea class="form-control" rows="3" id="edit_job_perks" name="edit_job_perks" placeholder="Certificates, Incentives or other benefits">'.$job_perks.'</textarea>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
						<label for="edit_job_desc">Job Description:</label>
						<textarea class="form-control" rows="5" id="edit_job_desc" name="edit_job_desc" placeholder="Roles and Responsibilities">'.$job_desc.'</textarea>
					</div>
					<div class="form-group">
						<label for="edit_job_musthave">Must Have	:</label>
						<textarea class="form-control" rows="3" id="edit_job_musthave" name="edit_job_musthave" placeholder="Qualities or Special Skills Preferred....">'.$job_musthave.'</textarea>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="edit_job_qts1">Assessment Question 1</label>
						<input type="text" class="form-control" id="edit_job_qts1" value="'.$job_qts1.'" name="edit_job_qts1" placeholder="Eg. Why should we hire you?" id="email">
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
						<label for="edit_job_qts2">Assessment Question 2</label>
						<input type="text" class="form-control" id="edit_job_qts2" value="'.$job_qts2.'" name="edit_job_qts2" placeholder="Eg. What are your core team building qualities?"/>
					</div>
				  </div>
				  <input type="submit" class="btn btn-success pull-right" value="Save Your Job"/>
			</form>
</div>';

echo "<script>
		$(document).ready(function(){
		var dateFormat = $(this).attr('data-vat-rate');
	        $('#edit_expiry_date').datepicker({
	            format: dateFormat,
	            showClose: true,
				autoclose: true,
	            todayHighlight: true,
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        autoclose: true,
		        changeMonth: true,
		        changeYear: true,
		        orientation: 'button'
	        });
			
		 $('.js-example-basic-multiple').select2();
		 
		  
	    });
		
		$(function(){
	$('#edit_jobposts_form').validate({

		rules: {
		    edit_job_type: 'required',
			edit_expiry_date: 'required',
			edit_job_title: 'required',
			edit_job_category: 'required',
			edit_job_salary: 'required',
			edit_job_designation: 'required',
			edit_job_experience: 'required',
			edit_job_qualification: 'required',
			edit_job_vacancy: 'required',
			edit_job_location: 'required',
			edit_job_eligibility: 'required',
			
		},
		messages:{
		    edit_job_type: 'Please Select Job Type',
			edit_expiry_date: 'Please Enter an Expiry Date',
			edit_job_title: 'Please Enter a Job Title',
			edit_job_category: 'Please Select a Job Category',
			edit_job_salary: 'Please Select Salary',
			edit_job_designation: 'Please Select Designation',
			edit_job_experience: 'Select Experience (in years)',
			edit_job_qualification: 'Please Select Minimum Qualification',
			edit_job_vacancy: 'Please Enter Number of Vacancies',
			edit_job_location: 'Please Select Location',
			edit_job_eligibility: 'Please Write About the Eligibility Criteria',
		},
		submitHandler: function(form) {
            update_jobposts();
      	}	
		});
	});
	
	function update_jobposts()
	{
		var job_skill = [];
		var selected = $('#edit_job_skills_new option:selected');
        selected.each(function () {
            job_skill.push($(this).val());
		});
		var job_skillstring = JSON.stringify(job_skill);
		
		var job_title = $('#edit_job_title').val();
		var job_type = $('#edit_job_type').val();
		var expiry_date = $('#edit_expiry_date').val();
		var job_category = $('#edit_job_category').val();
		var job_salary = $('#edit_job_salary').val();
		var job_designation = $('#edit_job_designation').val();
		var job_experience = $('#edit_job_experience').val();
		var job_qualification = $('#edit_job_qualification').val();
		var job_vacancy = $('#edit_job_vacancy').val();
		var job_location = $('#edit_job_location').val();
		var job_eligibility = $('#edit_job_eligibility').val();
		var job_gender = $('#edit_job_gender').val();
		var job_desc = $('#edit_job_desc').val();
		var job_perks = $('#edit_job_perks').val();
		var job_musthave = $('#edit_job_musthave').val();
		var job_qts1 = $('#edit_job_qts1').val();
		var job_qts2 = $('#edit_job_qts2').val();
		var jobid_for_update = $('#jobid_for_update').val();
		//alert(jsonjob_skillsarray);
			$.ajax({
			  type: 'POST',
			  url:'company/update_jobposts.php',
			  data: {
					 job_title : job_title,
					 job_type : job_type,
					 expiry_date : expiry_date,
					 job_category : job_category,
					 job_salary : job_salary,
					 job_designation : job_designation,
					 job_experience : job_experience,
					 job_qualification : job_qualification,
					 job_vacancy : job_vacancy,
					 job_location : job_location,
					 job_eligibility : job_eligibility,
					 job_gender : job_gender,
					 job_desc : job_desc,
					 job_perks : job_perks,
					 job_musthave : job_musthave,
					 job_qts1 : job_qts1,
					 job_qts2 : job_qts2,
					 job_skillstring : job_skillstring,
					 jobid_for_update : jobid_for_update
					},
					success:function(result){
					 
					  $('#edit_jobposts_form').trigger('reset');
					  $('#edit_jobposts').modal('hide');
					  alert(result);
					  exampleMulti.val(null).trigger('change');
				}
			});
		
	}
</script>";
?>