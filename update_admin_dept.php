<?
//Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved.
require("check_admin.php");
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>系所管理</h1>
<?
if($_POST["submit"] == "新增")
{
  $result = mysql_query("select OID from ncu_academic.setup_dept where Title='".$_POST["new_title"]."'");
  $row = mysql_fetch_object($result);
  if($row->OID == "")
  {
    $Title = $_POST["Title_new"];
    $AcademicOID = $_POST["AcademicOID_new"];
    $Abbreviation = $_POST["Abbreviation_new"];
    
    sqlquery("insert into ncu_academic.setup_dept (Title, AcademicOID, Abbreviation) values('$Title', '$AcademicOID', '$Abbreviation')", "新增完成。");
  }
  else
    echo "此系所已存在。";
}
else if($_POST["submit"] == "修改")
{
  $result = mysql_query("select OID from ncu_academic.setup_dept");
  while($row = mysql_fetch_object($result))
  {
    if($_POST["del_$row->OID"])
    {
      sqlquery("delete from ncu_academic.setup_dept where OID='$row->OID'", "");
    }
    else
    {
      $Title = $_POST["Title_$row->OID"];
	    $AcademicOID = $_POST["AcademicOID_$row->OID"];
      $Abbreviation = $_POST["Abbreviation_$row->OID"];
      sqlquery("update ncu_academic.setup_dept set Title='$Title', AcademicOID='$AcademicOID', Abbreviation='$Abbreviation' where OID='$row->OID'", "");
    }
  }
  echo "修改完成。";
  mysql_query("optimize table ncu_academic.setup_dept");
}
?>
<? require("template_bottom.php"); ?>