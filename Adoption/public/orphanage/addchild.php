<?php
session_start();
/*************************************
* Including helpers.php file
* It has render function
* to render the header and footer
* file.
**************************************/
//Error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../../includes/helpers.php');
require_once('../../includes/modules.php');

// Redirecting if user is not logged in
if (!isset($_SESSION["username"])) {
    header('Location: http://' . htmlspecialchars($_SERVER["HTTP_HOST"]));
    exit;
}

?>

<?php

$userid = $_SESSION["userid"];
//echo $userid;

if(isset($_POST["addchild"]) && $_POST["addchild"] == "+ Add Child")
{
	///////////////////////////////////
	// STEP 1: Validating form data
	///////////////////////////////////

	$errors = "";
    if(!isset($_POST["Name"]) || empty($_POST["Name"])) { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 1.</p>'; }
    if(!isset($_POST["bgrp"]) || empty($_POST["bgrp"])) { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 2.</p>'; }
    if(!isset($_POST["dob"]) || empty($_POST["dob"])) { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 3.</p>'; }
	//if(!isset($_POST["age"]) || empty($_POST["age"])) { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 4.</p>'; }
	if(!isset($_FILES["photo"]) || empty($_FILES["photo"]["name"])) { $errors = '<p><span class="mandatory">*</span> marked fields are mandatory 5.</p>'; }

	// Validating photo field
	if(isset($_FILES["photo"]) && !empty($_FILES["photo"]["name"]))
	{
		if($_FILES["photo"]["type"] != "image/jpeg")
			if($_FILES["photo"]["type"] != "image/png")
				$errors = '<p>Please upload a jpeg or png file.</p>';

		if(intval($_FILES["photo"]["size"]) > 51200)
			$errors .= '<p>Image size is large, please upload an image below 50kb.</p>';
	}


	if(empty($errors))
	{
		$conn = connect_db();

		$Name		= validate_form_data($conn, $_POST["Name"]);
		$bgrp		= validate_form_data($conn, $_POST["bgrp"]);
		$dob		= validate_form_data($conn, $_POST["dob"]);
		$age		= date_diff_year(date('Ymd'), $dob);
		$gender		= validate_form_data($conn, $_POST["gender"]);

		// not mandatory field
		if(isset($_POST["weight"]) && $_POST["weight"] != "") { $Weight = validate_form_data($conn, $_POST["weight"]); } else { $Weight = ""; }
		if(isset($_POST["height"]) && $_POST["height"] != "") { $Height = validate_form_data($conn, $_POST["height"]); } else { $Height = ""; }

		// Casing user details
		$Name = ucwords(strtolower($Name));
		//$lname = ucwords(strtolower($lname));

		///////////////////////////////////
		// Step 1: Uploading image
		///////////////////////////////////
		$fName = "photo";	// file input element name sent from browser
		$upfName = date("Ymdhis") . '_' . time();
		$fPath = "../assets/img/godschild/";
		if($_FILES["photo"]["type"] == "image/jpeg")
			$ext = "jpg";
		if($_FILES["photo"]["type"] == "image/png")
			$ext = "png";

		$photo = "/assets/img/godschild/" . $upfName . "." . $ext;	// name of the uploaded file
		$isUploaded = upload_file($fName, $upfName, $fPath, $ext);

		///////////////////////////////////
		// Step 2: Inserting user
		//   child info in table
		///////////////////////////////////
		if($isUploaded)
		{
			$sql = sprintf("INSERT INTO child(Name, Dob, Gender, Age, Weight, Height, Blood_group, Photo, Reg_id)
					VALUES('%s', '%s', %s, %s, %s, %s,'%s','%s', %s)",
					$Name,$dob, $gender, $age, $Weight, $Height, $bgrp, $photo, $userid);

			$rs = mysqli_query($conn, $sql);
			/*
			$sql1 = sprintf("SELECT Child_id FROM child WHERE Name = '%s'",$NAME);
			$rs1 = mysqli_query($conn, $sql1);
			$row = mysqli_fetch_array($rs1);
			echo($row);
			$sql2 = sprintf("INSERT INTO displays(Reg_id,Child_id)
					VALUES(%s,%s)",
					$userid,$row);
			$rs2 = mysqli_query($conn,$sql2);*/
	    	if(!$rs) { die("Query failed - " . mysqli_error($conn)); }
			else
			{
				header('Location: addchild.php?alert=success');

			}
		}
		else
		{
			$errors = '<p>Sorry! Image upload failed. Please try again.</p>';
		}

		// Closing Connection
		mysqli_close($conn);
	}
}


?>


<?php
/*************************************
* Render Dashboard header
* @param array $data
**************************************/
render('dashheader', array('title' => 'org', 'levelup' => '2'));

?>

<div class="row dashboard clearfix">

<?php
/*************************************
* Render Dashboard Sidebar
* @param array $data
**************************************/
render('dashsidebar', array('levelup' => '2', 'fullname' => $_SESSION["fullname"], 'photo' => $_SESSION["photo"], 'curpage' => 'godschild'));
?>


<div class="col-w-10 dash-main">
	<div class="dash-header clearfix">
		<div class="col-w-11 dash-container"><h3 style="line-height: 60px;margin-left: 50px; color: #333;">Dashboard</h3></div>
		<div class="col-w-1"><a href="./logout.php" class="btn btn-logout" style="margin-top: 15px;">Logout</a></div>
	</div>

	<div class="dash-body">
		<div class="row">
			<div class="col-w-8" style="float: none !important; margin: 0 auto;">
				<h1 style="font-family: 'Roboto regular'; font-size: 1.5em;">Add Child</h1>
				<div class="row">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-controls" enctype="multipart/form-data">
					<br>
					<?php
						if(!empty($errors))
							echo '<div class="actNotify-red">' . $errors . '</div>';

						if(isset($_GET["alert"]) && $_GET["alert"] == "success")
						{
							echo '<div class="actNotify-green"><p>Child added successfull!</p></div>';
						}
					?>
						<div class="row form-controls-row">
							<p style="font-family: 'Roboto light'; font-size: 12px; color: #dd0000;"><em>Note</em> : <span class="mandatory">*</span> marked fields are mandatory.</p>
						</div>
						<br />

						<div class="row form-controls-row">
							<label for="Name">Enter name and Blood group: <span class="mandatory">*</span></label>
							<input type="text" id="Name" name="Name" placeholder="Name" value="<?php if(isset($_POST["Name"])) echo $_POST["Name"]; ?>" style="width: 172px !important;">
							<input type="text" id="bgrp" name="bgrp" placeholder="Blood Group" value="<?php if(isset($_POST["bgrp"])) echo $_POST["bgrp"]; ?>" style="width: 172px !important;">
						</div>

						<div class="row form-controls-row">
							<label for="dob">Date of birth: <span class="mandatory">*</span></label>
							<input type="text" id="dob" name="dob" placeholder="Date of birth (e.g. yyyy-mm-dd)" value="<?php if(isset($_POST["dob"])) echo $_POST["dob"]; ?>">
						</div>
						<!--
						<div class="row form-controls-row">
							<label for="age">Enter Age: <span class="mandatory">*</span></label>
							<input type="text" id="age" name="age" placeholder="Age" value="<?php if(isset($_POST["age"])) echo $_POST["age"]; ?>">
						</div>
						-->
						<div class="row form-controls-row">
							<label for="gender">Gender: <span class="mandatory">*</span></label>
							<input type="radio" id="male" name="gender" value="1"> <sapn class="txt-dark">Male </span>
							<input type="radio" id="female" name="gender" value="2" checked="checked"> <sapn class="txt-dark">Female</span>
						</div>
						<div class="row form-controls-row">
							<label for="weight">Enter Weight:</label>
							<input type="text" id="weight" name="weight" placeholder="Weight of child(in Kgs)" value="<?php if(isset($_POST["weight"])) echo $_POST["weight"]; ?>">
						</div>
						<div class="row form-controls-row">
							<label for="height">Enter Height:</label>
							<input type="text" id="height" name="height" placeholder="Height of child(in Cms)" value="<?php if(isset($_POST["height"])) echo $_POST["height"]; ?>">
						</div>

						<br />
						<div class="row form-controls-row">
							<label>Select image of child: <span class="mandatory">*</span></label>
							<input type="file" id="photo" name="photo" style="border: 1px solid #ddd; border-radius: 4px; padding: 7px 2px;" value="">
						</div>

						<br />
						<div class="row form-controls-btnrow tac">
							<input type="submit" name="addchild" value="+ Add Child" class="btn txt-light btn-success">
							<a href="godschild.php"><input type="button" value="Cancel" class="btn txt-dark"></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>




</div>
<?php
/*************************************
* Render footer file
* @param array $data
**************************************/
render('footer', array('levelup' => '2'))
?>
