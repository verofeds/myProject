<?php
@session_start();
$username = $_SESSION['sessionuser'];
$login = $_SESSION['login'];
?>





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
        <li><a href="#about"><?php echo $username; ?></a></li>
         <!--<li><a href="#services">SERVICES</a></li>
       <li><a href="#portfolio">PORTFOLIO</a></li>
        <li><a href="#pricing">PRICING</a></li>
		<li class=" dropdown">
			<a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">LOGIN <span class="caret"></span></a>
               <ul class="dropdown-menu">
                    <li>
                        <a href="#" onclick="candidatelogin();" class="dropdown-toggle" data-toggle="modal" data-target="#candidatemodal" role="button" aria-haspopup="true" aria-expanded="false">CANDIDATE</a>
					</li>
                    <li><a href="#" onclick="companylogin();">COMPANY</a></li>
                </ul>
        </li>-->
		<li><a href="logout.php">LOGOUT <span class="glyphicon glyphicon-hand-right"></span></a></li>
		
      </ul>
    </div>
	 </div>
</nav>
	
	