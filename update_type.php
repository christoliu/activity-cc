<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>類別管理</h1>
<?
if($_POST["submit"] == "新增")
{
  $result = mysql_query("select OID from setup_type where Title='".$_POST["new_title"]."'");
  $row = mysql_fetch_object($result);
  if($row->OID == "")
  {
    $title = $_POST["new_title"];
    sqlquery("insert into setup_type (Title) values('$title')", "新增完成。<br />");
  }
  else
    echo "此類別已存在。";
}
else if($_POST["submit"] == "修改")
{
  $result = mysql_query("select OID from setup_type");
  while($row = mysql_fetch_object($result))
  {
    if($_POST["del_$row->OID"])
    {
      sqlquery("delete from setup_type where OID=$row->OID", "類別 [$row->Title] 刪除。<br />");
    }
    else
    {
      $Title = $_POST["title_$row->OID"];
      sqlquery("update setup_type set Title='$Title' where OID='$row->OID'", "修改完成。<br />");
    }
  }
	mysql_query("optimize table setup_type");
}
?>
<? require("template_bottom.php"); ?>