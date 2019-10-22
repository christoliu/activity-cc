<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require('sql_link.php');
?>

<? require("template_head.php"); ?>
<h1>帳號管理</h1>
<?
if($_POST['submit'] == "切換")
{
	$result = mysql_query("select * from administrator where Account='".$_POST["StudentID"]."'");
	$row = mysql_fetch_object($result);
	if($row->OID != "")
	{
		$_SESSION["Activity_ID"] = $_POST["StudentID"];
		$_SESSION["Activity_admin"] = $row->Admin == 1 ? 1 : NULL;
		$_SESSION["Activity_post"] = $row->Post == 1 ? 1 : NULL;
		$_SESSION["Activity_Edit"] = $row->Activity_Edit;
		$_SESSION["Activity_Signup"] = $row->Activity_Signup;
		$_SESSION["Activity_Attend_rw"] = $row->Activity_Attend_rw;
		$_SESSION["Activity_Attend_r"] = $row->Activity_Attend_r;
  
    echo "切換為 ".$_SESSION['Activity_ID']." 身分。";
	}
	else
		echo "<p align='center'>此帳號無管理者權限<br />";
}
?>
<? require("template_bottom.php"); ?>