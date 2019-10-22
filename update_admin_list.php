<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>活動刪除</h1>
<?
if($_POST["submit"] == "刪除勾選項目")
{
  $result = mysql_query("select * from activity");
  while($row = mysql_fetch_object($result))
  {
    if($_POST["del_$row->OID"])
      sqlquery("delete from activity where OID=$row->OID", "活動 [$row->Title] 刪除完成。<br />");
  }
}
mysql_query("optimize table activity");
?>
<? require("template_bottom.php"); ?>