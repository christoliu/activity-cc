<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>地點管理</h1>
<?
if($_POST["submit"] == "新增")
{
  $result = mysql_query("select OID from setup_location where Title='".$_POST["new_title"]."'");
  $row = mysql_fetch_object($result);
  if($row->OID == "")
  {
    $Title = $_POST["new_title"];
    $Size = $_POST["new_size"] == "" ? 0 : $_POST["new_size"];
    $Address = $_POST["new_address"];
    $Contact = $_POST["new_contact"];
    $Telephone = $_POST["new_tel"];
    $Remark = $_POST["new_remark"];
    sqlquery("insert into setup_location (Title, Size, Address, Contact, Telephone, Remark) values('$Title', '$Size', '$Address', '$Contact', '$Telephone', '$Remark')", "新增完成。<br />");
  }
  else
    echo "此地點已存在。";
}
else if($_POST["submit"] == "修改")
{
  $result = mysql_query("select * from setup_location");
  while($row = mysql_fetch_object($result))
  {
    if($_POST["del_$row->OID"])
    {
      sqlquery("delete from setup_location where OID=$row->OID", "地點 [$row->Title] 刪除完成。<br />");
      mysql_query("optimize table setup_location");
    }
    else
    {
      $Title = $_POST["title_$row->OID"];
      $Size = $_POST["size_$row->OID"];
      $Address = $_POST["address_$row->OID"];
      $Contact = $_POST["contact_$row->OID"];
      $Telephone = $_POST["tel_$row->OID"];
      $Remark = $_POST["remark_$row->OID"];
      sqlquery("update setup_location set Title='$Title', Size=$Size, Address='$Address', Contact='$Contact', Telephone='$Telephone', Remark='$Remark' where OID='$row->OID'", "修改完成。<br />");
    }
  }
}
?>
<? require("template_bottom.php"); ?>