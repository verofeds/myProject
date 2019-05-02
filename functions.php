<?php
define("DBHOST","localhost");
define("DBUSER","root");
define("DBPWD","");
define("DB","getjob");

date_default_timezone_set("Asia/Kolkata");
error_reporting(E_ALL ^ E_DEPRECATED);

class DB_FUNCTIONS {
	
	public function __construct(){
		 $this->db = @mysqli_connect(DBHOST,DBUSER,DBPWD,DB);
	}
	
	public function company_register($company_name,$company_email,$company_number,$company_per_name,$select_uniqueid)
	{
		$query = "INSERT INTO company(comp_name,comp_email,comp_phone,comp_pname,userid) VALUES('$company_name','$company_email','$company_number','$company_per_name','$select_uniqueid')";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function company_loginreg($escapedname,$hashedpwd,$salt,$select_uniqueid)
	{
		$query = "INSERT INTO users(type,username,password,userid,salt) VALUES('1','$escapedname','$hashedpwd','$select_uniqueid','$salt')";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function candidate_register($cand_first_name,$cand_last_name,$cand_phone_number,$cand_email,$select_uniqueid)
	{
		$query = "INSERT INTO candidate(first_name,last_name,mobile_no,email,userid) VALUES('$cand_first_name','$cand_last_name','$cand_phone_number','$cand_email','$select_uniqueid')";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function candidate_loginreg($cand_email,$cand_pass,$select_uniqueid,$salt)
	{
		$query = "INSERT INTO users(type,username,password,salt,userid) VALUES('2','$cand_email','$cand_pass','$salt','$select_uniqueid')";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function checkuser($utype,$uname,$upass)
	{
		$saltquery = "select * from users where username = '$uname' and password = '$upass' and type = '$utype';";
		$result = @mysqli_query($this->db,$saltquery);
		$data = @mysqli_fetch_assoc($result);
		return $data;
	}
	
	public function checkuserexist($username){
		$saltquery = "select userid from users where username = '$username';";
		$result = @mysqli_query($this->db,$saltquery);
		$data = @mysqli_fetch_assoc($result);
		return $data;
	}
	
	public function getsalt($escapedname){
		$saltquery = "select salt from users where username = '$escapedname';";
		$result = @mysqli_query($this->db,$saltquery);
		$data = @mysqli_fetch_assoc($result);
		return $data;
	}
	
	public function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	public function get_name($userid,$login)
	{
		$query = "SELECT * FROM users WHERE userid = '$userid' and type = '$login' ";
		$result = @mysqli_query($this->db,$query);
		$data = @mysqli_fetch_assoc($result);
		return $data;
	}
	
	public function get_rand_id($length)
	{
	  if($length>0) 
	  { 
	  $rand_id="";
		mt_srand((double)microtime() * 1000000);
	   for($i=1; $i<=$length; $i++)
	   {
	   $numone = mt_rand(1,36);
	   $rand_id .= $this->assign_rand_value($numone);
	   }
	  }
	return strtoupper($rand_id);
	}
	
	public function assign_rand_value($numone)
	{
// accepts 1 - 36
  switch($numone)
	{
    case "1":
     $rand_value = "a";
    break;
    case "2":
     $rand_value = "b";
    break;
    case "3":
     $rand_value = "c";
    break;
    case "4":
     $rand_value = "d";
    break;
    case "5":
     $rand_value = "e";
    break;
    case "6":
     $rand_value = "f";
    break;
    case "7":
     $rand_value = "g";
    break;
    case "8":
     $rand_value = "h";
    break;
    case "9":
     $rand_value = "i";
    break;
    case "10":
     $rand_value = "j";
    break;
    case "11":
     $rand_value = "k";
    break;
    case "12":
     $rand_value = "l";
    break;
    case "13":
     $rand_value = "m";
    break;
    case "14":
     $rand_value = "n";
    break;
    case "15":
     $rand_value = "o";
    break;
    case "16":
     $rand_value = "p";
    break;
    case "17":
     $rand_value = "q";
    break;
    case "18":
     $rand_value = "r";
    break;
    case "19":
     $rand_value = "s";
    break;
    case "20":
     $rand_value = "t";
    break;
    case "21":
     $rand_value = "u";
    break;
    case "22":
     $rand_value = "v";
    break;
    case "23":
     $rand_value = "w";
    break;
    case "24":
     $rand_value = "x";
    break;
    case "25":
     $rand_value = "y";
    break;
    case "26":
     $rand_value = "z";
    break;
    case "27":
     $rand_value = "0";
    break;
    case "28":
     $rand_value = "1";
    break;
    case "29":
     $rand_value = "2";
    break;
    case "30":
     $rand_value = "3";
    break;
    case "31":
     $rand_value = "4";
    break;
    case "32":
     $rand_value = "5";
    break;
    case "33":
     $rand_value = "6";
    break;
    case "34":
     $rand_value = "7";
    break;
    case "35":
     $rand_value = "8";
    break;
    case "36":
     $rand_value = "9";
    break;
  }
return $rand_value;
}

	public function select_uniqueid(){
		
		$getorgid = $this->get_rand_id(6);
		$query = "select * from users where userid = '$getorgid';";
		$result = @mysqli_query($this->db,$query);
		$gotrows = @mysqli_num_rows($result);
		if($gotrows > 0){
			$this->select_uniqueid();
		}
		else{
			return $getorgid;
		}
	}
	
	public function select_uniquejobid(){
		
		$jobid = $this->get_rand_id(6);
		$query = "select * from job_posts where jobid = '$jobid';";
		$result = @mysqli_query($this->db,$query);
		$gotrows = @mysqli_num_rows($result);
		if($gotrows > 0){
			$this->select_uniquejobid();
		}
		else{
			return $jobid;
		}
	}
	
	public function check_ifresume_exixts($userid)
	{
		$query = "SELECT * FROM resume WHERE userid = '$userid' ";
		$result = @mysqli_query($this->db,$query);
		$data = @mysqli_fetch_assoc($result);
		return $data;
	}
	
	public function update_password_comp($login,$userid,$salt,$hashedpwd)
	{ 
		$query = "UPDATE users SET password = '$hashedpwd', salt = '$salt' WHERE userid = '$userid' and type = '$login'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function update_password($login,$userid,$salt,$hashedpwd)
	{ 
		$query = "UPDATE users SET password = '$hashedpwd', salt = '$salt' WHERE username = '$userid' and type = '$login'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function get_company_data($userid){
		$query = "select * from company where userid = '$userid'";
		$result = @mysqli_query($this->db,$query);
		while($row = @mysqli_fetch_assoc($result)) {
			$data[] = $row;
		}
		return $data;
	}
	
	public function apply_job($userid,$jobid,$apply_ans1,$apply_ans2)
	{
		$query = "INSERT INTO apply_job(userid,jobid,ans1,ans2) VALUES('$userid','$jobid','$apply_ans1','$apply_ans2')";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function get_allcompany_data(){
		$query = "select * from company where 1";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_jobsapplied($userid){
		$query = "select * from apply_job where userid = '$userid'";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_jobsapplied_byjobid($jobid){
		$query = "select * from apply_job where jobid = '$jobid'";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_jobsapplied_only($jobid){
		$query = "select * from apply_job where jobid = '$jobid' and (status = 'Applied' or status = 'Shortlisted' or status = 'Hired' or status = 'Rejected') ";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_hired_candidates_only($jobid){
		$query = "select * from apply_job where jobid = '$jobid' and status = 'Hired' ";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_shortlistedcand_only($jobid){
		$query = "select * from apply_job where jobid = '$jobid' and (status = 'Rejected' or status = 'Shortlisted' or status = 'Hired') ";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_candidate_application($jobid,$userid){
		$query = "select * from apply_job where jobid = '$jobid' and userid = '$userid' and (status = 'Rejected' or status = 'Shortlisted' or status = 'Hired') ";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_jobsapplied_byjobiduserid($userid,$jobid){
		$query = "select * from apply_job where userid = '$userid' and jobid = '$jobid'";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function load_logo($userid,$image)
	{
		$query = "UPDATE job_posts SET image = '$image' WHERE userid = '$userid'";
		$enter = @mysqli_query($this->db,$query);
		return $enter;
	}
	
	public function get_alljobsfordashboard(){
		$query = "select * from job_posts where deleted = '0' and job_vacancy > 0";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_alljobs_filtered($category,$location,$type){
		$query = "select * from job_posts where deleted = '0' and job_vacancy > 0 and job_category like '$category' and job_location like '$location' and job_type like '$type'";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_candidate_data($userid){
		$query = "select * from candidate where userid = '$userid'";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	
	}
	
	public function update_comp_details($userid,$comp_name,$comp_email,$comp_pname,$comp_phone,$comp_pname_no,$comp_category,$google_link,$linked_link,$twitter_link,$facebook_link,$about_comp,$estab_since,$team_size)
	{
		$query = "UPDATE company SET comp_name = '$comp_name', comp_email = '$comp_email', comp_pname = '$comp_pname', comp_phone = '$comp_phone', comp_mobile = '$comp_pname_no', comp_category = '$comp_category', comp_website = '$google_link', linked_link = '$linked_link', twitter_link = '$twitter_link', facebook_link = '$facebook_link', comp_about = '$about_comp', established_since = '$estab_since', team_size = '$team_size' WHERE userid = '$userid'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function update_cand_details($userid,$cand_first_name,$cand_last_name,$cand_mobile)
	{
		$query = "UPDATE candidate SET first_name = '$cand_first_name', last_name = '$cand_last_name', mobile_no = '$cand_mobile' WHERE userid = '$userid' ";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function get_resumedetails($userid)
	{
		$query = "select * from resume where userid = '$userid'";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}
	}
	
	public function add_resumedetails($userid,$resume_first_name,$resume_last_name,$date_ofbirth,$resume_gender,$resume_city,$resume_state,$resume_email,$resume_mobile,$resume_pincode,$resume_pan,$resume_aadhar,$resume_address,$resume_school,$resume_board,$resume_school_year,$school_marks,$resume_college,$resume_college_stream,$resume_college_year,$resume_college_marks,$resume_degree_stream,$resume_degree_year,$resume_degree_marks,$resume_pg_name,$resume_pg_stream,$resume_pg_year,$resume_pg_marks,$resume_org_name,$resume_job_description,$resume_job_exp,$resume_job_profile,$resume_degree_name,$resume_job_designation,$resume_worksamp,$resume_job_type,$resume_job_location,$job_skillstring,$school,$high_school,$graduation,$post_graduation,$resume_start_date,$resume_end_date)
	{
		$query = "INSERT into resume(userid,first_name,last_name,date_of_birth,gender,city,state,email,mobile,pincode,pan_no,aadhar_no,address,school_name,school_board,school_year,school_marks,high_school_name,high_school_stream,high_school_year,high_school_marks,graduation_name,graduation_stream,graduation_year,graduation_marks,pg_name,pg_stream,pg_year,pg_marks,org_name,org_desc,org_experience,org_profile,org_designation,work_sample,job_type,job_location,skills,school,high_school,graduation,pg,org_start_date,org_end_date) VALUES('$userid','$resume_first_name','$resume_last_name','$date_ofbirth','$resume_gender','$resume_city','$resume_state','$resume_email','$resume_mobile','$resume_pincode','$resume_pan','$resume_aadhar','$resume_address','$resume_school','$resume_board','$resume_school_year','$school_marks','$resume_college','$resume_college_stream','$resume_college_year','$resume_college_marks','$resume_degree_name','$resume_degree_stream','$resume_degree_year','$resume_degree_marks','$resume_pg_name','$resume_pg_stream','$resume_pg_year','$resume_pg_marks','$resume_org_name','$resume_job_description','$resume_job_exp','$resume_job_profile','$resume_job_designation','$resume_worksamp','$resume_job_type','$resume_job_location','$job_skillstring','$school','$high_school','$graduation','$post_graduation','$resume_start_date','$resume_end_date')";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function add_jobposts($userid,$jobid,$job_title,$job_type,$expiry_date,$job_category,$job_designation,$job_salary,$job_experience,$job_qualification,$job_vacancy,$job_location,$job_eligibility,$job_gender,$job_desc,$job_perks,$job_musthave,$job_qts1,$job_qts2,$jsonjob_skillsarray)
	{
		$query = "INSERT INTO job_posts(userid,jobid,job_title,job_type,expiry_date,job_category,job_designation,job_salary,job_experience,job_qualification,job_vacancy,job_location,job_eligibility,job_gender,job_desc,job_perks,job_musthave,job_qts1,job_qts2,job_skills) VALUES('$userid','$jobid','$job_title','$job_type','$expiry_date','$job_category','$job_designation','$job_salary','$job_experience','$job_qualification','$job_vacancy','$job_location','$job_eligibility','$job_gender','$job_desc','$job_perks','$job_musthave','$job_qts1','$job_qts2','$jsonjob_skillsarray')";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function delete_jobposts($userid,$jobid)
	{
		$query = "UPDATE job_posts SET deleted = 1 WHERE userid = '$userid' and jobid = '$jobid'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function upload_profile($userid,$image,$imagetmp)
	{
		$query = "UPDATE candidate SET image = '$image', image_name = '$imagetmp' WHERE userid = '$userid'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function insert($userid,$image,$imagename)
	{
		$query = "UPDATE company SET image = '$image',image_name = '$imagename' WHERE userid = '$userid'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function shortlist_candidate($cand_userid,$jobid)
	{
		$query ="UPDATE apply_job SET status = 'Shortlisted' WHERE userid = '$cand_userid' and jobid = '$jobid'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function reject_candidate($cand_userid,$jobid)
	{
		$query ="UPDATE apply_job SET status = 'Rejected' WHERE userid = '$cand_userid' and jobid = '$jobid'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function hire_candidate($cand_userid,$jobid)
	{
		$query ="UPDATE apply_job SET status = 'Hired' WHERE userid = '$cand_userid' and jobid = '$jobid'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function show($userid)
	{
		$query = "select * from company where userid = '$userid'";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	
	}
	
	public function get_number_of_posts($userid){
		$query = "select * from job_posts where userid = '$userid';";
		$result = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($result);
		return $num_rows;
	}
	
	public function get_number_of_applications_dash(){
		$query = "select * from job_posts where deleted = '0' and job_vacancy > 0";
		$result = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($result);
		return $num_rows;
	}
	
	public function get_number_of_applicants($jobid){
		$query = "select * from apply_job where jobid = '$jobid';";
		$result = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($result);
		return $num_rows;
	}
	
	public function get_number_of_applicants_pending($jobid){
		$query = "select * from apply_job where jobid = '$jobid' and (status = 'Applied' or status = 'Shortlisted');";
		$result = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($result);
		return $num_rows;
	}
	
	public function get_number_of_applicants_shortlisted($userid){
		$query = "select * from apply_job where userid = '$userid' and status = 'Shortlisted';";
		$result = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($result);
		return $num_rows;
	}
	
	public function get_number_of_applicants_pend_cand($userid){
		$query = "select * from apply_job where userid = '$userid' and status != 'Shortlisted';";
		$result = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($result);
		return $num_rows;
	}
	
	public function get_number_of_applicants_hired($jobid){
		$query = "select * from apply_job where jobid = '$jobid' and status = 'Hired';";
		$result = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($result);
		return $num_rows;
	}

	public function get_alljobs($userid)
	{
		$query = "SELECT * FROM job_posts WHERE userid = '$userid' and deleted = 0";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function update_vacancy($jobid,$userid,$job_vacancy)
	{
		$query = "UPDATE job_posts SET job_vacancy = '$job_vacancy' WHERE userid = '$userid' and jobid = '$jobid'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function getjob_byjobid($jobid)
	{
		$query = "SELECT * FROM job_posts WHERE jobid = '$jobid' and deleted = 0";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_alljobtype()
	{
		$query = "SELECT * FROM job_type";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_year(){
		$query = "select * from year where 1";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}
	}
	
	public function get_alljobcategory()
	{
		$query = "SELECT * FROM job_category";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_alljobdesignation()
	{
		$query = "SELECT * FROM job_designation";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_alljobqualification()
	{
		$query = "SELECT * FROM job_qualification";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_alljobexperience()
	{
		$query = "SELECT * FROM job_experience";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_alljobskills()
	{
		$query = "SELECT * FROM job_skills";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_allsalary()
	{
		$query = "SELECT * FROM salary_offered";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function get_alljoblocation()
	{
		$query = "SELECT * FROM job_location";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function getjob_byid($userid,$jobid)
	{
		$query = "SELECT * FROM job_posts WHERE userid = '$userid' and jobid = '$jobid'";
		$enter = @mysqli_query($this->db,$query);
		$num_rows = @mysqli_num_rows($enter);
		if($num_rows>0) {
        	while($row=@mysqli_fetch_assoc($enter))
			{$data1[]=$row;}
		return $data1;
		}	

	}
	
	public function update_jobposts($userid,$jobid_for_update,$job_title,$job_type,$expiry_date,$job_category,$job_designation,$job_salary,$job_experience,$job_qualification,$job_vacancy,$job_location,$job_eligibility,$job_gender,$job_desc,$job_perks,$job_musthave,$job_qts1,$job_qts2,$job_skillstring)
	{
		$query = "UPDATE job_posts SET job_title = '$job_title', job_type = '$job_type', expiry_date = '$expiry_date', job_category = '$job_category', job_designation = '$job_designation', job_salary = '$job_salary', job_experience = '$job_experience', job_qualification = '$job_qualification', job_vacancy = '$job_vacancy', job_location = '$job_location', job_eligibility = '$job_eligibility', job_gender = '$job_gender', job_desc = '$job_desc', job_perks = '$job_perks', job_musthave = '$job_musthave', job_qts1 = '$job_qts1', job_qts2 = '$job_qts2', job_skills = '$job_skillstring' WHERE jobid='$jobid_for_update' and userid = '$userid' ";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
	
	public function update_resumedetails($userid,$resupfirst_name,$resuplast_name,$date_ofbirth,$resupgender,$resupcity,$resupstate,$resupemail,$resupmobile,$resuppincode,$resuppan,$resupaadhar,$resupaddress,$resupschool,$resupboard,$resupschool_year,$school_marks,$resupcollege,$resupcollege_stream,$resupcollege_year,$resupcollege_marks,$resupdegree_stream,$resupdegree_year,$resupdegree_marks,$resuppg_name,$resuppg_stream,$resuppg_year,$resuppg_marks,$resuporg_name,$resupjob_description,$resupjob_exp,$resupjob_profile,$resupdegree_name,$resupjob_designation,$resupworksamp,$resupjob_type,$resupjob_location,$job_skillstring,$school,$high_school,$graduation,$post_graduation,$resupstart_date,$resupend_date)
	{
		$query = "UPDATE resume SET first_name = '$resupfirst_name', last_name = '$resuplast_name' , date_of_birth = '$date_ofbirth', gender = '$resupgender',city = '$resupcity', state = '$resupstate' , email = '$resupemail' , mobile = '$resupmobile', pincode = '$resuppincode', pan_no = '$resuppan',aadhar_no = '$resupaadhar' , address = '$resupaddress' , school_name = '$resupschool' , school_board = '$resupboard' , school_year = '$resupschool_year', school_marks = '$school_marks' , high_school_name = '$resupcollege' , high_school_stream = '$resupcollege_stream' , high_school_year = '$resupcollege_year' , high_school_marks = '$resupcollege_marks', graduation_stream = '$resupdegree_stream' , graduation_year = '$resupdegree_year' , graduation_marks = '$resupdegree_marks', pg_name = '$resuppg_name' , pg_stream = '$resuppg_stream', pg_year = '$resuppg_year',pg_marks = '$resuppg_marks', org_name = '$resuporg_name', org_desc = '$resupjob_description', org_experience = '$resupjob_exp' , org_profile = '$resupjob_profile' , graduation_name = '$resupdegree_name', org_designation = '$resupjob_designation', work_sample = '$resupworksamp', job_type = '$resupjob_type', job_location = '$resupjob_location' , skills = '$job_skillstring', school = '$school' , high_school = '$high_school', graduation = '$graduation', pg = '$post_graduation', org_start_date = '$resupstart_date', org_end_date = '$resupend_date' WHERE userid = '$userid'";
		$result = @mysqli_query($this->db,$query);
		return $result;
	}
}
?>