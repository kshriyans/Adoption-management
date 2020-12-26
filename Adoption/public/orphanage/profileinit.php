<?php
session_start();

require_once('../../includes/helpers.php');

$username = $_SESSION["username"];
$userid = $_SESSION["userid"];
$usertype = $_SESSION["usertype"];


$sql = sprintf("SELECT Name FROM organisation WHERE Regid=%s", $userid);

$conn = connect_db();
if(!$conn) { die("Connetion failed - " . mysqli_connect_error($conn)); }

$rs = mysqli_query($conn, $sql);
if(!$rs) { die("Query failed - " . mysqli_error($conn)); }

if(mysqli_num_rows($rs) > 0)
{
	if($row = mysqli_fetch_array($rs, MYSQLI_ASSOC))
	{
		$Name = $row["Name"];
		//$lname = $row["LName"];
		//$_SESSION["photo"] = $row["Photo"];
		//$_SESSION["orgname"] = $row["OrgName"];
	}
}

$_SESSION["fullname"] = $Name;

header('Location: ./');

?>
