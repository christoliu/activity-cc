<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>細目別管理</h1>
<?
if($_POST["submit"] == "新增")
{
  $result = mysql_query("select OID from setup_type2 where Title='".$_POST["new_title"]."'");
  $row = mysql_fetch_object($result);
  if($row->OID == "")
  {
    $title = $_POST["new_title"];
    sqlquery("insert into setup_type2 (Title) values('$title')", "新增完成。<br />");
  }
  else
    echo "此細目別已存在。";
}
else if($_POST["submit"] == "修改")
{
  $result = mysql_query("select * from setup_type2");
  while($row = mysql_fetch_object($result))
  {
    if($_POST["del_$row->OID"])
    {
      sqlquery("delete from setup_type2 where OID=$row->OID", "細目別 [$row->Title] 刪除。<br />");
    }
    else
    {
      $Title = $_POST["title_$row->OID"];
      sqlquery("update setup_type2 set Title='$Title' where OID='$row->OID'", "修改完成。<br />");
    }
  }
  mysql_query("optimize table setup_type2");
}
?>
<? require("template_bottom.php"); ?>