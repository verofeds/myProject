<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];

$get_company_data = $db->get_company_data($userid);
$get_alljobcategory = $db->get_alljobcategory();
//print_r($get_company_data);
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
	
}

if(isset($_POST['upload'])) {
	//$company_logo = $_POST['company_logo'];
  	$image = addslashes ($_FILES['company_logo']['name']);
	$imagetmp=addslashes (file_get_contents($_FILES['company_logo']['tmp_name']));

  	$target = "images/".basename($image);

	$insert = $db->insert($userid,$image,$imagetmp);
	echo "<script>document.location='../dashboard.php'</script>";
}

$show = $db->show($userid);

foreach($show as $row)
{
 $image_name=$row["image_name"];
 $image=$row["image"];
}
//echo '<img src="data:image/jpeg;base64,'.base64_encode( $image_date ).'"/>';



	echo '<div class="container"><br>
		<div class="col-md-12 well">
		<form method="POST" action="company/comp_profile.php" enctype="multipart/form-data">
		<b>Edit Profile</b><hr class="style-one"/>';
		if($image)
		{
			echo '<div class="col-md-2" style="margin-bottom:20px;">
				<img style="border-radius:50%;display: block;margin-left: auto;margin-right: auto;"  src="data:image/jpeg;base64,'.base64_encode($image_name).'" height=110 width=110/><p>
				
			</div>';
		}
		else
		{
			echo '<div class="col-md-2" style="margin-bottom:20px;">
				<img style="margin-left: auto;margin-right: auto;"  src="images/profile.jpg" height=120 width=120/>
			</div>';
		}
			
			echo '<div class="col-md-10">
				<p><b>Insert Company Logo</b>
				<br/><i style="font-size:12px;">Max file size is 1MB, minimum dimension is 100X100 and suitable file types are jpg and png</i></p>
				<input type="hidden" id="logo_size" name="logo_size" value="1000000">
				<div style="padding-bottom:15px;">
				  <input type="file" id="company_logo" name="company_logo">
				</div>
				<button class="btn btn-warning btn-xs" type="submit" name="upload">Upload Image</button>
			</div>
		</form>
			<hr style="border:0;clear:both;display:block;width: 96%;height: 1px;">
			<form id="company_details_form">
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="email">Company Name <span style="color:red;">*</span></label>
					<input type="text" class="form-control" value="'.$company_name.'" placeholder="Company Name" id="comp_name" name="comp_name">
				  </div>
				  <div class="form-group">
					<label class="control-label" for="email">Established Since</label>
					<input type="text" class="form-control" maxlength="4" value="'.$estab_since.'" placeholder="Established Since" id="estab_since" name="estab_since">
				  </div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="email">Email <span style="color:red;">*</span></label>
					<input type="text" value="'.$comp_email.'" class="form-control" placeholder="Email" id="comp_email" name="comp_email" >
				  </div>
				<div class="form-group">
					<label class="control-label" for="email">Team Size</label>
					<input type="text" value="'.$team_size.'" class="form-control" placeholder="Team Size" id="team_size" name="team_size" >
				  </div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="email">Phone <span style="color:red;">*</span></label>
					<input type="tel" value="'.$comp_phone.'" pattern="{10}" class="form-control" placeholder="Phone" id="comp_phone" name="comp_phone">
				  </div>
				  <div class="form-group">
					<label class="control-label" for="email">Account Holder\'s Name <span style="color:red;">*</span></label>
					<input type="text" value="'.$comp_pname.'" class="form-control" placeholder="Account Holder\'s Name" id="comp_pname" name="comp_pname">
				  </div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="email">Category <span style="color:red;">*</span></label>
					<select class="selectpicker form-control" id="comp_category" name="comp_category">
						<option value="">Select Category</option>';
						foreach($get_alljobcategory as $prow)
						{
							if($prow['code'] == $comp_category)
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
					<label class="control-label" for="email">Mobile Number <span style="color:red;">*</span></label>
					<input type="text" class="form-control" placeholder="Mobile Number" value="'.$comp_mobile.'" id="comp_pname_no"	name="comp_pname_no">
				  </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="pwd">About Company</label>
					<textarea class="form-control" id="about_comp" name="about_comp" rows="3" placeholder="Objectives, goals and vision">'.$comp_about.'</textarea>
				</div>
			</div>
		
			<b>Social Network</b><hr class="style-one"/>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="email">Google</label>
					<input type="text" class="form-control" placeholder="Google" id="google_link" value="'.$comp_website.'" name="google_link">
				</div>
				<div class="form-group">
					<label class="control-label" for="email">Linkedin</label>
					<input type="text" class="form-control" placeholder="Linkedin" id="linked_link" value="'.$linked_link.'" name="linked_link">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="email">Facebook</label>
					<input type="text" class="form-control" placeholder="Facebook" value="'.$facebook_link.'" id="facebook_link" name="facebook_link">
				</div>
				<div class="form-group">
					<label class="control-label" for="email">Twitter</label>
					<input type="text" class="form-control" placeholder="Twitter" value="'.$twitter_link.'" id="twitter_link" name="twitter_link">
				</div>
			</div>
			<input type="submit" class="btn btn-success pull-right" value="Save"/>
			</form>
		</div>
			<div class="col-md-12 well">
			<b>Password and Security</b><hr class="style-one"/>
		<form id="change_password_form" autocomplete="off">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="email">Verification Email</label>
					<input type="email" class="form-control" value="'.$username.'" placeholder="Verification Email" id="verification_email" disabled/>
				</div>
				<div class="form-group">
					<label class="control-label" for="email">Current Password</label>
					<input type="password" class="form-control" value="********" placeholder="Current Password" id="cuurent_password" disabled/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="new_password">New Password</label>
					<input type="password" class="form-control" placeholder="New Password" id="new_password" required>
				</div>
				<div class="form-group">
					<label class="control-label" for="confirm_password">Confirm Password</label>
					<input type="password" class="form-control" autocomplete="nope" placeholder="Confirm Password" id="confirm_password" required>
					<span id="password_message"></span>
				</div>
			</div>
			<span id="change_password_alert"></span>
			<button class="btn btn-danger pull left"><span class="fa fa-trash"></span> Delete Account</button> 
			<button type="button" class="btn btn-success pull-right" onclick=change_password("'.$userid.'");> Save Changes</button>
		</form>
		</div>';
		
echo "<script>
$('#confirm_password').on('keyup', function () {
  if ($('#new_password').val() == $('#confirm_password').val()) {
    $('#password_message').html('Matching').css('color', 'green');
  } else 
    $('#password_message').html('Not Matching').css('color', 'red');
});

function change_password(userid)
{
	var new_password = $('#new_password').val();
	var confirm_password = $('#confirm_password').val();
	
	if(new_password == confirm_password) 
	{
		$.ajax({
		  type: 'POST',
		  url:'company/change_password.php',
		  data: {
				 confirm_password : confirm_password,
				 userid : userid,
				},
				success:function(result){
				 alert(result);
				  $('#change_password_form').trigger('reset');
				  $('#password_message').html('');
			}
		});
	}
}

$(function(){
	$('#company_details_form').validate({

		rules: {
		    comp_name: 'required',
			comp_email: 'required',
			comp_phone: 'required',
			comp_pname: 'required',
			comp_pname_no: 'required',
			comp_category: 'required',
		},
		messages:{
		    comp_name: 'Please Enter Company Name',
			comp_email: 'Please Enter a Valid Email',
			comp_phone: 'Please Enter a Valid Phone Number',
			comp_pname: 'Please Enter a Name',
			comp_pname_no: 'Please Enter a Mobile No',
			comp_category: 'Please Select Category',
		},
		submitHandler: function(form) {
            add_comp_details();
      	}	
		});
	});

	function add_comp_details()
	{
		var comp_name = $('#comp_name').val();
		var comp_email = $('#comp_email').val();
		var comp_pname = $('#comp_pname').val();
		var comp_phone = $('#comp_phone').val();
		var comp_pname_no = $('#comp_pname_no').val();
		var comp_category = $('#comp_category').val();
		var google_link = $('#google_link').val();
		var linked_link = $('#linked_link').val();
		var twitter_link = $('#twitter_link').val();
		var facebook_link = $('#facebook_link').val();
		var about_comp = $('#about_comp').val();
		var estab_since = $('#estab_since').val();
		var team_size = $('#team_size').val();
		var logo_size = $('#logo_size').val();
		var company_logo = $('#company_logo').val();
		
			$.ajax({
			  type: 'POST',
			  url:'company/add_comp_details.php',
			  data: {
					 comp_name : comp_name,
					 comp_email : comp_email,
					 comp_pname : comp_pname,
					 comp_phone : comp_phone,
					 comp_pname_no : comp_pname_no,
					 comp_category : comp_category,
					 google_link : google_link,
					 linked_link : linked_link,
					 twitter_link : twitter_link,
					 facebook_link : facebook_link,
					 about_comp : about_comp,
					 estab_since : estab_since,
					 team_size : team_size,
					 logo_size : logo_size,
					 company_logo : company_logo,
					 
					},
					success:function(result){
					 alert(result);
					  $('#company_details_form').trigger('reset');
					  compprofile();
				}
			});
		
	}
</script>";
?>