<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
$userid = $_SESSION['userid'];
$get_candidate_data = $db->get_candidate_data($userid);
foreach($get_candidate_data as $row)
{
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$mobile_no = $row['mobile_no'];
}

if(isset($_POST['upload_profile'])) {
	
  	$image = addslashes ($_FILES['profile_photo']['name']);
	$imagetmp=addslashes (file_get_contents($_FILES['profile_photo']['tmp_name']));

  	$target = "images/".basename($image);

	$upload_profile = $db->upload_profile($userid,$image,$imagetmp);
	echo "<script>document.location='../dashboard.php'</script>";
}

$get_candidate_data = $db->get_candidate_data($userid);
foreach($get_candidate_data as $roww)
{
	$image = $roww['image'];
	$image_name = $roww['image_name'];
}
	echo '<div class="container"><br>
	<div class="col-md-6 col-md-offset-2">
	  <div class="panel panel-default">
		<div class="panel-heading">
			<p style="font-size:20px;text-align:center;font-family: "Times New Roman", Times, serif;">Veronica Pascal Fernandes </br><span style="font-size:12px;text-align:center;font-family: "Times New Roman", Times, serif;">Candidate Account</span></p>	
		</div>
		<div class="panel-body">
		<div class="col-md-12" style="padding-bottom:20px;">
			<div class="col-md-4">';
				if($image)
				{
					echo '<img style="border-radius:50%;display: block;margin-left: auto;margin-right: auto;"  src="data:image/jpeg;base64,'.base64_encode($image_name).'" height=110 width=110/><p>';
				}
				else{
					echo '<img style="border-radius:50%;display: block;margin-left: auto;margin-right: auto;"  src="images/profile.jpg" height=110 width=110/><p>';
				}
			echo '</div>
			<div class="col-md-8">
			<form method="POST" action="candidate/cand_profile.php" enctype="multipart/form-data">
				<br/><i style="font-size:12px;">Max file size is 1MB, minimum dimension is 100X100 and suitable file types are jpg and png</i></p>
				<input type="hidden" id="profile_size" name="profile_size" value="1000000">
				<div style="padding-bottom:15px;">
				  <input type="file" id="profile_photo" name="profile_photo">
				</div>
				<button class="btn btn-warning btn-xs" type="submit" name="upload_profile">Upload Image</button>
			</form>
			</div>
		</div>
		
			 <form style="padding-top:20px;" id="cand_profile_form">
			 <div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="cand_first_name">First Name</label>
					<input type="text" class="form-control" value="'.$first_name.'" placeholder="First Name" id="cand_first_name" name="cand_first_name">
				</div>
				<div class="form-group">
					<label class="control-label" for="cand_mobile">Phone No</label>
					<input type="text" class="form-control" value="'.$mobile_no.'" placeholder="Username" id="cand_mobile" name="cand_mobile">
				</div>
				 
				  <div class="form-group">
					<label class="control-label" for="cand_username">Username</label>
					<input type="email" class="form-control" value="'.$username.'" placeholder="Username" id="cand_username" disabled>
				  </div>
				 
			</div>
			<div class="col-md-6">
			  <div class="form-group">
					<label class="control-label" for="cand_last_name">Last Name</label>
					<input type="text" class="form-control" value="'.$last_name.'" placeholder="Last Name" id="cand_last_name" name="cand_last_name">
				</div>
				<div class="form-group">
				<label for="cand_new_pass">New Password:</label>
				<input type="password" placeholder="New Password" autocomplete = "off" class="form-control" id="cand_new_pass" name="cand_new_pass">
			  </div>
				<div class="form-group">
				<label for="cand_confirm_pass">Confirm Password:</label>
				<input type="password" placeholder="Confirm Password" autocomplete = "off" class="form-control" id="cand_confirm_pass" name="cand_confirm_pass">
				<span id="cand_password_message"></span>
			  </div>
			  
			</div>
			  <button class="btn btn-danger pull-left">Delete Account</button>
			 <input type="submit" id="submit_cand_form" class="btn btn-success pull-right" value="Save Changes"/>
			</form> 
		</div>
	  </div>
	</div>
</div>';

echo "<script>

$('#cand_confirm_pass').on('keyup', function () {
	  if ($('#cand_new_pass').val() == $('#cand_confirm_pass').val()) 
	  {
			$('#cand_password_message').html('Matching').css('color', 'green');
			$('#submit_cand_form').prop('disabled',false);
	  } 
	else
	{  
		$('#cand_password_message').html('Not Matching').css('color', 'red');
		 $('#submit_cand_form').prop('disabled',true);
	}	
});

$(function(){
	$('#cand_profile_form').validate({

		rules: {
		    cand_first_name: 'required',
			cand_last_name: 'required',
			cand_mobile: 'required',
		},
		messages:{
		    cand_first_name: 'Please Enter Your First Name',
			cand_last_name: 'Please Enter Your Last Email',
			cand_mobile: 'Please Enter a Valid Mobile Number',
		},
		submitHandler: function(form) {
            add_cand_details();
      	}	
		});
	});

	function add_cand_details()
	{
		var cand_new_pass = $('#cand_new_pass').val();
		var cand_confirm_pass = $('#cand_confirm_pass').val();
		var cand_first_name = $('#cand_first_name').val();
		var cand_last_name = $('#cand_last_name').val();
		var cand_mobile = $('#cand_mobile').val();
		
			$.ajax({
			  type: 'POST',
			  url:'candidate/add_cand_profdetails.php',
			  data: {
					 cand_new_pass : cand_new_pass,
					 cand_confirm_pass : cand_confirm_pass,
					 cand_first_name : cand_first_name,
					 cand_last_name : cand_last_name,
					 cand_mobile : cand_mobile,					 
					},
					success:function(result){
					 alert(result);
					  $('#cand_profile_form').trigger('reset');
					  candprofile();
				}
			});
		
	}

</script>";
?>