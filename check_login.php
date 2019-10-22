<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
session_start();
if(empty($_SESSION["Activity_ID"]))
{
	header("location:index.php");
	exit();
}
?>