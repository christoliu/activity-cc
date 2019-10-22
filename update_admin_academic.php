<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>院別管理</h1>
<?
if($_POST["submit"] == "新增")
{
  $result = mysql_query("select OID from ncu_academic.setup_academic where Title='".$_POST["new_title"]."'");
  $row = mysql_fetch_object($result);
  if($row->OID == "")
  {
    $title = $_POST["new_title"];
    sqlquery("insert into ncu_academic.setup_academic (Title) values('$title')", "新增完成。<br />");
  }
  else
    echo "此院別已存在。";
}
else if($_POST["submit"] == "修改")
{
  $result = mysql_query("select * from ncu_academic.setup_academic");
  while($row = mysql_fetch_object($result))
  {
    if($_POST["del_$row->OID"])
    {
      sqlquery("delete from ncu_academic.setup_academic where OID='$row->OID'", "刪除 $row->Title 完成。<br />");
    }
    else
    {
      $title = $_POST["title_$row->OID"];
      sqlquery("update ncu_academic.setup_academic set Title='$title' where OID='$row->OID'", "");
    }
  }
  echo "修改完成。";
  mysql_query("optimize table ncu_academic.setup_academic");
}
?>
<? require("template_bottom.php"); ?>