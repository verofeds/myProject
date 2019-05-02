<html lang="en">
<head>
	<title>Your Dashboard</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet"/>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		
		<!--<script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">-->
		
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet"/>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="css/home.css"/>
		<link rel="stylesheet" href="css/leftmenu.css"/>
</head>
<body>
<?php
@session_start();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
include('header.php');
if($_SESSION['login'])
{

?>
<div class="col-md-12">
<div class="col-md-2" style="padding-left:0px;padding-top:50px;position:fixed;z-index: 1;overflow-x: hidden;">
    <div id="left_menu">
	</div>
</div>
<div class="tab-content col-md-10" style="padding-top:40px;padding-left:200px;">
	
	<div id="dashboard" class="tab-pane active">
		
	</div>
	
	<div id="applications" class="tab-pane">
	
	</div>
	<div id="resume" class="tab-pane">
	
	</div>
	<div id="cand_profile" class="tab-pane">
	
	</div>
	<div id="add_posts" class="tab-pane">
	
	</div>
	<div id="manage_jobs" class="tab-pane">
	
	</div>
	<div id="manage_candidates" class="tab-pane">
	
	</div>
	<div id="comp_profile" class="tab-pane">
	
	</div>
	<div id="view_application" class="tab-pane">
	
	</div>
</div>
</div>
</body>
<script>

$(document).ready(function(){

	$.ajax({
	  type: "GET",
	  url:"leftmenu.php",
	  async:true,
	  cache:false,
	  success:function(result){
		$("#left_menu").html(result);
	  }
	});
	
	$.ajax({
	  type: "GET",
	  url:"cand_home.php",
	  async:true,
	  cache:false,
	  success:function(result){
		$("#dashboard").html(result);
	  }
	});
  
});

function addposts(){
	$.ajax({
		type: "GET",
		url:"company/jobposts.php",
		success:function(result){
			$("#add_posts").html(result);
		}
	});
}

function getapplications(){
	$.ajax({
		type: "GET",
		url:"candidate/applications.php",
		success:function(result){
			$("#applications").html(result);
		}
	});
}

function view_application(){
	$.ajax({
		type: "GET",
		url:"candidate/view_applications.php",
		success:function(result){
			$("#view_application").html(result);
		}
	});
}

function compprofile(){
	$.ajax({
		type: "GET",
		url:"company/comp_profile.php",
		success:function(result){
			$("#comp_profile").html(result);
		}
	});
}

function candprofile()
{
	$.ajax({
		type: "GET",
		url:"candidate/cand_profile.php",
		success:function(result){
			$("#cand_profile").html(result);
		}
	});
}

function writeresume()
{
	$.ajax({
		type: "GET",
		url:"candidate/resume.php",
		success:function(result){
			$("#resume").html(result);
		}
	});
}

function managejobs()
{
	$.ajax({
		type: "GET",
		url:"company/manage_jobs.php",
		success:function(result){
			$("#manage_jobs").html(result);
		}
	});
}

function managecandidates()
{
	$.ajax({
		type: "GET",
		url:"company/manage_candidates.php",
		success:function(result){
			$("#manage_candidates").html(result);
		}
	});
}

</script>
<?php
}
else{
	echo "<script>document.location='index.php'</script>";
}
 ?>
 </html>