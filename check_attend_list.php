<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
session_start();

$Edit = explode(",", $_SESSION["Activity_Edit"]);
$Signup = explode(",", $_SESSION["Activity_Signup"]);
$Attend_rw = explode(",", $_SESSION["Activity_Attend_rw"]);
$Attend_r = explode(",", $_SESSION["Activity_Attend_r"]);

$array = explode(",", $_SESSION["Activity_Attend_rw"]);
if(empty($_SESSION["Activity_ID"]) || !(in_array("0", $array) || in_array($_GET["OID"], $array) || in_array($_POST["ActivityOID"], $array) || (in_array("-2", $array) && $row->PostBy == $_SESSION["Activity_ID"])))
{
	header("location:index.php");
	exit();
}
?>