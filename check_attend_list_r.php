<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
session_start();

$array = explode(",", $_SESSION["Activity_Attend_r"]);
if(empty($_SESSION["Activity_ID"]) || !(in_array("0", $array) || in_array($_GET["OID"], $array) || in_array($_POST["ActivityOID"], $array) || (in_array("-2", $array) && $row->PostBy == $_SESSION["Activity_ID"])))
{
	header("location:index.php");
	exit();
}
?>