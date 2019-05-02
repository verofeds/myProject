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
$get_year = $db->get_year();
$get_candidate_data = $db->get_candidate_data($userid);

$check_ifresume_exixts = $db->check_ifresume_exixts($userid);
if($get_candidate_data){
	foreach($get_candidate_data as $row)
	{
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$mobile_no = $row['mobile_no'];
	}
}
		echo '<div class="container"><br>
				<ul class="nav nav-tabs" role="tablist">
	  <li class="active"><a href="#home" role="tab" data-toggle="tab" aria-expanded="true">Add / Edit</a></li>
	  <li><a href="#profile" role="tab" data-toggle="tab" onclick="get_resume();" aria-expanded="false">View</a></li>
	</ul>

	<div class="tab-content">
	  <div class="tab-pane active" id="home">';
	  if(!$check_ifresume_exixts)
	 {
			echo '<div class="col-md-12 well">
			<form id="resume_details_form">
			<b>Personal Details</b><hr class="style-one"/>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="resume_first_name">First Name <span style="color:red;">*</span></label>
						<input type="text" class="form-control" value="'.$first_name.'" placeholder="First Name" id="resume_first_name" name="resume_first_name" disabled>
					  </div>
					  <div class="form-group">
						<label for="resume_address">Address <span style="color:red;">*</span></label>
						<input type="text" placeholder="Address" class="form-control" id="resume_address" name="resume_address">
					  </div>
					  <div class="form-group">
						<label for="resume_email">Email <span style="color:red;">*</span></label>
						<input type="email" placeholder="Email" class="form-control" id="resume_email" name="resume_email">
					  </div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="resume_last_name">Last Name <span style="color:red;">*</span></label>
						<input type="text" class="form-control" value="'.$last_name.'" placeholder="Last Name" id="resume_last_name" name="resume_last_name" disabled>
					  </div>
					  <div class="form-group">
						<label for="resume_city">City <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="resume_city" id="resume_city">
							<option value=""> - Select City - </option>';
								foreach($get_alljoblocation as $row)
								{
									$code = $row['code'];
									$name = $row['name'];
									echo '<option value="'.$code.'">'.$name.'</option>';
								}
						echo '</select>
					  </div>
					   <div class="form-group">
						<label for="resume_mobile">Mobile No <span style="color:red;">*</span></label>
						<input type="text" placeholder="Mobile No" value="'.$mobile_no.'" class="form-control" id="resume_mobile" name="resume_mobile" disabled>
					  </div>
				</div>
				
				<div class="col-md-3">
						<div class="form-group">
							<label for="resume_gender">Gender <span style="color:red;">*</span></label>
							<select class="selectpicker form-control" name="resume_gender" id="resume_gender">
							<option value="">- Select Gender -</option>
							<option value="M">Male</option>
							<option value="F">Female</option>
							<option value="T">Transgender</option>
							<option value="O">Others</option>
							</select>
						</div> 
					  <div class="form-group">
						<label for="resume_pincode">Pin Code</label>
						<input type="text" placeholder="Pin Code" class="form-control" id="resume_pincode" name="resume_pincode">
					  </div>
					  <div class="form-group">
						<label for="resume_aadhar">Aadhar No </label>
						<input type="text" placeholder="Aadhar No" class="form-control" id="resume_aadhar" name="resume_aadhar">
					  </div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="date_ofbirth">Date of Birth <span style="color:red;">*</span></label>
						<input type="text" placeholder="Date of Birth" id="date_ofbirth" name="date_ofbirth" class="form-control" />
					</div>
					<div class="form-group">
						<label for="resume_pan">PAN No </label>
						<input type="text" placeholder="PAN No" class="form-control" id="resume_pan" name="resume_pan">
					</div>
					<div class="form-group">
						<label class="control-label" for="resume_state">Qualification <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="resume_state" id="resume_state">
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
				
				<b>Educational Details</b><hr class="style-one"/>
				<div class="col-md-12" id="div_school">
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_school">School Name</label>
							<input type="text" placeholder="School Name" class="form-control" id="resume_school" name="resume_school">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_board">Board</label>
							<input type="text" placeholder="Board" class="form-control" id="resume_board" name="resume_board">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_school_year">Year of Completion</label>
							<select class="selectpicker form-control" name="resume_school_year" id="resume_school_year">
								<option value=""> - Select Year -</option>';
								foreach($get_year as $row)
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
							<label for="school_marks">Percentage</label>
							<input type="text" placeholder="Percentage" class="form-control" id="school_marks" name="school_marks">
						</div>
					</div>
				</div>
				<div class="col-md-12" id="div_graduation">
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_college">College / High School Name</label>
							<input type="text" placeholder="College / High School Name" class="form-control" id="resume_college" name="resume_college">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_college_stream">Stream</label>
							<select class="selectpicker form-control" name="resume_college_stream" id="resume_college_stream">
								<option value=""> - Select Stream -</option> 
								<option value="100">Arts</option> 
								<option value="101">Commerce</option> 
								<option value="102">Science</option> 
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_college_year">Year of Completion</label>
							<select class="selectpicker form-control" name="resume_college_year" id="resume_college_year">
								<option value="">- Select Year -</option>';
								foreach($get_year as $row)
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
							<label for="resume_college_marks">Percentage</label>
							<input type="text" placeholder="Percentage" class="form-control" id="resume_college_marks" name="resume_college_marks">
						</div>
					</div>
				</div>
				<div class="col-md-12" id="div_grad">
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_degree_name">College Name</label>
							<input type="text" placeholder="College Name" class="form-control" id="resume_degree_name" name="resume_degree_name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_degree_stream">Degree</label>
							<select class="selectpicker form-control" id="resume_degree_stream" name="resume_degree_stream">
								<option value=""> - Select Stream -</option>
								<option value="100">Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option>
									<option value="106">BScIT</option>
								</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_degree_year"> - Year of Completion -</label>
							<select class="selectpicker form-control" name="resume_degree_year" id="resume_degree_year">
								<option value=""> - Select Year -</option>';
								foreach($get_year as $row)
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
							<label for="resume_degree_marks">Percentage / CGPA</label>
							<input type="text" placeholder="Percentage" class="form-control" id="resume_degree_marks" name="resume_degree_marks">
						</div>
					</div>
				</div>
				<div class="col-md-12" id="div_postgrad">
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_pg_name">College / University Name </label>
							<input type="text" placeholder="College Name" class="form-control" id="resume_pg_name" name="resume_pg_name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_pg_stream">Degree</label>
							<select class="selectpicker form-control" name="resume_pg_stream" id="resume_pg_stream">
								<option value=""> - Select Stream -</option> 
								<option value="100">Masters in Commerce</option> 
									<option value="101">Masters in Literature</option> 
									<option value="102">MCA</option> 
									<option value="103">Masters in Business Management</option> 
									<option value="104">Master of Science (M.Sc.) </option>
									<option value="105">Master of Financial Management (M.F.M. )</option>
									<option value="106">MScIT</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resume_pg_year">Year of Completion</label>
							<select class="selectpicker form-control" name="resume_pg_year" id="resume_pg_year">
								<option value=""> - Select Year -</option> ';
								foreach($get_year as $row)
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
							<label for="resume_pg_marks">Percentage / CGPA</label>
							<input type="text" placeholder="Percentage" class="form-control" id="resume_pg_marks" name="resume_pg_marks">
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
				<b>Experience (Details of Previous Organization)</b><hr class="style-one"/>
					<div class="col-md-6">
						<div class="col-md-6">
								<div class="form-group">
									<label for="resume_org_name">Organization Name</label>
									<input type="text" placeholder="Organization Name" class="form-control" id="resume_org_name" name="resume_org_name">
								  </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="resume_job_profile">Job Profile </label>
									<select class="selectpicker form-control" name="resume_job_profile" id="resume_job_profile">
										<option value="">- Select Job Profile -</option>';
										foreach($get_alljobcategory as $row)
										{
											$code = $row['code'];
											$name = $row['name'];
											echo '<option value="'.$code.'">'.$name.'</option>';
										}
									echo '</select>
								</div> 
						
							</div>
						<div class="form-group">
								<label for="resume_job_description">Description </label>
								<textarea class="form-control"  id="resume_job_description" name="resume_job_description" placeholder="Short Description of Work Done "></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="resume_start_date">Start Date</label>
								<input type="text" placeholder="Start Date" id="resume_start_date" name="resume_start_date" class="form-control" />
							</div>
							<div class="form-group">
								<label class="control-label" for="resume_job_designation">Designation </label>
								<select class="selectpicker form-control" name="resume_job_designation" id="resume_job_designation">
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
								<label for="resume_job_exp">No of Years of Experience</label>
								<select class="selectpicker form-control" name="resume_job_exp" id="resume_job_exp">
									<option value="">- Select No of Years - </option>
									<option value="001">Less than months</option>
									<option value="001">1 Year</option>
									<option value="001">2 Years</option>
									<option value="002">3 Years</option>
									<option value="002">4 Years</option>
									<option value="003">5 Years</option>
									<option value="003">6 Years</option>
									<option value="003">7 Years</option>
									<option value="003">8 Years</option>
									<option value="004">9 Years</option>
									<option value="004">10 Years</option>
									<option value="004">Above 10 Years</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="resume_end_date">End Date</label>
								<input type="text" placeholder="End Date" id="resume_end_date" name="resume_end_date" class="form-control" />
							</div>
							<div class="form-group">
								<label for="resume_job_salary"> Salary Offered </label>
								<select class="selectpicker form-control" name="resume_job_salary" id="resume_job_salary">
									<option value="">- Select Range - </option>';
									foreach($get_allsalary as $row)
									{
										$code = $row['code'];
										$name = $row['name'];
										echo '<option value="'.$code.'">'.$name.'</option>';
									}
								echo '</select>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
				<b>Other Details</b><hr class="style-one"/>
				<div class="col-md-3">
					<div class="form-group">
						<label for="resume_worksamp">Work Samples</label>
						<input type="text" placeholder="Provide Links to your Projects" class="form-control" id="resume_worksamp" name="resume_worksamp">
					  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
							<label>Select Skills <span style="color:red;">*</span></label>
							<select class="form-control js-example-basic-multiple" id="resume_skills" name="resume_skills[]" multiple="multiple">
							  <option value="">- Select Skills -</option>';
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
						<label class="control-label" for="resume_job_type">Preferred Job Type <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="resume_job_type" id="resume_job_type">
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
						<label for="resume_job_location">Preferred Job Location <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="resume_job_location" id="resume_job_location">
							<option value=""> - Select Job Location - </option>';
								foreach($get_alljoblocation as $row)
								{
									$code = $row['code'];
									$name = $row['name'];
									echo '<option value="'.$code.'">'.$name.'</option>';
								}
						echo '</select>
					  </div>
				</div>
			</div>
				<br/>
				 <input type="submit" class="btn btn-success pull-right" value="Save Details"/>
				</form>
			</div>';
}
else
{
	$first_name = $check_ifresume_exixts['first_name'];
	$last_name = $check_ifresume_exixts['last_name'];
	$date_ofbirth = @date('d-m-Y', strtotime($check_ifresume_exixts["date_of_birth"]));
	$resume_gender = $check_ifresume_exixts['gender'];
	$resume_city = $check_ifresume_exixts['city'];
	$resume_state = $check_ifresume_exixts['state'];
	$resume_email = $check_ifresume_exixts['email'];
	$resume_mobile = $check_ifresume_exixts['mobile'];
	$resume_pincode = $check_ifresume_exixts['pincode'];
	$resume_pan = $check_ifresume_exixts['pan_no'];
	$resume_aadhar = $check_ifresume_exixts['aadhar_no'];
	$resume_address = $check_ifresume_exixts['address'];
	
	$resume_school = $check_ifresume_exixts['school_name'];
	$resume_board = $check_ifresume_exixts['school_board'];
	$resume_school_year = $check_ifresume_exixts['school_year'];
	$school_marks = $check_ifresume_exixts['school_marks'];
	$resume_college = $check_ifresume_exixts['high_school_name'];
	$resume_college_stream = $check_ifresume_exixts['high_school_stream'];
	$resume_college_year = $check_ifresume_exixts['high_school_year'];
	$resume_college_marks = $check_ifresume_exixts['high_school_marks'];
	$resume_degree_name = $check_ifresume_exixts['graduation_name'];
	$resume_degree_stream = $check_ifresume_exixts['graduation_stream'];
	$resume_degree_year = $check_ifresume_exixts['graduation_year'];
	$resume_degree_marks = $check_ifresume_exixts['graduation_marks'];
	$resume_pg_name = $check_ifresume_exixts['pg_name'];
	$resume_pg_stream = $check_ifresume_exixts['pg_stream'];
	$resume_pg_year = $check_ifresume_exixts['pg_year'];
	$resume_pg_marks = $check_ifresume_exixts['pg_marks'];
	$school = $check_ifresume_exixts['school'];
	$high_school = $check_ifresume_exixts['high_school'];
	$graduation = $check_ifresume_exixts['graduation'];
	$pg = $check_ifresume_exixts['pg'];
	
	$resume_org_name = $check_ifresume_exixts['org_name'];
	$resume_job_description = $check_ifresume_exixts['org_desc'];
	$resume_job_exp = $check_ifresume_exixts['org_experience'];
	$resume_job_profile = $check_ifresume_exixts['org_profile'];
	$resume_job_designation = $check_ifresume_exixts['org_designation'];
	$resume_worksamp = $check_ifresume_exixts['work_sample'];
	$org_salary = $check_ifresume_exixts['org_salary'];
	$resume_job_type = $check_ifresume_exixts['job_type'];
	$resume_job_location = $check_ifresume_exixts['job_location'];
	$org_start_date = @date('d-m-Y', strtotime($check_ifresume_exixts['org_start_date']));
	$org_end_date = @date('d-m-Y', strtotime($check_ifresume_exixts['org_end_date']));
	$skills = $check_ifresume_exixts['skills'];



	echo '<div class="col-md-12 well">
			<form id="resupdetails_form">
			<b>Personal Details</b><hr class="style-one"/>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="resupfirst_name">First Name <span style="color:red;">*</span></label>
						<input type="text" class="form-control" value="'.$first_name.'" placeholder="First Name" id="resupfirst_name" name="resupfirst_name" disabled>
					  </div>
					  <div class="form-group">
						<label for="resupaddress">Address <span style="color:red;">*</span></label>
						<input type="text" placeholder="Address" value="'.$resume_address.'" class="form-control" id="resupaddress" name="resupaddress">
					  </div>
					  <div class="form-group">
						<label for="resupemail">Email <span style="color:red;">*</span></label>
						<input type="email" placeholder="Email" value="'.$resume_email.'" class="form-control" id="resupemail" name="resupemail">
					  </div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="resuplast_name">Last Name <span style="color:red;">*</span></label>
						<input type="text" class="form-control" value="'.$last_name.'" placeholder="Last Name" id="resuplast_name" name="resuplast_name" disabled>
					  </div>
					  <div class="form-group">
						<label for="resupcity">City <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="resupcity" id="resupcity">
							<option value=""> - Select City - </option>';
							foreach($get_alljoblocation as $prow)
							{
								if($prow['code'] == $resume_city)
									echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
								else
									echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
							}
					echo '</select>
					  </div>
					   <div class="form-group">
						<label for="resupmobile">Mobile No <span style="color:red;">*</span></label>
						<input type="text" placeholder="Mobile No" value="'.$mobile_no.'" class="form-control" id="resupmobile" name="resupmobile" disabled>
					  </div>
				</div>
				
				<div class="col-md-3">
						<div class="form-group">
							<label for="resupgender">Gender <span style="color:red;">*</span></label>
							<select class="selectpicker form-control" name="resupgender" id="resupgender">';
							if($resume_gender == "M")
							{
								echo '<option value="A">Any</option>
								<option value="M" selected>Male</option>
								<option value="F">Female</option>
								<option value="T">Transgender</option>
								<option value="O">Others</option>';
							}
							if($resume_gender == "F")
							{
								echo '<option value="A">Any</option>
								<option value="M" >Male</option>
								<option value="F" selected>Female</option>
								<option value="T">Transgender</option>
								<option value="O">Others</option>';
							}
							if($resume_gender == "T")
							{
								echo '<option value="A">Any</option>
								<option value="M" >Male</option>
								<option value="F">Female</option>
								<option value="T" selected>Transgender</option>
								<option value="O">Others</option>';
							}
							if($resume_gender == "O")
							{
								echo '<option value="A">Any</option>
								<option value="M" >Male</option>
								<option value="F">Female</option>
								<option value="T" >Transgender</option>
								<option value="O" selected>Others</option>';
							}
							echo '</select>
						</div> 
					  <div class="form-group">
						<label for="resuppincode">Pin Code</label>
						<input type="text" placeholder="Pin Code" value="'.$resume_pincode.'" class="form-control" id="resuppincode" name="resuppincode">
					  </div>
					  <div class="form-group">
						<label for="resupaadhar">Aadhar No </label>
						<input type="text" placeholder="Aadhar No" value="'.$resume_aadhar.'" class="form-control" id="resupaadhar" name="resupaadhar">
					  </div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="resupdate_ofbirth">Date of Birth <span style="color:red;">*</span></label>
						<input type="text" placeholder="Date of Birth" value="'.$date_ofbirth.'" id="resupdate_ofbirth" name="resupdate_ofbirth" class="form-control" />
					</div>
			   
					 
					   <div class="form-group">
						<label for="resuppan">PAN No </label>
						<input type="text" placeholder="PAN No" value="'.$resume_pan.'" class="form-control" id="resuppan" name="resuppan">
					  </div>
					  <div class="form-group">
						<label class="control-label" for="resupstate">Qualification <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="resupstate" id="resupstate">
						<option value="">- Highest Qualification Required -</option>';
							foreach($get_alljobqualification as $prow)
							{
								if($prow['code'] == $resume_state)
									echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
								else
									echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
							}
						echo '</select>
					</div>
				</div>
				
				<b>Educational Details</b><hr class="style-one"/>
				<div class="col-md-12">
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupschool">School Name</label>
							<input type="text" placeholder="School Name" value="'.$resume_school.'" class="form-control" id="resupschool" name="resupschool">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupboard">Board</label>
							<input type="text" placeholder="Board" class="form-control" value="'.$resume_board.'" id="resupboard" name="resupboard">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupschool_year">Year of Completion</label>
							<select class="selectpicker form-control" name="resupschool_year" id="resupschool_year">
								<option value=""> - Select Year -</option>';
								foreach($get_year as $rrow)
								{
									if($rrow['code'] == $resume_school_year)
										echo '<option value="'.$rrow['code'].'" selected>'.$rrow['name'].'</option>';
									else
										echo '<option value="'.$rrow['code'].'">'.$rrow['name'].'</option>';
								}
								echo '</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupschool_marks">Percentage</label>
							<input type="text" placeholder="Percentage" class="form-control" value="'.$school_marks.'" id="resupschool_marks" name="resupschool_marks">
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupcollege">College / High School Name</label>
							<input type="text" placeholder="College / High School Name" value="'.$resume_college.'" class="form-control" id="resupcollege" name="resupcollege">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupcollege_stream">Stream</label>
							<select class="selectpicker form-control" name="resupcollege_stream" id="resupcollege_stream">
								<option value=""> - Select Stream -</option> ';
								if($resume_college_stream = "100")
								{
									echo '<option value="100" selected>Arts</option> 
									<option value="101">Commerce</option> 
									<option value="102">Science</option>';
								}
								else if($resume_college_stream = "101")
								{
									echo '<option value="100" >Arts</option> 
									<option value="101" selected>Commerce</option> 
									<option value="102">Science</option>';
								}
								else if($resume_college_stream = "102")
								{
									echo '<option value="100" >Arts</option> 
									<option value="101" >Commerce</option> 
									<option value="102" selected>Science</option>';
								}
								else{
									echo '<option value="100" >Arts</option> 
									<option value="101" >Commerce</option> 
									<option value="102">Science</option>';
								}
							echo '</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupcollege_year">Year of Completion</label>
							<select class="selectpicker form-control" name="resupcollege_year" id="resupcollege_year">
								<option value="">- Select Year -</option>';
								foreach($get_year as $prow)
								{
									if($prow['code'] == $resume_college_year)
										echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
									else
										echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
								}
							echo '</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupcollege_marks">Percentage</label>
							<input type="text" placeholder="Percentage" class="form-control" value="'.$resume_college_marks.'" id="resupcollege_marks" name="resupcollege_marks">
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupdegree_name">College Name</label>
							<input type="text" placeholder="College Name" value="'.$resume_degree_name.'" class="form-control" id="resupdegree_name" name="resupdegree_name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupdegree_stream">Graduation Degree</label>
							<select class="selectpicker form-control" id="resupdegree_stream" name="resupdegree_stream">
							<option value="">- Select Stream -</option> ';
								if($resume_degree_stream == "100")
								{
									echo '<option value="100" selected>Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option>
									<option value="106">BScIT</option>';
								}
								else if($resume_degree_stream == "101")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101" selected>BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option> 
									<option value="106">BScIT</option>';
								}
								else if($resume_degree_stream == "102")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102" selected>BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option> 
									<option value="106">BScIT</option>';
								}
								else if($resume_degree_stream == "103")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103" selected>BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option> 
									<option value="106">BScIT</option>';
								}
								else if($resume_degree_stream == "104")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105" selected>BAF</option> 
									<option value="106">BScIT</option>';
								}
								else if($resume_degree_stream == "105")
								{
									echo '<option value="100">Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105" selected>BAF</option>
									<option value="106">BScIT</option>';
								}
								else if($resume_degree_stream == "106")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option> 
									<option value="106" selected>BScIT</option>';
								}
								else{
									echo '<option value="100">Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option>
									<option value="106">BScIT</option>';
								}
							echo '
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupdegree_year"> - Year of Completion -</label>
							<select class="selectpicker form-control" name="resupdegree_year" id="resupdegree_year">
								<option value=""> - Select Year -</option> ';
								foreach($get_year as $prow)
								{
									if($prow['code'] == $resume_degree_year)
										echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
									else
										echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
								}
								echo '</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resupdegree_marks">Percentage / CGPA</label>
							<input type="text" placeholder="Percentage" value="'.$resume_degree_marks.'" class="form-control" id="resupdegree_marks" name="resupdegree_marks">
						</div>
					</div>
				</div>
				<div class="col-md-12" >
					<div class="col-md-3">
						<div class="form-group">
							<label for="resuppg_name">College / University Name </label>
							<input type="text" placeholder="College Name" value="'.$resume_pg_name.'" class="form-control" id="resuppg_name" name="resuppg_name">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resuppg_stream">Degree</label>
							<select class="selectpicker form-control" name="resuppg_stream" id="resuppg_stream">
								<option value="">- Select Stream -</option>';
								if($resume_pg_stream == "100")
								{
									echo '<option value="100" selected>Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option>
									<option value="106">BScIT</option>';
								}
								else if($resume_pg_stream == "101")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101" selected>BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option> 
									<option value="106">BScIT</option>';
								}
								if($resume_pg_stream == "102")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102" selected>BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option> 
									<option value="106">BScIT</option>';
								}
								else if($resume_pg_stream == "103")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103" selected>BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option> 
									<option value="106">BScIT</option>';
								}
								else if($resume_pg_stream == "104")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104" selected>BMS</option>
									<option value="105">BAF</option> 
									<option value="106">BScIT</option>';
								}
								else if($resume_pg_stream == "105")
								{
									echo '<option value="100">Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105" selected>BAF</option>
									<option value="106">BScIT</option>';
								}
								else if($resume_pg_stream == "106")
								{
									echo '<option value="100" >Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option> 
									<option value="106" selected>BScIT</option>';
								}
								else
								{
									echo '<option value="100">Bachelors in Commerce</option> 
									<option value="101">BAF</option> 
									<option value="102">BMM</option> 
									<option value="103">BAF</option> 
									<option value="104">BMS</option>
									<option value="105">BAF</option> 
									<option value="106">BScIT</option>';
								}
							echo '</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resuppg_year">Year of Completion</label>
							<select class="selectpicker form-control" name="resuppg_year" id="resuppg_year">
								<option value=""> - Select Year -</option> ';
								foreach($get_year as $prow)
								{
									if($prow['code'] == $resume_pg_year)
										echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
									else
										echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
								}
								echo '</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="resuppg_marks">Percentage / CGPA</label>
							<input type="text" placeholder="Percentage" class="form-control" value="'.$resume_pg_marks.'" id="resuppg_marks" name="resuppg_marks">
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
				<b>Experience (Details of Previous Organization)</b><hr class="style-one"/>
					<div class="col-md-6">
						<div class="col-md-6">
								<div class="form-group">
									<label for="resuporg_name">Organization Name</label>
									<input type="text" placeholder="Organization Name" value="'.$resume_org_name.'" class="form-control" id="resuporg_name" name="resuporg_name">
								  </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="resupjob_profile">Job Profile </label>
									<select class="selectpicker form-control" name="resupjob_profile" id="resupjob_profile">
										<option value="">- Select Job Profile -</option>';
											foreach($get_alljobcategory as $prow)
											{
												if($prow['code'] == $resume_job_profile)
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
						
							</div>
						<div class="form-group">
								<label for="resupjob_description">Description </label>
								<textarea class="form-control"  id="resupjob_description" name="resupjob_description" placeholder="Short Description of Work Done ">'.$resume_job_description.'</textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="resupstart_date">Start Date</label>
								<input type="text" placeholder="Start Date" value="'.$org_start_date.'" id="resupstart_date" name="resupstart_date" class="form-control" />
							</div>
							<div class="form-group">
								<label class="control-label" for="resupjob_designation">Designation </label>
								<select class="selectpicker form-control" name="resupjob_designation" id="resupjob_designation">
									<option value=""> - Select Designation -</option>';
									foreach($get_alljobdesignation as $prow)
									{
										if($prow['code'] == $resume_job_designation)
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
								<label for="resupjob_exp">No of Years of Experience</label>
								<select class="selectpicker form-control" name="resupjob_exp" id="resupjob_exp">
									<option value="">- Select No of Years - </option>
									<option value="001">Less than months</option>
									<option value="001">1 Year</option>
									<option value="001">2 Years</option>
									<option value="002">3 Years</option>
									<option value="002">4 Years</option>
									<option value="003">5 Years</option>
									<option value="003">6 Years</option>
									<option value="003">7 Years</option>
									<option value="003">8 Years</option>
									<option value="004">9 Years</option>
									<option value="004">10 Years</option>
									<option value="004">Above 10 Years</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="resupend_date">End Date</label>
								<input type="text" placeholder="End Date" value="'.$org_end_date.'" id="resupend_date" name="resupend_date" class="form-control" />
							</div>
							<div class="form-group">
								<label for="resupjob_salary"> Salary Offered </label>
								<select class="selectpicker form-control" name="resupjob_salary" id="resupjob_salary">
									<option value="">- Select Range - </option>';
									foreach($get_allsalary as $prow)
									{
										if($prow['code'] == $org_salary)
											echo '<option value="'.$prow['code'].'" selected>'.$prow['name'].'</option>';
										else
											echo '<option value="'.$prow['code'].'">'.$prow['name'].'</option>';
									}
							echo '</select>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
				<b>Other Details</b><hr class="style-one"/>
				<div class="col-md-3">
					<div class="form-group">
						<label for="resupworksamp">Work Samples</label>
						<input type="text" placeholder="Provide Links to your Projects" value="'.$resume_worksamp.'" class="form-control" id="resupworksamp" name="resupworksamp">
					  </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
							<label>Select Skills <span style="color:red;">*</span></label>
							<select class="form-control js-example-basic-multiple" id="resupskills" name="resupskills[]" multiple="multiple">
							  <option value="">- Select Skills -</option>';
						  $branchstaff=array();
                          $branchstaff[]='';
						  $branch = "";
                          $branches = json_decode($skills, true);
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
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="resupjob_type">Preferred Job Type <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="resupjob_type" id="resupjob_type">
						<option value="">- Select Job Type - </option>';
						foreach($get_alljobtype as $prow)
						{
							if($prow['code'] == $resume_job_type)
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
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="resupjob_location">Preferred Job Location <span style="color:red;">*</span></label>
						<select class="selectpicker form-control" name="resupjob_location" id="resupjob_location">
							<option value=""> - Select Job Location - </option>';
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
			</div>
			<span id="errormsg"></span>
				<br/>
				 <input type="submit" class="btn btn-success pull-right" value="Save Details"/>
				</form>
			</div>';
}
			echo '</div>
			<div class="tab-pane" id="profile"></div>
			</div>
		</div>';

echo "<script>
		$(document).ready(function(){
		var dateFormat = $(this).attr('data-vat-rate');
	        $('#date_ofbirth').datepicker({
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
			$('#resume_start_date').datepicker({
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
			$('#resume_end_date').datepicker({
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
			$('#resupdate_ofbirth').datepicker({
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
			$('#resupstart_date').datepicker({
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
			$('#resupend_date').datepicker({
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
		 
		 $('#div_grad').hide();
		 $('#div_school').hide();
		 $('#div_postgrad').hide();
	    });
	
	$(function(){
	$('#resume_details_form').validate({

		rules: {
		    resume_gender: 'required',
			date_ofbirth: 'required',
			resume_address: 'required',
			resume_city: 'required',
			resume_email: 'required',
			resume_skills: 'required',
			resume_job_type: 'required',
			resume_job_location: 'required',
			
		},
		messages:{
		    resume_gender: 'Please Select Gender',
			date_ofbirth: 'Please Enter Date of Birth',
			resume_address: 'Please Enter Address',
			resume_city: 'Please Select a City',
			resume_email: 'Please Enter an Email ID',
			resume_skills: 'Please Select Skills',
			resume_job_type: 'Select Preferred Job Type',
			resume_job_location: 'Please Select Job Location',

		},
		submitHandler: function(form) {
            add_resume_details();
      	}	
		});
	});
	$(function(){
	$('#resupdetails_form').validate({

		rules: {
		    resupgender: 'required',
			resupdate_ofbirth: 'required',
			resupaddress: 'required',
			resupcity: 'required',
			resupemail: 'required',
			resupskills: 'required',
			resupjob_type: 'required',
			resupjob_location: 'required',
			
		},
		messages:{
		    resupgender: 'Please Select Gender',
			date_ofbirth: 'Please Enter Date of Birth',
			resupaddress: 'Please Enter Address',
			resupcity: 'Please Select a City',
			resupemail: 'Please Enter an Email ID',
			resupskills: 'Please Select Skills',
			resupjob_type: 'Select Preferred Job Type',
			resupjob_location: 'Please Select Job Location',

		},
		submitHandler: function(form) {
            update_resume_details();
      	}	
		});
	});
	
	$('#resume_state').on('change', function() {
	    var education = $('#resume_state').val();
		if(education == '002')
		{
			$('#div_school').show();
		}
		else if(education == '003')
		{
			$('#div_school').show();
			$('#div_grad').show();
		}
		else if(education == '004')
		{
			$('#div_school').show();
			$('#div_grad').show();
			$('#div_postgrad').show();
		}
		else
		{
			$('#div_school').hide();
			$('#div_grad').hide();
			$('#div_postgrad').hide();
		}
	});
	
	function update_resume_details()
	{
		var job_skill = [];
		var selected = $('#resupskills option:selected');
        selected.each(function () {
            job_skill.push($(this).val());
		});
		var job_skillstring = JSON.stringify(job_skill);
		
		var resupfirst_name = $('#resupfirst_name').val();
		var resuplast_name = $('#resuplast_name').val();
		var resupgender = $('#resupgender').val();
		var resupcity = $('#resupcity').val();
		var resupstate = $('#resupstate').val();
		var date_ofbirth = $('#resupdate_ofbirth').val();
		var resupemail = $('#resupemail').val();
		var resupmobile = $('#resupmobile').val();
		var resuppincode = $('#resuppincode').val();
		var resuppan = $('#resuppan').val();
		var resupaadhar = $('#resupaadhar').val();
		var resupaddress = $('#resupaddress').val();
		
		var resupschool = $('#resupschool').val();
		var resupboard = $('#resupboard').val();
		var resupschool_year = $('#resupschool_year').val();
		var school_marks = $('#resupschool_marks').val();
		var resupcollege = $('#resupcollege').val();
		var resupcollege_stream = $('#resupcollege_stream').val();
		var resupcollege_year = $('#resupcollege_year').val();
		var resupcollege_marks = $('#resupcollege_marks').val();
		var resupdegree_name = $('#resupdegree_name').val();
		var resupdegree_stream = $('#resupdegree_stream').val();
		var resupdegree_year = $('#resupdegree_year').val();
		var resupdegree_marks = $('#resupdegree_marks').val();
		var resuppg_name = $('#resuppg_name').val();
		var resuppg_stream = $('#resuppg_stream').val();
		var resuppg_year = $('#resuppg_year').val();
		var resuppg_marks = $('#resuppg_marks').val();
		
		var resuporg_name = $('#resuporg_name').val();
		var resupstart_date = $('#resupstart_date').val();
		var resupend_date = $('#resupend_date').val();
		var resupjob_description = $('#resupjob_description').val();
		var resupjob_exp = $('#resupjob_exp').val();
		var resupjob_profile = $('#resupjob_profile').val();
		var resupjob_salary = $('#resupjob_salary').val();
		var resupjob_designation = $('#resupjob_designation').val();
		
		var resupworksamp = $('#resupworksamp').val();
		var resupjob_type = $('#resupjob_type').val();
		var resupjob_location = $('#resupjob_location').val();
		
		$.ajax({
			  type: 'POST',
			  url:'candidate/update_resumedetails.php',
			  data: {
					 resupfirst_name : resupfirst_name,
					 resuplast_name : resuplast_name,
					 resupgender : resupgender,
					 resupcity : resupcity,
					 resupstate :resupstate,
					 date_ofbirth : date_ofbirth,
					 resupemail : resupemail,
					 resupmobile : resupmobile,
					 resuppincode : resuppincode, 
					 resuppan :resuppan,
					 resupaadhar : resupaadhar,
					 resupaddress : resupaddress,
					 
					 resupcollege_stream : resupcollege_stream,
					 resupcollege : resupcollege,
					 school_marks : school_marks,
					 resupschool_year : resupschool_year, 
					 resupboard : resupboard,
					 resupschool : resupschool,
					 resupdegree_marks : resupdegree_marks,
					 resupdegree_year : resupdegree_year,
					 resupdegree_stream : resupdegree_stream,
					 resupdegree_name : resupdegree_name,
					 resupcollege_marks : resupcollege_marks,
					 resupcollege_year : resupcollege_year,
					 resupworksamp : resupworksamp,
					 resupjob_type : resupjob_type,
					 job_skillstring : job_skillstring,
					 resupjob_location : resupjob_location,
					 resupjob_designation : resupjob_designation,
					 resupjob_salary : resupjob_salary,
					 resupjob_profile : resupjob_profile,
					 resupjob_exp : resupjob_exp,
					 resupjob_description : resupjob_description,
					 resuporg_name : resuporg_name,
					 resuppg_marks : resuppg_marks,
					 resuppg_year : resuppg_year,
					 resuppg_stream : resuppg_stream,
					 resuppg_name : resuppg_name,
					 
					},
					success:function(result){
					
					 alert(result);
					  $('#resupdetails_form').trigger('reset');
					  writeresume();
				}
			});
	}
	
	function add_resume_details()
	{
		var job_skill = [];
		var selected = $('#resume_skills option:selected');
        selected.each(function () {
            job_skill.push($(this).val());
		});
		var job_skillstring = JSON.stringify(job_skill);
		
		var resume_first_name = $('#resume_first_name').val();
		var resume_last_name = $('#resume_last_name').val();
		var resume_gender = $('#resume_gender').val();
		var resume_city = $('#resume_city').val();
		var resume_state = $('#resume_state').val();
		var date_ofbirth = $('#date_ofbirth').val();
		var resume_email = $('#resume_email').val();
		var resume_mobile = $('#resume_mobile').val();
		var resume_pincode = $('#resume_pincode').val();
		var resume_pan = $('#resume_pan').val();
		var resume_aadhar = $('#resume_aadhar').val();
		var resume_address = $('#resume_address').val();
		
		var resume_school = $('#resume_school').val();
		var resume_board = $('#resume_board').val();
		var resume_school_year = $('#resume_school_year').val();
		var school_marks = $('#school_marks').val();
		var resume_college = $('#resume_college').val();
		var resume_college_stream = $('#resume_college_stream').val();
		var resume_college_year = $('#resume_college_year').val();
		var resume_college_marks = $('#resume_college_marks').val();
		var resume_degree_name = $('#resume_degree_name').val();
		var resume_degree_stream = $('#resume_degree_stream').val();
		var resume_degree_year = $('#resume_degree_year').val();
		var resume_degree_marks = $('#resume_degree_marks').val();
		var resume_pg_name = $('#resume_pg_name').val();
		var resume_pg_stream = $('#resume_pg_stream').val();
		var resume_pg_year = $('#resume_pg_year').val();
		var resume_pg_marks = $('#resume_pg_marks').val();
		
		var resume_org_name = $('#resume_org_name').val();
		var resume_start_date = $('#resume_start_date').val();
		var resume_end_date = $('#resume_end_date').val();
		var resume_job_description = $('#resume_job_description').val();
		var resume_job_exp = $('#resume_job_exp').val();
		var resume_job_profile = $('#resume_job_profile').val();
		var resume_job_salary = $('#resume_job_salary').val();
		var resume_job_designation = $('#resume_job_designation').val();
		
		var resume_worksamp = $('#resume_worksamp').val();
		var resume_job_type = $('#resume_job_type').val();
		var resume_job_location = $('#resume_job_location').val();
		
		$.ajax({
			  type: 'POST',
			  url:'candidate/add_resumedetails.php',
			  data: {
					 resume_first_name : resume_first_name,
					 resume_last_name : resume_last_name,
					 resume_gender : resume_gender,
					 resume_city : resume_city,
					 resume_state :resume_state,
					 date_ofbirth : date_ofbirth,
					 resume_email : resume_email,
					 resume_mobile : resume_mobile,
					 resume_pincode : resume_pincode, 
					 resume_pan :resume_pan,
					 resume_aadhar : resume_aadhar,
					 resume_address : resume_address,
					 
					 resume_college_stream : resume_college_stream,
					 resume_college : resume_college,
					 school_marks : school_marks,
					 resume_school_year : resume_school_year, 
					 resume_board : resume_board,
					 resume_school : resume_school,
					 resume_degree_marks : resume_degree_marks,
					 resume_degree_year : resume_degree_year,
					 resume_degree_stream : resume_degree_stream,
					 resume_degree_name : resume_degree_name,
					 resume_college_marks : resume_college_marks,
					 resume_college_year : resume_college_year,
					 resume_worksamp : resume_worksamp,
					 resume_job_type : resume_job_type,
					 job_skillstring : job_skillstring,
					 resume_job_location : resume_job_location,
					 resume_job_designation : resume_job_designation,
					 resume_job_salary : resume_job_salary,
					 resume_job_profile : resume_job_profile,
					 resume_job_exp : resume_job_exp,
					 resume_job_description : resume_job_description,
					 resume_org_name : resume_org_name,
					 resume_pg_marks : resume_pg_marks,
					 resume_pg_year : resume_pg_year,
					 resume_pg_stream : resume_pg_stream,
					 resume_pg_name : resume_pg_name,
					 
					},
					success:function(result){
					 alert(result);
					 
					  $('#resume_details_form').trigger('reset');
					  
					  exampleMulti.val(null).trigger('change');
				}
			});
	}
	
	function get_resume()
	{
		$.ajax({
			type: 'GET',
			url:'candidate/view_resume.php',
			success:function(result){
				$('#profile').html(result);
			}
		});
	}
	</script>";
?>