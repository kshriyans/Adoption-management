<?php
session_start();
require_once('../../includes/helpers.php');

if(!is_ajax_request()) { exit; }

//echo $_POST["oid"];
/*
if(isset($_POST["aid"]) && isset($_POST["chid"]))
{
	$conn = connect_db();
	$oid = $_SESSION["userid"];
	$aid = validate_form_data($conn, $_POST["aid"]);
	$chid = validate_form_data($conn, $_POST["chid"]);

	$sql = sprintf("INSERT INTO adopt(AdopId, OId, ChId) VALUES(%s, %s, %s)", $aid, $oid, $chid);
	$rs = mysqli_query($conn, $sql);
	if(!$rs)
		{ die('Query failed - ' . mysqli_error($conn)); }
	else
	{
		$responsehead = '<h3 class="panel-title" style="color: #0A0;">Congrats!</h3>';
		$responsetxt = 'Congrats! We have marked this child as adopted.';
	}

}*/


if(isset($_POST["action"]) && $_POST["action"] == "donation_rcvd")
{
	if(isset($_POST["did"]) && !empty($_POST["did"]))
	{
		$conn = connect_db();
		$did = validate_form_data($conn, $_POST["did"]);
		$subject = 'Adoption Status';
		$message = 'This is to certify that Your profile has been Accepted! Send your Documents at Orphanage@gmail.com';
		//$headers = 'From: rvcebangalore12@gmail.com';

		$sql = sprintf("UPDATE shortlisted set Status=2 WHERE ID=%s", $did);
		$sql1 = sprintf("SELECT * FROM shortlisted WHERE ID=%s", $did);
		$rs = mysqli_query($conn, $sql);
		$rs1 = mysqli_query($conn, $sql1);
		if(!$rs)
			{ die('Query failed - ' . mysqli_error($conn)); }
		else
		{
			$responsehead = '<p> Alert.</p>';
			$responsetxt = 'Request Accepted.';
		}
		if(!$rs1)
			{ die('Query failed - ' . mysqli_error($conn)); }
		$row1 = mysqli_fetch_array($rs1, MYSQLI_ASSOC);
		mail($row1["Address"],$subject,$message);

	}
}

?>
<div class="overlay clearfix" id="overlay-popup">
	<div class="panel panel-default" style="display: block; width: 450px; margin: 10% auto 0 auto;">
		<div class="panel-head">
			<?php
				if(isset($responsehead))
					echo $responsehead;

			?>
		</div>
		<div class="panel-body">
			<?php if(isset($responsetxt)): ?>
				<p><?php echo $responsetxt; ?></p>
			<?php endif ?>
			<br/>
			<p class="tac"><a class="btn btn-sm accent-primary" id="close-ok">Ok</a></p>
		</div>
	</div>
</div>
