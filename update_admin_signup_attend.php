<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
require("template_query.php");
$result = mysql_query("select * from activity where OID='".$_POST["ActivityOID"]."'");
$row = mysql_fetch_object($result);
require("check_attend_list.php");
?>

<? require("template_head.php"); ?>
<h1>參加清單管理</h1>
<?
if($_POST["submit"] == "修改")
{
	//新增報名者
	if($_POST["Name_new"] != "")
	{
    //個資增修
		$StuID = $_POST["StuID_new"];
    $result = mysql_query("select * from attendant where StuID='$StuID'");
		$row = mysql_fetch_object($result);
    if($row->OID != "")
    {
			$Name = $_POST["Name_new"] == "" ? $row->Name : $_POST["Name_new"];
			$Title2 = $_POST["Title2_new"] == "" ? $row->Title2 : $_POST["Title2_new"];
			$Title3 = $_POST["Title3_new"] == "" ? $row->Title3 : $_POST["Title3_new"];
			sqlquery("update attendant set Name='$Name', Title2='$Title2', Title3='$Title3' where OID='$row->OID'", "新增報名者: 個人資料已存在，更新完成。<br />");
		}
		else
		{
			$Name = $_POST["Name_new"];
			$Title2 = $_POST["Title2_new"];
			$Title3 = $_POST["Title3_new"];
			sqlquery("insert into attendant (StuID, Name, Title2, Title3, Public_Profiles) values('$StuID', '$Name', '$Title2', '$Title3', 0)", "新增報名者: 新個人資料登記完成。<br />");
		}
		
		//報名紀錄表增修		
		//再獲得一次OID
    $result = mysql_query("select OID from attendant where StuID='$StuID'");
    $row = mysql_fetch_object($result);
		sqlquery("insert into activity_signup (Activity_OID, Attendant_OID, Onsite) values('".$_POST["ActivityOID"]."', '$row->OID', '1')", "新增報名完成。<br />");
	}
	
	//修改報名者
	//針對報名紀錄表
  $result = mysql_query("select OID from activity_signup where Activity_OID='".$_POST["ActivityOID"]."'");
  while($row = mysql_fetch_object($result))
  {
    if($_POST["AOID_$row->OID"] != "")
    {
			$Absent = $_POST["Absent_$row->OID"] ? "NULL" : "1";
			sqlquery("update activity_signup set Absent=$Absent where OID='$row->OID'", "");
		}
  }
	
  echo "修改完成。";
}
?>
<p align="center"><a href="admin_signup_attend.php?OID=<?= $_POST["ActivityOID"] ?>">返回上一頁</a></p>
<? require("template_bottom.php"); ?>