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
$get_alljoblocation = $db->get_alljoblocation();
$get_alljobqualification = $db->get_alljobqualification();
$get_alljobexperience = $db->get_alljobexperience();
$get_alljobskills = $db->get_alljobskills();

	echo '<div class="container"><br>
			<pre>>> Job Submission Form</pre><hr>
		<div class="col-md-12 well">
			<form id="jobposts_form">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="job_title">Job Title <span style="color:red;">*</span></label>
						<input type="text" class="form-control" placeholder="Job Title" id="job_title" name="job_title">
					 </div>
				</div>
				 <div class="col-md-3">
					
						<div class="form-group">
						<label class="control-label" for="job_type">Job Type <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="job_type" id="job_type">
						<option value="">- Select Job Type - </option>';
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
						<label class="control-label" for="expiry_date">Expiry Date <span style="color:red;">*</span></label>
						<input type="text" placeholder="Expiry Date"  id="expiry_date" name="expiry_date" class="form-control" />
		            </div>
				</div>
				  <div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="job_category">Job Category <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="job_category" id="job_category">
						<option value="">- Select Job Category -</option>';
						foreach($get_alljobcategory as $row)
						{
							$code = $row['code'];
							$name = $row['name'];
							echo '<option value="'.$code.'">'.$name.'</option>';
						}
					echo '</select>
					</div> 
					<div class="form-group">
						<label for="job_gender">Gender</label>
						<select class="selectpicker form-control" name="job_gender" id="job_gender">
						<option value="">- Select Gender -</option>
						<option value="A">Any</option>
						<option value="M">Male</option>
						<option value="F">Female</option>
						<option value="T">Transgender</option>
						<option value="O">Others</option>
						</select>
					</div> 
					<div class="form-group">
						<label>Select Skills Required <span style="color:red;">*</span></label>
						<select class="form-control js-example-basic-multiple" id="job_skills_new" name="job_skills[]" multiple="multiple">
						  <option value="">- Select Skills Required -</option>';
							foreach($get_alljobskills as $row)
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
						<label for="job_salary"> Salary Offered <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="job_salary" id="job_salary">
							<option value="">- Select Range - </option>';
							foreach($get_allsalary as $row)
							{
								$code = $row['code'];
								$name = $row['name'];
								echo '<option value="'.$code.'">'.$name.'</option>';
							}
					echo '</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="job_qualification">Qualification <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="job_qualification" id="job_qualification">
						<option value="">- Highest Qualification Required -</option>';
							foreach($get_alljobqualification as $row)
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
						<label class="control-label" for="job_designation">Designation <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="job_designation" id="job_designation">
							<option value=""> - Select Designation -</option>';
							foreach($get_alljobdesignation as $row)
							{
								$code = $row['code'];
								$name = $row['name'];
								echo '<option value="'.$code.'">'.$name.'</option>';
							}
						echo '</select>

					</div>
					<div class="form-group">
						<label class="control-label" for="job_vacancy">Vacancy <span style="color:red;">*</span></label>
						<input type="text" class="form-control" maxlength="4" placeholder="Vacancy" id="job_vacancy" name="job_vacancy">
					</div>
				  </div>
				  <div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="job_experience">Experience <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="job_experience" id="job_experience">
							<option value=""> - Select Number of Years - </option>';
							foreach($get_alljobexperience as $row)
							{
								$code = $row['code'];
								$name = $row['name'];
								echo '<option value="'.$code.'">'.$name.'</option>';
							}
							echo '</select>
					</div>
					<div class="form-group">
					<label for="job_location">Job Location <span style="color:red;">*</span></label>
					<select class="selectpicker form-control" name="job_location" id="job_location">
						<option value=""> - Select City - </option>';
							foreach($get_alljoblocation as $row)
							{
								$code = $row['code'];
								$name = $row['name'];
								echo '<option value="'.$code.'">'.$name.'</option>';
							}
					echo '</select>
				  </div>
				  </div>
				 <hr style="border:0;clear:both;display:block;width: 96%;height: 1px;">
				 <div class="col-md-6">
				 
					<div class="form-group">
						<label for="job_eligibility">Education and Experience <span style="color:red;">*</span></label>
						<textarea class="form-control" rows="5" id="job_eligibility" name="job_eligibility" placeholder="Eligibility Criteria"></textarea>
					</div>
					<div class="form-group">
						<label for="job_perks">Perks of Joining:</label>
						<textarea class="form-control" rows="3" id="job_perks" name="job_perks" placeholder="Certificates, Incentives or other benefits"></textarea>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
						<label for="job_desc">Job Description:</label>
						<textarea class="form-control" rows="5" id="job_desc" name="job_desc" placeholder="Roles and Responsibilities"></textarea>
					</div>
					<div class="form-group">
						<label for="job_musthave">Must Have	:</label>
						<textarea class="form-control" rows="3" id="job_musthave" name="job_musthave" placeholder="Qualities or Special Skills Preferred...."></textarea>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="job_qts1">Assessment Question 1</label>
						<input type="text" class="form-control" id="job_qts1" name="job_qts1" placeholder="Eg. Why should we hire you?" id="email">
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
						<label for="pwd">Assessment Question 2</label>
						<input type="text" class="form-control" id="job_qts2" name="job_qts2" placeholder="Eg. What are your core team building qualities?"/>
					</div>
				  </div>
				  <input type="submit" class="btn btn-success pull-right" value="Save Your Job"/>
			</form>
		</div></div>';
		
echo "<script>
		$(document).ready(function(){
		var dateFormat = $(this).attr('data-vat-rate');
	        $('#expiry_date').datepicker({
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
	$('#jobposts_form').validate({

		rules: {
		    job_type: 'required',
			expiry_date: 'required',
			job_title: 'required',
			job_category: 'required',
			job_salary: 'required',
			job_designation: 'required',
			job_experience: 'required',
			job_qualification: 'required',
			job_vacancy: 'required',
			job_location: 'required',
			job_eligibility: 'required',
			
		},
		messages:{
		    job_type: 'Please Select Job Type',
			expiry_date: 'Please Enter an Expiry Date',
			job_title: 'Please Enter a Job Title',
			job_category: 'Please Select a Job Category',
			job_salary: 'Please Select Salary',
			job_designation: 'Please Select Designation',
			job_experience: 'Select Experience (in years)',
			job_qualification: 'Please Select Minimum Qualification',
			job_vacancy: 'Please Enter Number of Vacancies',
			job_location: 'Please Select Location',
			job_eligibility: 'Please Write About the Eligibility Criteria',
		},
		submitHandler: function(form) {
            add_jobposts();
      	}	
		});
	});
	
	function add_jobposts()
	{
		/*var job_skillsarray = [];
		var job_skills = $('#job_skills').select2('data');

		for(a=0; a < job_skills.length; a++)  {
			job_skillsarray.push(job_skills[a].value);
		}
		alert(job_skills);
		var jsonjob_skillsarray = JSON.stringify(job_skillsarray);
		alert($('#job_skills').select2('data'));*/
		
		var job_skill = [];
		var selected = $('#job_skills_new option:selected');
        selected.each(function () {
            job_skill.push($(this).val());
		});
		var job_skillstring = JSON.stringify(job_skill);
		//alert(job_skillstring);
		
		var job_title = $('#job_title').val();
		var job_type = $('#job_type').val();
		var expiry_date = $('#expiry_date').val();
		var job_category = $('#job_category').val();
		var job_salary = $('#job_salary').val();
		var job_designation = $('#job_designation').val();
		var job_experience = $('#job_experience').val();
		var job_qualification = $('#job_qualification').val();
		var job_vacancy = $('#job_vacancy').val();
		var job_location = $('#job_location').val();
		var job_eligibility = $('#job_eligibility').val();
		var job_gender = $('#job_gender').val();
		var job_desc = $('#job_desc').val();
		var job_perks = $('#job_perks').val();
		var job_musthave = $('#job_musthave').val();
		var job_qts1 = $('#job_qts1').val();
		var job_qts2 = $('#job_qts2').val();
		//alert(jsonjob_skillsarray);
			$.ajax({
			  type: 'POST',
			  url:'company/add_jobposts.php',
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
					},
					success:function(result){
					 alert(result);
					  $('#jobposts_form').trigger('reset');
					  
					  exampleMulti.val(null).trigger('change');
				}
			});
		
	}
</script>";
?>