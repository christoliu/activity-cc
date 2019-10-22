<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("db.php");
require("check_admin.php");
$result = mysqli_query($conn,"SELECT * FROM activity WHERE OID='".$_POST["OID"]."'");
$row = mysqli_fetch_object($result);
require($_POST["OID"] == "" ? "check_post.php" : "check_edit.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>審核管理</h1>
<?
//$result2 = mysqli_query($conn,"SELECT COUNT(*) FROM activity_apply.OID");
//$row2 = mysqli_fetch_object($result2);

if($_POST["submit"] == "送出")
{
	//$result = sql_entities_string($conn,$_POST["result"]);echo "hihihihihihihihi";
	//for ($i=0;$i<$row2;$i++) {
		$result = $_POST['result'];
		$sql = "UPDATE `activity_apply` SET `Title`='$activity_name', `Location`='$location', `Restrict_Academic`='$academic', `connect`='$connect'";
		sqlquery("UPDATE 'activity_apply' SET 'result'='$result'", "完成。");
	//}
}
?>
<? require("template_bottom.php"); ?>