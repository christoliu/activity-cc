<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>活動管理權限</h1>
<?
if($_POST["submit"] == "修改")
{
	$Activity_Edit = "";
	$Activity_Signup = "";
	$Activity_Attend_rw = "";
	$Activity_Attend_r = "";
	
  $result = mysql_query("select OID from activity");
  while($row = mysql_fetch_object($result))
  {
		if($_POST["Edit"] == 1 && $_POST["Edit_$row->OID"])
			$Activity_Edit = $Activity_Edit.",".$row->OID;
		if($_POST["Signup"] == 1 && $_POST["Signup_$row->OID"])
			$Activity_Signup = $Activity_Signup.",".$row->OID;
		if($_POST["Attend_rw"] == 1 && $_POST["Attend_rw_$row->OID"])
			$Activity_Attend_rw = $Activity_Attend_rw.",".$row->OID;
		if($_POST["Attend_r"] == 1 && $_POST["Attend_r_$row->OID"])
			$Activity_Attend_r = $Activity_Attend_r.",".$row->OID;
  }
	$Activity_Edit = $_POST["Edit"] != 1 ? $_POST["Edit"] : substr($Activity_Edit, 1);
	$Activity_Signup = $_POST["Signup"] != 1 ? $_POST["Signup"] : substr($Activity_Signup, 1);
	$Activity_Attend_rw = $_POST["Attend_rw"] != 1 ? $_POST["Attend_rw"] : substr($Activity_Attend_rw, 1);
	$Activity_Attend_r = $_POST["Attend_r"] != 1 ? $_POST["Attend_r"] : substr($Activity_Attend_r, 1);
	sqlquery("update administrator set Activity_Edit='$Activity_Edit', Activity_Signup='$Activity_Signup', Activity_Attend_rw='$Activity_Attend_rw', Activity_Attend_r='$Activity_Attend_r' where OID='".$_POST["Admin_OID"]."'", "修改活動管理權限完成。<br />");
}
?>
<? require("template_bottom.php"); ?>