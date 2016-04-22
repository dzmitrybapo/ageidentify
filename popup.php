<?php
/* INCLUDES AND GLOBALS */
header('P3P: CP="CAO PSA OUR"');	//pass session from clients (not sure if works/needed)
session_start();	//set up sessions
$mysqli = new mysqli("localhost", "identify_admin", "Gd5ABUFcId");	//DB connection
$mysqli->select_db("identify_agever");
$testing_enable = 1;	//activate testing mode (no submit, shows all pages)
/* INCLUDES AND GLOBALS */
?>
<html style="width:100%;height:100%;">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<style>
.small_font{ font-size:13px; }
.fa{position: relative; top: 3px;}
.submit_btn{ 	
	width:100%;height:80px;position:absolute;bottom:0px;text-align:center;
	background:#245891;font-weight:bold;font-size:16px;color:white;text-transform:uppercase; 
	font-family:Arial, Helvetica, sans-serif;border:none;
}
.error{ color:red; }
.input{ 
	width:100%;line-height:24px;padding:10px 10px 10px 15px;margin-top:2px;
	background:#EEEEEE;border:none;
	-moz-box-shadow: inset 3px 3px 4px #DEDEDE; -webkit-box-shadow: inset 3px 3px 4px #DEDEDE; box-shadow: inset 3px 3px 4px #DEDEDE;  
}
	
.step_2.text{ width:32%;float:left;margin-right:1.7%;text-align:left; }
.step_2 span{ text-transform:uppercase;font-weight:600;font-size:12px; }
.step_2.text.four{  }
.step_2 .select.y{ width:34%;padding:12px 6px;font-size:14px; }
.step_2 .select.m{ width:30%;padding:12px 6px;font-size:14px; }
.step_2 .select.d{ width:30%;padding:12px 6px;font-size:14px; }
.step_5 .select, .step_8 .select, .step_2 .select{color:#000 !important;}

.step_3.text{ width:35%;text-align:center;margin:auto; }
.step_3 span{ text-transform:uppercase;font-weight:600;font-size:12px; }

.step_5.text, .step_4.text{width:50%;margin:auto;}
.short_form  span, .step_5 span, .step_4 span{ text-transform:uppercase;font-weight:600;font-size:12px; }
.step_4 .input{ background:white;-moz-box-shadow:none; -webkit-box-shadow:none; box-shadow:none;border:1px solid #D6D6D6;  }
.step_2 .select, .step_5 .select, .step_4 .select, .step_8 .select{ 
	-moz-box-shadow: inset 3px 3px 4px #DEDEDE; -webkit-box-shadow: inset 3px 3px 4px #DEDEDE; box-shadow: inset 3px 3px 4px #DEDEDE; background:#EEEEEE;border:none;padding:15px;width:100%;margin-bottom:10px;color:#8A8A8A;
}

.short_form {text-align:left;}
.short_form .text {margin-right: 2.5% !important;}
.short_form .step_8 .select, .short_form .step_2 .select{padding:12px 6px;font-size:14px;}
.short_form .input{margin-top:0px;}
.step_8.text{width:32%;float:left;}

#progress_bar1{ 
	height:3px;width:0px;background:#235791;position:relative;top:-13px;left:25px;
	transition: all 1800ms ease-in 0s; -moz-transition: all 1800ms ease-in 0s;
	-webkit-transition: all 1800ms ease-in 0s; -o-transition: all 1800ms ease-in 0s;
}
#progress_bar2{ 
	height:3px;width:0px;background:#235791;position:relative;top:-13px;left:325px;
	transition: all 1800ms ease-in 0s; -moz-transition: all 1800ms ease-in 0s;
	-webkit-transition: all 1800ms ease-in 0s; -o-transition: all 1800ms ease-in 0s;
}
[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
  position:absolute;
  left:-99999px;
}
[type="checkbox"]:not(:checked) + label, [type="checkbox"]:checked + label {
  position:relative;padding-left:25px;
  cursor:pointer;font-weight:bold;
}
[type="checkbox"]:not(:checked) + label:before, [type="checkbox"]:checked + label:before {
	content: '';
	position: absolute;	top: -3px; left: -8px;	width: 24px; height: 24px;
	border: 1px solid #AAA;	border-radius: 4px;
}
[type="checkbox"]:not(:checked) + label:after, [type="checkbox"]:checked + label:after {
  content:'\2713';
  position:absolute;top:-1px;left:-4px;
  font-size:24px;line-height:22px;
  color:#0B9586;transition:all 150ms;
}
[type="checkbox"]:not(:checked) + label:after {opacity:0;transform:scale(0);}
[type="checkbox"]:checked + label:after {opacity:1;transform:scale(1);}
label:hover:before { border: 1px solid #4778d9!important; }
form > div:first-child{padding-bottom:0px !important;}

@media (max-width:620px){
	.progress_img{width:100%;}
	#progress_bar1{width:45.5% !important;}
	.submit_btn{position:fixed;}
	form > div:first-child{padding-bottom:200px !important;}
	.step_2.desc{width:95% !important;}
	
	.step_2 .select.y{ width:42%; }
	.step_2 .select.m{ width:25%; }
	.step_2 .select.d{ width:25%; }
	.step_5.text, .step_4.text{width:75%;}
	
	.submit_btn{height:60px;}
}
@media (max-width:520px){
	.step_2 .select.y{ width:42%;padding:12px 2px; }
	.step_2 .select.m{ width:26%;padding:12px 2px; }
	.step_2 .select.d{ width:25%;padding:12px 2px; }
	#zip_field.input{ padding:10px 6px 10px 10px; }
	.field_div{width:100% !important;}
}
@media (max-width:480px){
	.field_block{width:100% !important;}
	.step_2.text{width:47%;}
	.step_8.text{width:47% !important;}
	.step_2.text.four{width:47% !important;}
	.col3{width:100% !important;margin-top:5px;}
	.step_2.text.four.col4,
	.step_2.text.four.col5{width:47% !important;margin-top:5px;}
	.step_8.text.col4,.step_8.text.col5{important;margin-top:5px;}
	.step_8.text.full{width:97% !important;}
	.step_5.text, .step_4.text{width:90%;}
	
	.submit_btn{height:40px;}
	
	.progress_block{display:none;}
}
</style>
<meta name="viewport" content="width=device-width, height=device-height,  initial-scale=1.0, user-scalable=no;user-scalable=0;"/>
</head>
<body style="width:100%;height:100%;margin:0px;font-family:Arial, Helvetica,sans-serif;
color:#3E3E3C;font-size:14px;line-height:20px;background:white;">
<?php 
if (!empty($_POST['date_year'])){
	$_POST['DateOfBirth'] = $_POST['date_year'] . "-" . sprintf("%02d", $_POST['date_month']) . "-" . sprintf("%02d", $_POST['date_day']);
}
if (!empty($_GET['a'])){$_POST['Street'] = base64_decode($_GET['a']);}
if (!empty($_GET['f'])){$_POST['FirstName'] = base64_decode($_GET['f']);}
if (!empty($_GET['l'])){$_POST['LastName'] = base64_decode($_GET['l']);}
if (!empty($_GET['z'])){$_POST['ZipCode'] = base64_decode($_GET['z']);}
if (!empty($_GET['c'])){$_POST['City'] = base64_decode($_GET['c']);}
if (!empty($_GET['s'])){$_POST['State'] = base64_decode($_GET['s']);}
if (!empty($_GET['e'])){$_SESSION['av_email'] = base64_decode($_GET['e']);}
if (!empty($_GET['p'])){$_SESSION['av_ordid'] = base64_decode($_GET['p']);}
if (!empty($_GET['i'])){$_SESSION['av_cusid'] = base64_decode($_GET['i']);}
if (!empty($_GET['o'])){$_SESSION['av_stats'] = base64_decode($_GET['o']);}
if (!empty($_GET['w'])){$_SESSION['store_id'] = base64_decode($_GET['w']);}

//LOOK FOR THIS EMAIL IN AI DATABASE
/*TESTING SECOND TIME - UNCOMMENT*/
//$_SESSION['av_email'] = 'avb'; $_SESSION['store_id'] = '1';
$query = "
	SELECT *
	FROM `ageverify_storage` 
	WHERE email='".trim($_SESSION['av_email'])."' AND storeid = '".trim($_SESSION['store_id'])."'
";
$result = $mysqli->query($query);
$count = $result->num_rows;
$item = $result->fetch_all();

/************************ SECOND TIME: ALREADY APPROVED ************************/
//Let the person to a short form if their email is recognized
if ($count == 1){
	$page = 8;
	//PAGINATION + VALIDATION
	if ( !empty($_POST['Continue8']) ){
		if (empty($_POST['answer_text']) || empty($_POST['Ssn']) || 
			empty($_POST['FirstName'])   || empty($_POST['LastName'])){
			$page = 8;		//FORM
		}else{
			//VALIDATION FROM THE DB
			if ($item[0][2]  != $_POST['FirstName'] || 
				$item[0][3]  != $_POST['LastName'] || 
				$item[0][9]  != $_POST['Ssn'] || 
				$item[0][11] != $_POST['answer_text'] || 
				$item[0][10] != $_POST['sec_question'] ||
				$item[0][8]  != $_POST['DateOfBirth']){
				$page = 7;	//FAIL
			}else{
				$page = 5;	//SUCCESS
			}
		}
	}
	if ( !empty($_POST['Continue5']) ){
		//EXIT THE WINDOW
		$page = 5;
	}
	if ( !empty($_POST['Continue7']) ){
		//EXIT THE WINDOW
		$page = 7;
		if ($testing_enable == 1){$page = 8;}
	}
}else{
/************************ FIRST TIME: FULL FORM ************************/
	$page = 1;
	//PAGINATION + VALIDATION
	if ( !empty($_POST['Continue1']) ){
		if (!empty($_POST['check_yes'])){
			$page = 2;
		}
	}
	if ( !empty($_POST['Continue2']) ){
		if (!empty($_POST['check_yes']) && 
			!empty($_POST['FirstName']) && !empty($_POST['LastName']) && !empty($_POST['DateOfBirth']) &&
			!empty($_POST['State']) && !empty($_POST['Street']) && !empty($_POST['ZipCode']) && !empty($_POST['City'])){
			$page = 3;
		}else{$page = 2;}	//Stay on page
	}
	if ( !empty($_POST['Continue3']) ){
		if (!empty($_POST['check_yes']) && 
			!empty($_POST['FirstName']) && !empty($_POST['LastName']) && !empty($_POST['DateOfBirth']) &&
			!empty($_POST['State']) && !empty($_POST['Street']) && !empty($_POST['ZipCode']) && 
			!empty($_POST['City']) && !empty($_POST['Ssn']) && strlen($_POST['Ssn']) == 4){
			$page = 4;
		}else{$page = 3;}	//Stay on page
	}
	if ( !empty($_POST['Continue4']) ){
		if (!empty($_POST['check_yes']) && 
			!empty($_POST['FirstName']) && !empty($_POST['LastName']) && !empty($_POST['DateOfBirth']) &&
			!empty($_POST['State']) && !empty($_POST['Street']) && !empty($_POST['ZipCode']) && 
			!empty($_POST['City']) && !empty($_POST['Ssn']) && strlen($_POST['Ssn']) == 4 && 
			!empty($_POST['sec_question']) && !empty($_POST['answer_text'])){
			$_POST['CountryCode'] = "US";
			
			
			if ($testing_enable == 1){$check_age = true;}else{
				$evs = GetClass('ISC_EVSVERIFICATION');
				$check_age = $evs->VerifyUser($_POST);
			}
			if ($check_age == true){
				//CREATE NEW RECORD IN DB
				$query = "
					INSERT INTO `ageverify_storage`  
					(`customerid`, `fname`, `lname`, 
					 `address`, `city`, `zip`, `state`, 
					 `dateofbirth`, `ssn`, `question`, 
					 `answer`, `email`, `orderid`, `created`) 
					VALUES 
					('".$_SESSION['av_cusid']."', '".$_POST['FirstName']."', '".$_POST['LastName']."', 
					 '".$_POST['Street']."', '".$_POST['City']."', '".$_POST['ZipCode']."', '".$_POST['State']."', 
					 '".$_POST['DateOfBirth']."', '".$_POST['Ssn']."', '".$_POST['sec_question']."', 
					 '".$_POST['answer_text']."', '".$_SESSION['av_email']."', '".$_SESSION['av_ordid']."', NOW());
				";
				$mysqli->query($query);
				$page = 5;
			}else{
				//GIVE SECOND TRY OR GIVE PHONE
				if (empty($_SESSION['av_st'])){
					$_SESSION['av_st'] = "1";
					$page = 6;
				}else{
					unset($_SESSION['av_st']);
					$page = 7;
				}

				if ($testing_enable == 1){$page = 5;}
			}
		}else{$page = 4;}	//Stay on page
	}
	if ( !empty($_POST['Continue5']) ){
		//EXIT THE WINDOW
		$page = 5;
		if ($testing_enable == 1){$page = 6;}
	}
	if ( !empty($_POST['Continue6']) ){
		//RESTART FROM PAGE ONE i.e. DO NOTHING
		$page = 2;
		if ($testing_enable == 1){$page = 7;}
	}
	if ( !empty($_POST['Continue7']) ){
		//EXIT THE WINDOW
		$page = 7;
		if ($testing_enable == 1){$page = 8;}
	}
}

/*************** Update the cookies and order status ***************/
if ($page == 1){
	//SAVE ORIGINAL STATUS TO LOCAL DB ON FIRST VISIT
	updateStatus($item, $_SESSION['av_stats'], $mysqli);
}
if ($page == 5){
	//PASS ORIGINAL STATUS TO LISTENER
	$status_arg = hash("md5", $item[0][14]);
}
if ($page == 8){
	//SAVE ORIGINAL STATUS TO LOCAL DB ON SECOND VISIT
	updateStatus($item, $_SESSION['av_stats'], $mysqli);
}

function updateStatus($item, $old_status, $mysqli){
	//STATUS 23 IS "Waiting age identify approval"
	if ($old_status != 23){
		$query = "
			UPDATE `ageverify_storage`
			SET order_status = '{$old_status}'
			WHERE email = '".$item[0][12]."'
		";
		$mysqli->query($query);
	}
}
?>
<?php if ($page == 1){ ?>
<form action="popup.php" method="POST" name="page_1">
<div style="padding:15px;">
<div>
	<span><i class="fa fa-lock" style="font-size:18px;"></i><span class="small_font">&nbsp;Secure Connection</span></span>
</div>
<div style="text-align:center;padding:3% 0px 3%;">
	<img src="http://s23.postimg.org/kuudygya3/ageverlogo.png"/>
</div>
<div style="width:85%;margin:auto;">
	<p style="margin-top:0px;">
		<b>Smokestik.com</b> has partnered with Age Identify to provide age verification
	</p>
	<p>
		<span style="color:#C82525;">YOUR ORDER HAS BEEN RECEIVED BUT WILL NOT SHIP UNTIL YOUR AGE HAS BEEN VERIFIED</span><br /><br />
		<span style="font-size:12px;">Following new and upcoming legislation in order to provide you with uninterrupted delivery now and in the future SmokeStik has implemented a third party age verification process as prescribed by current and future laws.<br /><br />
        Although your state may not currently have these laws it is likely all states soon will.<br />
		After this initial process subsequent verifications will be more streamlined.<br /><br />
		Age Identify does not share any information - except your age - with Smokestik </span>
	</p>
	<p>
		<a href="#" style="color:#3E3E3C;text-decoration:none;">
			<i class="fa fa-info-circle" style="color:#245891;font-size:18px;"></i>&nbsp;<b><span class="small_font">Learn More</span></b>
		</a>
	</p>
	<p style="text-align:center;margin-top:3%;">
		<input type="checkbox" name="check_yes" value="check_yes" id="check_yes" />
		<label for="check_yes">Yes I agree for my age to be verified by Age Identify.</label>
		<?php if (isset($_POST['Continue1']) && !isset($_POST['check_yes'])){ 
			echo "<br /><span class='error'>Please, check the checkbox to continue.</span>"; 
		} ?>
	</p>
</div>
</div>
<input type="hidden" name="FirstName" value="<?=$_POST['FirstName']?>" />
<input type="hidden" name="LastName" value="<?=$_POST['LastName']?>" />
<input type="hidden" name="Street" value="<?=$_POST['Street']?>" />
<input type="hidden" name="City" value="<?=$_POST['City']?>" />
<input type="hidden" name="State" value="<?=$_POST['State']?>" />
<input type="hidden" name="ZipCode" value="<?=$_POST['ZipCode']?>" />
<input type="hidden" name="DateOfBirth" value="<?=$_POST['DateOfBirth']?>" />

<input class="submit_btn" style="" type="submit" value="Continue" name="Continue1">
</form>
<?php }else if ($page == 2){ ?>
<form action="popup.php" method="POST" name="page_2">
<div style="padding:15px;">
<div>
	<span><i class="fa fa-lock" style="font-size:18px;"></i><span class="small_font">&nbsp;Secure Connection</span></span>
</div>
<div style="text-align:center;padding:3% 0px 4%;">
	<img src="http://s23.postimg.org/kuudygya3/ageverlogo.png"/>
</div>
<div class="field_div" style="width:90%;margin:auto;">
	<div class="progress_block" style="margin-bottom:5%;">
		<img class="progress_img" src="http://s23.postimg.org/gl7pf4hzf/progress_1.png"/>
	</div>
	<p class="step_2 desc" style="width:90%;margin:auto auto 20px;text-align:center;">
		Please enter your information as it appears on your drivers licanse or passport, including all suffixes.
		You must be 18 years or older to purchase from <b>Smokestik.</b>
	</p>
	<div class="field_block" style="width:89%;margin:1% auto auto;text-align:center;">
		<div class="step_2 text">
			<span>First Name</span>
			<input id="firstn_field" type="text" name="FirstName" class="input" value="<?=$_POST['FirstName']?>"/>
		</div>
		<div class="step_2 text">
			<span>Last Name</span>
			<input id="lastn_field" type="text" name="LastName" class="input" value="<?=$_POST['LastName']?>"/>
		</div>
		<div class="step_2 text col3" style="margin-right:0;">
			<?php 
				if (!empty($_POST['DateOfBirth'])){
					$date_arr = explode("-", $_POST['DateOfBirth']);
					$set_year = $date_arr[0];
					$set_month = $date_arr[1];
					$set_day = $date_arr[2];
				}
			?>
			<span style="display:block;margin-bottom:1px;">Date of Birth</span>
			<div></div>
			<select class="select y" name="date_year">
				<?php
					$cy = date("Y"); $oy = $cy - 100;
					for( $y = $cy; $y >= $oy; $y-- ){
						if (!empty($set_year) && $y == $set_year){ $s = "selected"; }else{ $s = ""; }
						echo "<option {$s} value='{$y}'>{$y}</option>";
					}
				?>
			</select>
			<select class="select m" name="date_month">
				<?php
					$cm = 12; $om = 1;
					for( $m = $cm; $m >= $om; $m-- ){
						if (!empty($set_month) && $m == $set_month){ $s = "selected"; }else{ $s = ""; }
						echo "<option {$s} value='{$m}'>{$m}</option>";
					}
				?>
			</select>
			<select class="select d" name="date_day">
				<?php
					$cd = 31; $od = 1;
					for( $d = $cd; $d >= $od; $d-- ){
						if (!empty($set_day) && $d == $set_day){ $s = "selected"; }else{ $s = ""; }
						echo "<option {$s} value='{$d}'>{$d}</option>";
					}
				?>
			</select>
		</div>
		<div style="clear:both;margin-bottom:5px;"></div>
		<div class="step_2 text four" style="width:32%;">
			<span>Address</span>
			<input id="address_field" type="text" name="Street" class="input" value="<?=$_POST['Street']?>"/>
		</div>
		<div class="step_2 text four" style="width:32%;">
			<span>City</span>
			<input id="city_field" type="text" name="City" class="input" value="<?=$_POST['City']?>"/>
		</div>
		<div class="step_2 text four col4" style="width:15%;">
			<span>State</span>
			<input id="state_field" type="text" name="State" class="input" value="<?=$_POST['State']?>" maxlength="2"/>
		</div>
		<div class="step_2 text four col5" style="margin-right:0px;width:15%;">
			<span>Zip</span>
			<input id="zip_field" type="text" name="ZipCode" class="input" value="<?=$_POST['ZipCode']?>"/>
		</div>
		<div style="clear:both;"></div>
		<?php 
		if (!empty($_POST['Continue2']) &&
		(empty($_POST['Street']) || empty($_POST['City']) || 
		 empty($_POST['State']) || empty($_POST['ZipCode']) || 
		 empty($_POST['FirstName']) || empty($_POST['LastName']) || empty($_POST['DateOfBirth']))){ 
			$err_dis = "block";
		}else{$err_dis = "none";} ?>
		<div class="error" id="p2_error_full" style="display:<?=$err_dis?>;">Please, complete all the fields.</div>
		<div class="error" id="p2_error" style="display:none;">Incorrect format for your date of birth.</div>
	</div>
</div>
</div>
<input type="hidden" name="check_yes" value="<?=$_POST['check_yes']?>" />

<input class="submit_btn" style="" type="submit" value="Continue" name="Continue2" onclick="return checkDate();" />
</form>
<?php }else if ($page == 3){ ?>
<form action="popup.php" method="POST" name="page_2">
<div style="padding:15px;">
<div>
	<span><i class="fa fa-lock" style="font-size:18px;"></i><span class="small_font">&nbsp;Secure Connection</span></span>
</div>
<div style="text-align:center;padding:3% 0px 4%;">
	<img src="http://s23.postimg.org/kuudygya3/ageverlogo.png"/>
</div>
<div style="width:90%;margin:auto;">
	<div class="progress_block" style="margin-bottom:5%;">
		<img class="progress_img" src="http://s23.postimg.org/3jqm30iyz/progress_2.png"/>
		<div id="progress_bar1">&nbsp;</div>
	</div>
	<p class="step_2 desc" style="width:90%;margin:auto auto 9%;text-align:center;">
		Please enter the last four digits of your <b>social security number.</b> This information will not be stored nor saved on any website but will be used to accurately verify your age.
	</p>
	<div class="step_3 step_5 text">
		<span>Enter Last Four Digits Below</span>
		<input id="Ssn" type="text" name="Ssn" class="input" value="<?=$_POST['Ssn']?>" maxlength="4">
	</div>
	<div style="clear:both;"></div>
	<?php 
	if (!empty($_POST['Continue3']) && (empty($_POST['Ssn']) || strlen($_POST['Ssn']) < 4)){ 
		$err_dis = "block";
	}else{$err_dis = "none";} ?>
	<div class="error" id="p3_error" style="display:<?=$err_dis?>;text-align:center;">Please, complete all the fields correctly.</div>
</div>
</div>
<input type="hidden" name="check_yes" value="<?=$_POST['check_yes']?>" />
<input type="hidden" name="FirstName" value="<?=$_POST['FirstName']?>" />
<input type="hidden" name="LastName" value="<?=$_POST['LastName']?>" />
<input type="hidden" name="Street" value="<?=$_POST['Street']?>" />
<input type="hidden" name="City" value="<?=$_POST['City']?>" />
<input type="hidden" name="State" value="<?=$_POST['State']?>" />
<input type="hidden" name="ZipCode" value="<?=$_POST['ZipCode']?>" />
<input type="hidden" name="DateOfBirth" value="<?=$_POST['DateOfBirth']?>" />

<input class="submit_btn" style="" type="submit" value="Continue" name="Continue3" />
</form>
<script>
	$(document).ready(function(){
		$("#progress_bar1").css("width", "300px");
	});	
</script>
<?php } else if( $page == 4 ){ ?>
<form action="popup.php" method="POST" name="page_2">
<div style="padding:15px;">
<div>
	<span><i class="fa fa-lock" style="font-size:18px;"></i><span class="small_font">&nbsp;Secure Connection</span></span>
</div>
<div style="text-align:center;padding:3% 0px 4%;">
	<img src="http://s23.postimg.org/kuudygya3/ageverlogo.png"/>
</div>
<div style="width:90%;margin:auto;">
	<div class="progress_block" style="margin-bottom:5%;">
		<img class="progress_img" src="http://s23.postimg.org/i5hmr9frf/progress_3.png"/>
		<div id="progress_bar2">&nbsp;</div>
	</div>
	<p class="step_2 desc" style="width:85%;margin:auto auto 5%;text-align:center;">
		For future verifications please choose a challenge question from the dropdown below.<br />
		This will be used to verify your identity for future purchases.
	</p>
	<div class="step_5 text">
		<span>Choose your Challange Question</span>
		<select class="select" name="sec_question">
			<option value="pet">What is your favorite pet name?</option>
			<option value="movie">What is your favorite movie?</option>
			<option value="car">What is the make of your first car?</option>
			<option value="relative">What is the name of your favorite relative?</option>
		</select>
		<input id="answer_text" type="text" name="answer_text" class="input" value="<?=$_POST['answer_text']?>" placeholder="Enter your anwser here..."/>
	</div>
	<div style="clear:both;"></div>
	<?php 
	if (!empty($_POST['Continue4']) && (empty($_POST['sec_question']) || strlen($_POST['answer_text']) < 4)){ 
		$err_dis = "block";
	}else{$err_dis = "none";} ?>
	<div class="error" id="p3_error" style="display:<?=$err_dis?>;text-align:center;">Please, complete all the fields correctly.</div>
</div>
</div>
<input type="hidden" name="check_yes" value="<?=$_POST['check_yes']?>" />
<input type="hidden" name="FirstName" value="<?=$_POST['FirstName']?>" />
<input type="hidden" name="LastName" value="<?=$_POST['LastName']?>" />
<input type="hidden" name="DateOfBirth" value="<?=$_POST['DateOfBirth']?>" />
<input type="hidden" name="Street" value="<?=$_POST['Street']?>" />
<input type="hidden" name="City" value="<?=$_POST['City']?>" />
<input type="hidden" name="State" value="<?=$_POST['State']?>" />
<input type="hidden" name="ZipCode" value="<?=$_POST['ZipCode']?>" />
<input type="hidden" name="Ssn" value="<?=$_POST['Ssn']?>" />

<input class="submit_btn" style="" type="submit" value="Continue" name="Continue4" />
</form>
<script>
	$(document).ready(function(){
		$("#progress_bar2").css("width", "300px");
	});	
</script>
<?php } else if( $page == 5 ){ ?>

<?php 	if ($testing_enable == 1){ ?>
<form action="popup.php" method="POST" name="page_2">
<?php 	} else { ?>
<form action="http://digi-cig.com/listener.php?r=<?=hash("md5", "av_passed" . $_COOKIE['SHOP_ORDER_TOKEN'])?>&s=<?=$status_arg?>&o=<?=$_SESSION['av_ordid']?>" method="POST" name="page_2">
<?php 	} ?>

<div style="padding:15px;">
<div>
	<span><i class="fa fa-lock" style="font-size:18px;"></i><span class="small_font">&nbsp;Secure Connection</span></span>
</div>
<div style="text-align:center;padding:3% 0px 4%;">
	<img src="http://s23.postimg.org/kuudygya3/ageverlogo.png"/>
</div>
<div style="width:90%;margin:auto;">
	<p style="width:85%;margin:13% auto auto;text-align:center;font-size:20px;line-height:30px;">
		Nice! You're now age verified on<br />
		<b>Smokestik.com</b>
	</p>
	<div style="clear:both;"></div>
</div>
</div>
<input type="hidden" name="check_yes" value="<?=$_POST['check_yes']?>" />
<input type="hidden" name="FirstName" value="<?=$_POST['FirstName']?>" />
<input type="hidden" name="LastName" value="<?=$_POST['LastName']?>" />
<input type="hidden" name="DateOfBirth" value="<?=$_POST['DateOfBirth']?>" />
<input type="hidden" name="Street" value="<?=$_POST['Street']?>" />
<input type="hidden" name="City" value="<?=$_POST['City']?>" />
<input type="hidden" name="State" value="<?=$_POST['State']?>" />
<input type="hidden" name="ZipCode" value="<?=$_POST['ZipCode']?>" />
<input type="hidden" name="Ssn" value="<?=$_POST['Ssn']?>" />
<input type="hidden" name="answer_text" value="<?=$_POST['answer_text']?>" />
<input type="hidden" name="sec_question" value="<?=$_POST['sec_question']?>" />

<input class="submit_btn" style="background:#099686;" type="submit" value="Close and Continue" name="Continue5" />
</form>
<script>
</script>
<?php } else if( $page == 6 ){ ?>
<form action="popup.php" method="POST" name="page_2">
<div style="padding:15px;">
<div>
	<span><i class="fa fa-lock" style="font-size:18px;"></i><span class="small_font">&nbsp;Secure Connection</span></span>
</div>
<div style="text-align:center;padding:3% 0px 4%;">
	<img src="http://s23.postimg.org/kuudygya3/ageverlogo.png"/>
</div>
<div style="width:90%;margin:auto;">
	<p style="width:85%;margin:13% auto auto;text-align:center;font-size:20px;line-height:30px;">
		<b>Sorry!</b> We couldn't verify your age.<br />
		Please try again and double check your spelling.
	</p>
	<div style="clear:both;"></div>
</div>
</div>
<input type="hidden" name="check_yes" value="<?=$_POST['check_yes']?>" />
<input type="hidden" name="FirstName" value="<?=$_POST['FirstName']?>" />
<input type="hidden" name="LastName" value="<?=$_POST['LastName']?>" />
<input type="hidden" name="DateOfBirth" value="<?=$_POST['DateOfBirth']?>" />
<input type="hidden" name="Street" value="<?=$_POST['Street']?>" />
<input type="hidden" name="City" value="<?=$_POST['City']?>" />
<input type="hidden" name="State" value="<?=$_POST['State']?>" />
<input type="hidden" name="ZipCode" value="<?=$_POST['ZipCode']?>" />
<input type="hidden" name="Ssn" value="<?=$_POST['Ssn']?>" />
<input type="hidden" name="answer_text" value="<?=$_POST['answer_text']?>" />
<input type="hidden" name="sec_question" value="<?=$_POST['sec_question']?>" />

<input class="submit_btn" style="background:#8E252C;" type="submit" value="Try Again" name="Continue6" />
</form>
<script>
</script>
<?php } else if( $page == 7 ){ ?>

<?php 	if ($testing_enable == 1){ ?>
<form action="popup.php" method="POST" name="page_2">
<?php 	} else { ?>
<form action="http://digi-cig.com/listener.php?r=<?=hash("md5", "av_failed" . $_COOKIE['SHOP_ORDER_TOKEN'])?>&o=<?=$_SESSION['av_ordid']?>&e=<?=$item[0][12]?>" method="POST" name="page_2">
<?php 	} ?>

<div style="padding:15px;">
<div>
	<span><i class="fa fa-lock" style="font-size:18px;"></i><span class="small_font">&nbsp;Secure Connection</span></span>
</div>
<div style="text-align:center;padding:3% 0px 4%;">
	<img src="http://s23.postimg.org/kuudygya3/ageverlogo.png"/>
</div>
<div style="width:90%;margin:auto;">
	<p style="width:85%;margin:10% auto auto;text-align:center;font-size:20px;line-height:30px;">
		<b>Sorry!</b> We <u>still</u> couldn't verify your age.<br />
		Please leave a contact number so that a CSR can contact you
	</p>
	<div class="step_5 text" style="margin-top:5%;">
		<span>Phone Number</span>
		<input id="phone_num" type="text" name="phone_num" class="input" value="<?=$_POST['phone_num']?>" placeholder="555-555-5555"/>
	</div>
	<div style="clear:both;"></div>
	<?php 
	if (!empty($_POST['Continue7']) && !preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST['phone_num'])){ 
		$err_dis = "block";
	}else{$err_dis = "none";} ?>
	<div class="error" id="p3_error" style="display:<?=$err_dis?>;text-align:center;">Please, format the phone correctly.</div>
</div>
</div>
<input type="hidden" name="check_yes" value="<?=$_POST['check_yes']?>" />
<input type="hidden" name="FirstName" value="<?=$_POST['FirstName']?>" />
<input type="hidden" name="LastName" value="<?=$_POST['LastName']?>" />
<input type="hidden" name="DateOfBirth" value="<?=$_POST['DateOfBirth']?>" />
<input type="hidden" name="Street" value="<?=$_POST['Street']?>" />
<input type="hidden" name="City" value="<?=$_POST['City']?>" />
<input type="hidden" name="State" value="<?=$_POST['State']?>" />
<input type="hidden" name="ZipCode" value="<?=$_POST['ZipCode']?>" />
<input type="hidden" name="Ssn" value="<?=$_POST['Ssn']?>" />
<input type="hidden" name="answer_text" value="<?=$_POST['answer_text']?>" />
<input type="hidden" name="sec_question" value="<?=$_POST['sec_question']?>" />

<input class="submit_btn" style="background:#8E252C;" type="submit" value="Submit and Exit" name="Continue7" onclick="return validatePhone();" />
</form>
<script>
function validatePhone(){
   var phoneNumberPattern = /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/;  
	if (phoneNumberPattern.test($("#phone_num").val())){
		$("#p3_error").hide();
		return true;
	}else{
		$("#p3_error").show();
		return false;
	} 
}
</script>
<?php }else if ($page == 8){ ?>
<div id="foo"></div>
<form action="popup.php" method="POST" name="page_8">
<div style="padding:15px;">
<div>
	<span><i class="fa fa-lock" style="font-size:18px;"></i><span class="small_font">&nbsp;Secure Connection</span></span>
</div>
<div style="text-align:center;padding:3% 0px 4%;">
	<img src="http://s23.postimg.org/kuudygya3/ageverlogo.png"/>
</div>
<div style="width:90%;margin:auto;">
	<p style="width:95%;margin:auto;text-align:center;padding-bottom:40px;">
		<span style="color:#C82525;">YOUR ORDER HAS BEEN RECEIVED BUT WILL NOT SHIP UNTIL YOUR AGE HAS BEEN VERIFIED</span><br />
		It looks like you're a returning customer and you've already completed the Age Verify form before!<br />
		To confirm that we will need you to provide information below and we can approve your order.
	</p>
	<div class="short_form">
		<div class="step_8 text" style="width:25%;">
			<span>First Name</span>
			<input id="firstn_field" type="text" name="FirstName" class="input" value="<?=$_POST['FirstName']?>"/>
		</div>
		<div class="step_8 text" style="width:37%;">
			<span>Last Name</span>
			<input id="lastn_field" type="text" name="LastName" class="input" value="<?=$_POST['LastName']?>"/>
		</div>
		<div class="step_2 text col3"  style="margin-right:0 !important;width:31%;">
			<?php 
				if (!empty($_POST['DateOfBirth'])){
					$date_arr = explode("-", $_POST['DateOfBirth']);
					$set_year = $date_arr[0];
					$set_month = $date_arr[1];
					$set_day = $date_arr[2];
				}
			?>
			<span>Date of Birth</span>
			<div></div>
			<select class="select y" name="date_year">
				<?php
					$cy = date("Y"); $oy = $cy - 100;
					for( $y = $cy; $y >= $oy; $y-- ){
						if (!empty($set_year) && $y == $set_year){ $s = "selected"; }else{ $s = ""; }
						echo "<option {$s} value='{$y}'>{$y}</option>";
					}
				?>
			</select>
			<select class="select m" name="date_month">
				<?php
					$cm = 12; $om = 1;
					for( $m = $cm; $m >= $om; $m-- ){
						if (!empty($set_month) && $m == $set_month){ $s = "selected"; }else{ $s = ""; }
						echo "<option {$s} value='{$m}'>{$m}</option>";
					}
				?>
			</select>
			<select class="select d" name="date_day">
				<?php
					$cd = 31; $od = 1;
					for( $d = $cd; $d >= $od; $d-- ){
						if (!empty($set_day) && $d == $set_day){ $s = "selected"; }else{ $s = ""; }
						echo "<option {$s} value='{$d}'>{$d}</option>";
					}
				?>
			</select>
		</div>
		
		<div style="clear:both;margin-bottom:5px;"></div>
		
		<div class="step_8 text full" style="width:25%;">
			<span>Last Four Digits of SSN</span>
			<input id="Ssn" type="text" name="Ssn" class="input" value="<?=$_POST['Ssn']?>" maxlength="4">
		</div>
		
		<div class="step_8 text col4" style="width:37%;">
			<span>Challange Question</span>
			<select class="select" name="sec_question">
				<option value="pet">What is your favorite pet name?</option>
				<option value="movie">What is your favorite movie?</option>
				<option value="car">What is the make of your first car?</option>
				<option value="relative">What is the name of your favorite relative?</option>
			</select>
		</div>
		
		<div class="step_8 text col5" style="margin-right:0 !important;width:31%;">
			<span>Challange Question Answer</span>
			<input id="answer_text" type="text" name="answer_text" class="input" value="<?=$_POST['answer_text']?>" placeholder="Enter your anwser here..."/>
		</div>
		<div style="clear:both;"></div>
		<?php 
		if (!empty($_POST['Continue8']) &&
		(empty($_POST['answer_text']) || empty($_POST['Ssn']) || 
		 empty($_POST['FirstName']) || empty($_POST['LastName']))){ 
			$err_dis = "block";
		}else{$err_dis = "none";} ?>
		<div class="error" id="p2_error_full" style="display:<?=$err_dis?>;text-align: center;">Please, complete all the fields.</div>
	</div>
</div>
</div>

<input class="submit_btn" type="submit" style="background:#099686;" value="Submit" name="Continue8" />
</form>
<?php } ?>
</body>
</html>