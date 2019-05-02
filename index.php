<?php
@session_start();
if(!isset($_SESSION['username'])) {
include("functions.php");
$db = new DB_FUNCTIONS();
if(isset($_POST['comp_register'])){
	$company_name = $_POST["comp_name"];
	$company_email = $_POST["comp_email"];
	$company_number = $_POST["comp_number"];
	$company_per_name = $_POST["comp_pname"];
	
	$checkuserexist = $db->checkuserexist($company_email);
	if(!$checkuserexist)
	{
		$randompasswrod = $db->randomPassword();
		$escapedname = mysqli_real_escape_string($db->db,$company_email);
		$escapedpwd = mysqli_real_escape_string($db->db,$randompasswrod);
		$select_uniqueid = $db->select_uniqueid();
		
		$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		$saltedpwd =  $escapedpwd . $salt;
		$hashedpwd = hash('sha256', $saltedpwd);
		date_default_timezone_set('Asia/Kolkata');

		
		$company_register = $db->company_register($company_name,$company_email,$company_number,$company_per_name,$select_uniqueid);
		$company_loginreg = $db->company_loginreg($escapedname,$hashedpwd,$salt,$select_uniqueid);
		if($company_register && $company_loginreg)
		{
			$to = $company_email;
			$subject = "GETJOBS - Login credentials";
			$msg= "Hello ".$company_per_name."! Welcome to GETJOBS.
			
			Username: ".$company_email."
			Password: ".$escapedpwd."
			
			Thank You for joining us.";
			mail($to,$subject,$msg);
		}
		else
		{
			echo "Login Error";
		}
	}
	else{
		echo '<script>
		alert("Username Already Exists!! Please Try Again");
		</script>';
	}
}
if(isset($_POST['cand_register'])){
	$cand_first_name = $_POST["cand_first_name"];
	$cand_last_name = $_POST["cand_last_name"];
	$cand_phone_number = $_POST["cand_phone_number"];
	$cand_email = $_POST["cand_email"];
	
	$checkuserexist = $db->checkuserexist($cand_email);
	if(!$checkuserexist)
	{
		$randompasswrod = $db->randomPassword();
		$escapedname = mysqli_real_escape_string($db->db,$cand_email);
		$escapedpwd = mysqli_real_escape_string($db->db,$randompasswrod);
		$select_uniqueid = $db->select_uniqueid();
		
		$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		$saltedpwd =  $escapedpwd . $salt;
		$hashedpwd = hash('sha256', $saltedpwd);
		date_default_timezone_set('Asia/Kolkata');
		
		$candidate_register = $db->candidate_register($cand_first_name,$cand_last_name,$cand_phone_number,$cand_email,$select_uniqueid);
		$candidate_loginreg = $db->candidate_loginreg($cand_email,$hashedpwd,$select_uniqueid,$salt);
		
		if($candidate_register && $candidate_loginreg)
		{
			$to = $cand_email;
			$subject = "GETJOBS - Login credentials";
			$msg= "Hello ".$cand_first_name."! Welcome to GETJOBS.
			
			Username: ".$cand_email."
			Password: ".$escapedpwd."
			
			Thank You for joining us.";
			mail($to,$subject,$msg);
		}
		else
		{
			echo "Login Error";
		}
	}
	else{
		echo '<script>
		alert("Username Already Exists!! Please Try Again");
		</script>';
	}
}
if(isset($_POST['login_form'])){
	$utype = $_POST["utype"];
	$uname = $_POST["uname"];
	$upass = $_POST["upass"];
	
	$escapedname = mysqli_real_escape_string($db->db,$uname);
    $escapedpwd = mysqli_real_escape_string($db->db,$upass);
	$getsalt = $db->getsalt($escapedname);
	
	@$salt = implode($getsalt);
    $saltedpwd =  $escapedpwd . $salt;
    $hashedpwd = hash('sha256', $saltedpwd);
	
	$checkuser = $db->checkuser($utype,$escapedname,$hashedpwd);
	if($checkuser)
	{
		@session_start();
		$_SESSION['sessionuser'] = $checkuser['username'];
        $_SESSION['login'] = $checkuser['type'];
		$_SESSION['userid'] = $checkuser['userid'];
		echo "<script>document.location='dashboard.php'</script>";
	}
	else{
		echo '<script>
		alert("Invalid Username and Password!! Please Try Again");
		</script>';
	}
	
}

if(isset($_POST['forgot_submit'])){
$forgot_password = $_POST["forgot_password"];
	$forgot_password_confirm = $_POST["forgot_password_confirm"];
if($forgot_password == $forgot_password_confirm)
{
	$forgot_type = $_POST["forgot_type"];
	$forgot_uname = $_POST["forgot_uname"];
	
	
	$escapedpwd = mysqli_real_escape_string($db->db,$forgot_password_confirm);
	$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	$saltedpwd =  $escapedpwd . $salt;
	$hashedpwd = hash('sha256', $saltedpwd);
	date_default_timezone_set('Asia/Kolkata');
	
	$update_password = $db->update_password($forgot_type,$forgot_uname,$salt,$hashedpwd);
	
	
	if($update_password)
	{
		echo "<script>document.location='index.php'</script>";
	}
	else{
		echo '<script>
		alert(" Please Try Again");
		</script>';
	}
}
else{
		echo '<script>
		alert("Passwords do not match!! Please Try Again");
		</script>';
	}
	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>GETJOBS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">


  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">GET JOBS</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#portfolio">SERVICES</a></li>
        <!--<li><a href="#portfolio">PORTFOLIO</a></li>
        <li><a href="#pricing">PRICING</a></li>-->
		<li><a href="#login">LOGIN</a></li>
		
      </ul>
    </div>
	 </div>
</nav>
 

<div class="jumbotron text-center">

	<div class="col-md-8">
		<h1 style="color:maroon;">Join The Network</h1> 
		<p style="color:maroon;">We Believe Everybody Deserves A Chance To Shine</p>
		 
	</div>
	<div class="col-md-4">
		<div class="col-md-10 col-md-offset-2">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#cand" data-toggle="tab">Candidate</a></li>
				<li><a href="#comp" data-toggle="tab">Company</a></li>
			</ul>
		</div>
		<div class="tab-content clearfix">
			<div id="cand" class="tab-pane active">
				<h3 style="align:center;color:black;padding-top:50px;">Join Now For Free!</h3><br/> 
				  <form action="#" method="POST">
					<div class="col-md-10 col-md-offset-2 input-group">
					  <input type="text" class="form-control" size="80" placeholder="First Name" id="cand_first_name" name="cand_first_name" required></br></br>
					</div>
					<div class="col-md-10 col-md-offset-2 input-group">
					  <input type="text" class="form-control" size="50" placeholder="Last Name" name="cand_last_name" required></br></br>
					</div>
					<div class="col-md-10 col-md-offset-2 input-group">
					  <input type="tel" pattern="[0-9]{10}" class="form-control" size="50" placeholder="Phone Number" name="cand_phone_number" required></br></br>
					</div>
					<div class="col-md-10 col-md-offset-2 input-group">
					  <input type="email" class="form-control" size="50" placeholder="Email" id="cand_email" name="cand_email" required>
					  <span id="email_span"></span></br></br>
					</div>
					<div style="padding-bottom:20px;" class="col-md-10 col-md-offset-2">
						<input type="submit" name="cand_register" id="validate_btn" value="Submit" class="btn btn-success"/></br>
					</div>
					</form>
				  <p style="color:black;font-size:14px;padding-left:20px;">Have an account already? <a href="#login">Log in</a></p>
			</div>
			<div id="comp" class="tab-pane">
			
			<h3 style="align:center;color:black;padding-top:50px;">Start Hiring Now!</h3><br/>
				<form action="#" method="POST">
					<div class="col-md-10 col-md-offset-2 input-group">
					  <input type="text" class="form-control" size="80" placeholder="Company Name" name="comp_name" required></br></br>
					</div>
					<div class="col-md-10 col-md-offset-2 input-group">
					  <input type="text" class="form-control" size="50" placeholder="Company Email Id" name="comp_email" required></br></br>
					</div>
					<div class="col-md-10 col-md-offset-2 input-group">
					  <input type="text" class="form-control" size="50" placeholder="Phone Number" name="comp_number" required></br></br>
					</div>
					<div class="col-md-10 col-md-offset-2 input-group">
					  <input type="text" class="form-control" size="50" placeholder="Name" name="comp_pname" required></br></br>
					</div>
					
					<div style="padding-bottom:20px;" class="col-md-10 col-md-offset-2">
						<input type="submit" name="comp_register" value="Submit" class="btn btn-success"/></br>
					</div>
				</form>
				<p style="color:black;font-size:14px;padding-left:20px;">Have an account already? <a href="#login">Log in</a></p>
			</div>
		</div>
	</div>
</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Company Page</h2><br>
      <h4>GETJOBS has an in-depth understanding of the Indian consumer internet domain. With years of experience in the domain, strong cash flow generation and a diversified business portfolio, it one of the very few profitable pure play internet companies in the country. The company was incorporated on May 1, 2017 under the Companies Act, 1956 as GETJOBS (India) Private Limited and became a public limited company. Starting with a classified recruitment online business, GETJOBS has grown and diversified rapidly, setting benchmarks as a pioneer for others to follow. Driven by innovation, creativity, an experienced and talented leadership team and a strong culture of entrepreneurship, today, it is India’s premier online classifieds company in recruitment, matrimony, education and related services. </h4><br>
      <p>Our vision is to create economic opportunity for every member of the global workforce and the mission is to connect the world’s professionals to make them more productive and successful. We believ in making the best use of technology to bridgr the gap between people with experties in a particular field and the employers.</p>
      <br><button class="btn btn-default btn-lg">Get in Touch</button>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-signal logo"></span>
    </div>
  </div>
</div>




<!-- Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid text-center bg-grey">
  <h2>Portfolio</h2><br>
  <h4>What we have created</h4>
  <div class="row text-center slideanim">
	<div class="col-sm-4">
      <div class="thumbnail">
        <!--<img src="newyork.jpg" alt="New York" width="400" height="300">-->
        <p><strong>EMPLOYERS</strong></p>
        <p>Post Jobs</p>
		<p>Review Applicants</p>
		<p>Manage Responses </p>
		<p>Mass Mail</p>
		<p>Connect with Applicants</p>
		
      </div>
	 </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <!--<img src="paris.jpg" alt="Paris" width="400" height="300">-->
        <p><strong>JOBSEEKERS</strong></p>
        <p>Register</p>
		<p>Login</p>
		<p>Search Jobs</p>
		<p>View Resume</p>
		<p>Write Resume</p>
		<p>Connect with Recruiters</p>
		
      </div>
    </div>
    
   
    <div class="col-sm-4">
      <div class="thumbnail">
       <!-- <img src="sanfran.jpg" alt="San Francisco" width="400" height="300">-->
        <p><strong>Our System</strong></p>
        <p>Browse Jobs by Category</p>
		<p>Get most appropriate match</p>
		<p>Win credits</p>
		<p>Browse all Jobs</p>
		<p>Jobs for all skills</p>
		
      </div>
    </div>
  </div><br>
  
  
</div>



<!-- Container (Contact Section) -->
<div id="login" style="height:700px;" class="container-fluid bg-grey logback">
 <div style="padding-left:430px;padding-top:60px;">
 <div class="form-login"><h2 class="text-center">LOG IN</h2>
 <div class="row" id="hideme">
    <form action="#" method="POST">
		<div class="form-group">
			<select class="form-control abc" name="utype">
				<option value="" selected> -- Select Profile --</option>
				<option value="1">Company</option>
				<option value="2">Candidate</option>
			</select>
		</div>
		<div class="form-group">
			<input type="text" class="form-control abc" placeholder="Username" name="uname"/>
		</div>
		<div class="form-group">
			<input type="password" class="form-control abc" placeholder="Password" name="upass"/>
		</div>
		<div class="col-md-offset-5">
			<input type="submit" name="login_form" class="btn btn-warning" value="LOGIN" />
			<a class="xyz" data-toggle="collapse" data-target="#forgot">Forgot Password</a>
		</div>
		
	</form>
	</div>
		<div class="collapse" id="forgot" style="padding-top:20px;">
			<form method="POST" href="#">
			<div class="form-group">
					<select class="form-control abc" name="forgot_type" required>
						<option value="" selected> -- Select Profile --</option>
						<option value="1">Company</option>
						<option value="2">Candidate</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control abc" placeholder="Username" name="forgot_uname" required>
				</div>
				<input type="password" name="forgot_password"  class="form-control" placeholder="Enter New Password" required><br>
				<input type="password" name="forgot_password_confirm" class="form-control" placeholder="Enter New Password" required><br>
				<input type="submit" class="btn btn-warning pull-right" name="forgot_submit" value="submit"/>
			</form>
		</div>
    </div>
	</div>
</div>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Developed By verofeds</p>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
});

function candidatelogin()
{
	$.ajax({
        type:"POST",
        url:"candidatelogin.php",
        async:true,
        cache:false,
        success:function(result){
			$("#fields_add_alert").html(result);
        }
    });	
}

$(".xyz").click(function(){
  $(".abcde").hide();
  $("#hideme").hide();
});


</script>
</body>
</html>
 <?php
}
else{
    echo "<script>document.location='dashboard.php'</script>";
}
?>
