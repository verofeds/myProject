<?php
@session_start();
include('../functions.php');
$db = new DB_FUNCTIONS();
$username = $_SESSION['sessionuser'];

$userid = $_POST['userid'];
$get_company_data = $db->get_company_data($userid);
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
	$image_name = $row['image_name'];
}

echo '<div class="col-md-12 well">
	<div class="col-md-4">
		<img style="margin-left: auto;margin-right: auto;"  src="data:image/jpeg;base64,'.base64_encode($image_name).'" height=90 width=90/>
	</div>
	<div class="col-md-8">
		<h4>'.$company_name.'</h4>
	</div>
	<i class="fa fa-phone" aria-hidden="true" style="color:#FF7F50;"></i> '.$comp_phone.'&nbsp;&nbsp;<i style="color:#FF7F50;" class="fa fa-envelope" aria-hidden="true"></i>
&nbsp;&nbsp;'.$comp_email.' &nbsp;&nbsp;<i class="fa fa-users" style="color:#FF7F50;" aria-hidden="true"></i>&nbsp;&nbsp;'.$team_size.'</br>
	<hr style="color:black;">
      <p style="font-size:14px;">
        '.$comp_about.' 
      </p>
      ';
      if($twitter_link)
	  {
		  echo '<a href="'.$twitter_link.'" target="_blank"><i class="fa fa-twitter pull-right" style="color:#4ADFCC" aria-hidden="true"></i>&nbsp;</a>&nbsp;&nbsp;';
	  }
	  if($linked_link)
	  {
		  echo '<a href="'.$linked_link.'" target="_blank"><i class="fa fa-linkedin-square pull-right" style="color:#000080"></i>&nbsp;</a>&nbsp;&nbsp;';
	  }
	  if($comp_website)
	  {
		  echo '<a href="'.$comp_website.'" target="_blank"><i class="fa fa-google pull-right" aria-hidden="true" style="color:#ff4500"></i>&nbsp;</a>&nbsp;&nbsp;';
	  }
	  if($facebook_link)
	  {
		  echo '<a href="'.$facebook_link.'" target="_blank"><i class="fa fa-facebook pull-right" style="color:blue;" aria-hidden="true"></i>&nbsp;</a>&nbsp;&nbsp;';
	  }
	   
echo '</div>';
?>