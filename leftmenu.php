<?php
@session_start();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];

echo '<nav class="navbar1 navbar-default sidebar" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
		<ul class="nav navbar-nav">';
		if($login == '1')
		{
			echo '
			<li><a href="#dashboard" data-toggle="tab">Dashboard<span style="font-size:16px;color:#A3CB38;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
					  
			<li><a href="#add_posts" data-toggle="tab" onclick="addposts();">Post a Job<span style="font-size:16px;color:#7f8fa6;"  class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li> 

			<li><a href="#manage_jobs" data-toggle="tab" onclick="managejobs();">Manage Jobs<span style="font-size:16px;color:#38ada9;"  class="pull-right hidden-xs showopacity glyphicon glyphicon-lock"></span></a></li> 
			
			<li><a href="#manage_candidates" data-toggle="tab" onclick="managecandidates();">Manage Candidates<span style="font-size:16px;color:#f6b93b;"  class="pull-right hidden-xs showopacity fa fa-users"></span></a></li> 
			
			<li ><a href="#comp_profile" data-toggle="tab" onclick="compprofile();">Edit Profile<span style="font-size:16px;color:#DC143C;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span></a></li>';
		}
		else
		{
			echo '
			<li class="active"><a href="#dashboard" data-toggle="tab">Cand Dashboard<span style="font-size:16px;color:#A3CB38;" data-toggle="tab" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
					  
			<li ><a href="#applications" data-toggle="tab" onclick="getapplications();">Applications<span style="font-size:16px;color:#7f8fa6;" data-toggle="tab" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li> 
			
			<li ><a href="#view_application" data-toggle="tab" onclick="view_application();">View Applications<span style="font-size:16px;color:#38ada9;" data-toggle="tab" class="pull-right hidden-xs showopacity fa fa-file-text"></span></a></li>
			
			<li ><a href="#resume" data-toggle="tab" onclick="writeresume();">Resume<span style="font-size:16px;color:#f6b93b;" data-toggle="tab" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
			
			<li ><a href="#cand_profile" data-toggle="tab" onclick="candprofile();">My Profile<span style="font-size:16px;color:#DC143C;" data-toggle="tab" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>';
		}
		echo '</ul>
    </div>
  </div>
</nav>';
?>