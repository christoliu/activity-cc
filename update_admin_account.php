<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>帳號管理</h1>
<?
if($_POST["submit"] == "新增")
{
  $result = mysql_query("select OID from administrator where Account='".$_POST["Account_new"]."'");
  $row = mysql_fetch_object($result);
  if($row->OID == "")
  {
    $Account = $_POST["Account_new"];
    $Remark = $_POST["Remark_new"];
    $Admin = $_POST["Admin_new"] ? 1 : 0;
    $Post = $_POST["Post_new"] ? 1 : 0;
    sqlquery("insert into administrator (Account, Admin, Post, Activity_Edit, Activity_Signup, Activity_Attend_rw, Activity_Attend_r, Remark) values('$Account', '$Admin', '$Post', '0', '0', '0', '0', '$Remark')", "新增帳號完成。<br />");
		
		$result = mysql_query("select OID from administrator where Account='".$_POST["Account_new"]."'");
		$row = mysql_fetch_object($result);
		echo '<a href="admin_account_activity.php?OID='.$row->OID.'" target="_blank">前往編輯權限</a>';
  }
  else
    echo "此帳號已存在。";
}
else if($_POST["submit"] == "修改")
{
  $result = mysql_query("select * from administrator");
  while($row = mysql_fetch_object($result))
  {
    if($_POST["OID_$row->OID"] != "")
    {
      //刪除
      if($_POST["del_$row->OID"])
      {
        sqlquery("delete from administrator where OID=$row->OID", "刪除帳號 $row->Account 完成。<br />");
      }
      else
      {
        $Admin = $_POST["Admin_$row->OID"] ? 1 : 0;
        $Post = $_POST["Post_$row->OID"] ? 1 : 0;
        $Remark = $_POST["Remark_$row->OID"];
        sqlquery("update administrator set Admin='$Admin', Post='$Post', Remark='$Remark' where OID='$row->OID'", "修改帳號 $row->Account 完成。<br />");
      }
    }
  }
  mysql_query("optimize table administrator");
}
?>
<? require("template_bottom.php"); ?>