<?php
session_start();
//Error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);
/*************************************
* Including helpers.php file
* It has render function
* to render the header and footer
* file.
**************************************/
require_once('../../includes/helpers.php');

if(isset($_POST["next"]) && $_POST["next"] == "Next")
{
	$errors = "";
    if(!isset($_POST["Name"]) || $_POST["Name"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 1.</p>'; }
    //if(!isset($_POST["lname"]) || $_POST["lname"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory.</p>'; }
    if(!isset($_POST["usertype"]) || $_POST["usertype"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 2.</p>'; }
	//if(!isset($_POST["gender"]) || $_POST["gender"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory.</p>'; }
	//if(!isset($_POST["uadd1"]) || $_POST["uadd1"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory.</p>'; }
	if(!isset($_POST["phone"]) || $_POST["phone"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 3.</p>'; }
    if(!isset($_POST["Address"]) || $_POST["Address"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 4.</p>'; }
   // if(!isset($_POST["pin"]) || $_POST["pin"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory.</p>'; }
	//if(!isset($_POST["state"]) || $_POST["state"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory.</p>'; }
    if(!isset($_POST["email"]) || $_POST["email"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 5.</p>'; }
    if(!isset($_POST["passwd"]) || $_POST["passwd"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 6.</p>'; }
	if(isset($_POST["usertype"]) && $_POST["usertype"] == 1) {
		if(!isset($_POST["aadhaar"]) || $_POST["aadhaar"] == "") { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory.</p>'; }
	}
	/*if(isset($_POST["usertype"]) && $_POST["usertype"] == 2) {
		if(!isset($_POST["orgname"]) || $_POST["orgname"] == "") {
			$errors = '<p><span class="mandatory">*</span> marked fields are mandatory 7.</p>';
		}*/
		//if(!isset($_POST["regno"]) || $_POST["regno"] == "") {
		//	$errors = '<p><span class="mandatory">*</span> marked fields are mandatory.</p>';
		//}
	//}

	if(isset($_POST["usertype"])) { if(intval($_POST["usertype"]) < 1 && intval($_POST["usertype"]) > 2) $errors .= '<p>Invalid user type number sent.</p>'; }
	if($_POST["phone"] != "" && !is_num($_POST["phone"])) { $errors .= '<p>Not a valid phone number.</p>'; }
	//if($_POST["pin"] != "" && !is_num($_POST["pin"])) { $errors .= '<p>Not a valid PIN code.</p>'; }
	if(isset($_POST["aadhaar"]) && $_POST["aadhaar"] != "" && !is_num($_POST["aadhaar"])) { $errors .= '<p>Not a valid Aadhaar number.</p>'; }

	if(empty($errors))
	{
		$conn = connect_db();
		if(!$conn) { die("Connection failed - " . mysqli_connect_error($conn)); }

		$Name		= validate_form_data($conn, $_POST["Name"]);
		//$lname		= validate_form_data($conn, $_POST["lname"]);
		$usertype	= validate_form_data($conn, $_POST["usertype"]);
		//$uadd1		= mysqli_real_escape_string($conn, $_POST["uadd1"]);
		$Address		= validate_form_data($conn, $_POST["Address"]);
		//$pin		= validate_form_data($conn, $_POST["pin"]);
		//$state		= validate_form_data($conn, $_POST["state"]);
		$phone		= validate_form_data($conn, $_POST["phone"]);
		$email		= validate_form_data($conn, $_POST["email"]);
		$passwd		= mysqli_real_escape_string($conn, $_POST["passwd"]);

		//if(isset($_POST["uadd2"]) && $_POST["uadd2"] != "") { $uadd2 = mysqli_real_escape_string($conn, $_POST["uadd2"]); } else { $uadd2 = ""; }

		if($usertype == 1)
		{
			$gender = mysqli_real_escape_string($conn, $_POST["gender"]);
			$aadhaar = mysqli_real_escape_string($conn, $_POST["aadhaar"]);
		}
		//if($usertype == 2)
		//{
			//$orphanage = validate_form_data($conn, $_POST["orphanage"]);
			//$orphanage = ucwords(strtolower($orphanage));
			//$regno = mysqli_real_escape_string($conn, $_POST["regno"]);
			//$orgname = validate_form_data($conn, $_POST["orgname"]);
			//$orgname = ucwords(strtolower($orgname));
			//$website = mysqli_real_escape_string($conn, $_POST["website"]);
		//}


		// Casing user details
		$Name = ucwords(strtolower($Name));
		//$lname = ucwords(strtolower($lname));
		$Address = ucwords(strtolower($Address));
		//$state = ucwords(strtolower($state));
		//$photo = "/assets/img/sites/avatar.jpg";
		$email = strtolower($email);
		//$hashpasswd = password_hash($passwd, PASSWORD_DEFAULT);

		///////////////////////////////////
		// Step 1: Inserting user
		//   registration info in table
		///////////////////////////////////
	    if($usertype == 1)
		{
			$sql = sprintf("INSERT INTO adopter(FName, LName, Gender, Address1, Address2, City, Pin, State, RegdOn, AadhaarNo, Email, Phone, Photo)
					VALUES('%s', '%s', %s, '%s', '%s', '%s', '%s', '%s', CURDATE(), '%s', '%s', '%s', '%s')",
					$fname, $lname, $gender, $uadd1, $uadd2, $city, $pin, $state, $aadhaar, $email, $phone, $photo);
		}
		else if($usertype == 2)
		{
			$sql = sprintf("INSERT INTO organisation(Name, Address, Reg_date, Email_id, Phone_number)
					VALUES('%s', '%s', CURDATE(), '%s', '%s')",
					$Name, $Address, $email, $phone);
		}

		$rs = mysqli_query($conn, $sql);
	    if(!$rs) { die("Query failed - " . mysqli_error($conn)); }

		///////////////////////////////////
		// Step 2: Inserting login
		//   credential into login table
		///////////////////////////////////
		$usertype = intval($usertype);
		$userid = mysqli_insert_id($conn);
		$_SESSION["userid"] = $userid;
		$_SESSION["usertype"] = $usertype;

		$sql = sprintf("INSERT INTO login(Username, Password, UserId, UserType)
				VALUES('%s', '%s', %s, %s)", $email, $passwd, $userid, $usertype);

		$rs = mysqli_query($conn, $sql);
		if(!$rs) { die("Query failed - " . mysqli_error($conn)); }
		else
		{
			$_SESSION["success"] = '<p>Registration successful!</p>';
			$_SESSION["success"] .= '<p>Your username for login is <strong>'. $email .'</strong>.</p>';
			header('Location: final.php?alert=success');
		}

		// Closing Connection
		mysqli_close($conn);
	}
}



?>

<?php
/*************************************
* Render header file
* @param array $data
**************************************/
render('header', array('title' => 'Register | Online Orphanage Home', 'levelup' => '2', 'curpage' => 'register'));
?>


<div class="main accent-secondary">
    <div class="container clearfix full-section" style="background-color: #fff; padding-top: 30px !important;">
		<h1 class="box-head txt-primary">Registration page for adopter or orphanage centre</h1>
		<hr style="border-top: 1px solid rgba(0, 0, 0, 0.05);" />
		<div class="col-w-8" style="float: none !important; margin: 0 auto;">
            <div class="box">
				<div class="step-bar tac">
					<span class="accent-secondary txt-light">1</span><i style="color: #a8a8a8;">Fill up your details</i><i class="rarrow"></i>
					<i style="color: #a8a8a8;">Upload your image</i><span class="accent-secondary txt-light">2</span>
				</div>
            <!-- Main Page Block -->
                <div class="box-body">
                    <div class="box-body-container">
                        <div class="row">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-controls">
                            <br>
                            <?php
                                if(!empty($errors))
                                    echo '<div class="actNotify-red">' . $errors . '</div>';

								if(isset($_GET["alert"]) && $_GET["alert"] == "success")
								{
									echo '<div class="actNotify-green">' . $_SESSION["success"] . '. <a href="http://'. htmlspecialchars($_SERVER["HTTP_HOST"]) .'/#login">Login</a> to your account.</div>';
								}
                            ?>
								<div class="row form-controls-row">
									<p style="font-family: 'Roboto light'; font-size: 12px; color: #dd0000;"><em>Note</em> : <span class="mandatory">*</span> marked fields are mandatory.</p>
								</div>
								<br />
								<div class="row form-controls-row">
									<label>I am an: <span class="mandatory">*</span></label>
									<select name="usertype" id="usertype">
										<option disabled="disabled" selected>Select user type</option>
										<option value="1">Adopter</option>
										<option value="2">Orphanage centre</option>
									</select>
								</div>

                                <div class="row form-controls-row" id="genderplaceholder">
                                    <?php

                                    ?>
                                </div>
								<div class="row form-controls-row">
                                    <label for="Name">Enter your Organization name: <span class="mandatory">*</span></label>
                                    <input type="text" id="Name" name="Name" placeholder="Your name" value="<?php if(isset($_POST["Name"])) echo $_POST["Name"]; ?>" style="width: 172px !important;">
                                    
                                </div>


								<div class="row form-controls-row">
									<label for="Addrerss">Your Address: <span class="mandatory">*</span></label>
									<input type="text" id="Address" name="Address" placeholder="Address" value="<?php if(isset($_POST["Address"])) echo $_POST["Address"]; ?>">
								</div>
                                <div class="row form-controls-row">
                                    <label for="phone">Enter your phone number: <span class="mandatory">*</span></label>
                                    <input type="text" id="phone" name="phone" placeholder="Your phone number" value="<?php if(isset($_POST["phone"])) echo $_POST["phone"]; ?>" maxlength="10">
                                </div>
								<br />
								<div class="row form-controls-row">
                                    <h4>Setup your login account</h4>
                                </div>
								<hr />
								<br />
                                <div class="row form-controls-row">
                                    <label for="email">Enter your email address: <span class="mandatory">*</span></label>
                                    <input type="text" id="email" name="email" placeholder="Email address (e.g. you@somesite.com)" value="<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>">
                                </div>
								<div class="row form-controls-row">
                                    <label for="passwd">Set password for login: <span class="mandatory">*</span></label>
                                    <input type="password" id="passwd" name="passwd" placeholder="Password" maxlength="32">
                                </div>
                                <br />

                                <div class="row form-controls-btnrow tac">
                                    <input type="submit" name="next" value="Next" class="btn txt-light accent-primary">
                                    <input type="reset" value="Cancel" class="btn txt-dark">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>

                <?php
                /////////////////////////////////////////////
                // JavaScript to add node for gender
                ////////////////////////////////////////////
                ?>
				<script type="text/JavaScript">
					var usertype = document.getElementById("usertype");
					var target = document.getElementById("genderplaceholder");
				    usertype.onchange = function()
				    {
				        var selectedString = usertype.options[usertype.selectedIndex].value;
				        //console.log(selectedString);
						if(selectedString == 1)
						{
							target.innerHTML = '<div class="row form-controls-row" id="genderplaceholder"><label for="gender">Gender: <span class="mandatory">*</span></label><input type="radio" id="male" name="gender" value="1"> <sapn class="txt-dark">Male </span><input type="radio" id="female" name="gender" value="2" checked="checked"> <sapn class="txt-dark">Female</span></div>';
							target.innerHTML += '<div class="row form-controls-row" id="genderplaceholder"><label for="aadhaar">Aadhaar number: <span class="mandatory">*</span></label> <input type="text" id="aadhaar" name="aadhaar" placeholder="Aadhaar number (0000 0000 0000)" value="<?php if(isset($_POST["aadhaar"])) echo htmlspecialchars($aadhaar); ?>" maxlength="12"></div>';
						}
						//else if (selectedString == 2)
						//{
							//target.innerHTML = '<div class="row form-controls-row" id="genderplaceholder"><label for="orgname">Your name: <span class="mandatory">*</span></label> <input type="text" id="orgname" name="orgname" value="<?php if(isset($_POST["orgname"])) echo $_POST["orgname"]; ?>" placeholder="Name"></div>';
							//target.innerHTML += '<div class="row form-controls-row" id="genderplaceholder"><label for="regno">Reg. no. of organisation: <span class="mandatory">*</span></label> <input type="text" id="regno" name="regno" value="<?php if(isset($_POST["regno"])) echo $_POST["regno"]; ?>" placeholder="Registration number"></div>';
							//target.innerHTML += '<div class="row form-controls-row" id="genderplaceholder"><label for="website">Webite of Orphanage: </label> <input type="text" id="website" name="website" value="<?php if(isset($_POST["website"])) echo $_POST["website"]; ?>" placeholder="Website (e.g. www.orphanage.org)"></div>';
						//}
				    }
				</script>

        </div>
    </div>
</div>





<?php
/*************************************
* Render footer file
* @param array $data
**************************************/
render('footer', array('levelup' => '2'));
?>
