<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
require("template_query.php");
$result = mysql_query("select * from activity where OID='".$_POST["ActivityOID"]."'");
$row = mysql_fetch_object($result);
require("check_signup_list.php");
?>

<? require("template_head.php"); ?>
<h1>報名清單管理</h1>
<?
if($_POST["submit"] == "修改")
{
	//新增報名者
	if($_POST["Name_new"] != "")
	{
    //個資增修
		$StuID = $_POST["StuID_new"];
		$ID = $_POST["ID_new"];
		$result = $_POST["Title1_new"] == "學生" ? mysql_query("select * from attendant where StuID='$StuID'") : mysql_query("select * from attendant where ID='$ID'");
		$row = mysql_fetch_object($result);
		if($row->OID != "")
		{
			$Name = $_POST["Name_new"] == "" ? $row->Name : $_POST["Name_new"];
			$Gender = $_POST["Gender_new"] == "" ? $row->Gender : $_POST["Gender_new"];
			$Title1 = $_POST["Title1_new"] == "" ? $row->Title1 : $_POST["Title1_new"];
			$Title2 = $_POST["Title2_new"] == "" ? $row->Title2 : $_POST["Title2_new"];
			$Title3 = $_POST["Title3_new"] == "" ? $row->Title3 : $_POST["Title3_new"];
			$Birth = $_POST["Birth_new"] == "" ? $row->Birth : $_POST["Birth_new"];
			$Phone = $_POST["Phone_new"] == "" ? $row->Phone : $_POST["Phone_new"];
			$Mail = $_POST["Mail_new"] == "" ? $row->Mail : $_POST["Mail_new"];
			$Diet = $_POST["Diet_new"] == "" ? $row->Diet : $_POST["Diet_new"];
			$Contact = $_POST["Contact_new"] == "" ? $row->Contact : $_POST["Contact_new"];
			$ContactRelation = $_POST["ContactRelation_new"] == "" ? $row->ContactRelation : $_POST["ContactRelation_new"];
			$ContactPhone = $_POST["ContactPhone_new"] == "" ? $row->ContactPhone : $_POST["ContactPhone_new"];
			sqlquery("update attendant set Name='$Name', Gender='$Gender', Title1='$Title1', Title2='$Title2', Title3='$Title3', ID='$ID', Birth='$Birth', Phone='$Phone', Mail='$Mail', Diet='$Diet', Contact='$Contact', ContactRelation='$ContactRelation', ContactPhone='$ContactPhone' where OID='$row->OID'", "新增報名者: 個人資料已存在，更新完成。");
		}
		else
		{
			$Name = $_POST["Name_new"];
			$Gender = $_POST["Gender_new"];
			$Title1 = $_POST["Title1_new"];
			$Title2 = $_POST["Title2_new"];
			$Title3 = $_POST["Title3_new"];
			$Birth = $_POST["Birth_new"] == "" ? "0000-00-00" : $_POST["Birth_new"];
			$Phone = $_POST["Phone_new"];
			$Mail = $_POST["Mail_new"];
			$Diet = $_POST["Diet_new"];
			$Contact = $_POST["Contact_new"];
			$ContactRelation = $_POST["ContactRelation_new"];
			$ContactPhone = $_POST["ContactPhone_new"];
			sqlquery("insert into attendant (StuID, Name, Gender, Title1, Title2, Title3, ID, Birth, Phone, Mail, Diet, Contact, ContactRelation, ContactPhone, Public_Profiles) values('$StuID', '$Name', '$Gender', '$Title1', '$Title2', '$Title3', '$ID', '$Birth', '$Phone', '$Mail', '$Diet', '$Contact', '$ContactRelation', '$ContactPhone', 0)", "新增報名者: 新個人資料登記完成。<br />");
		}
		//報名紀錄表增修
		$Deposit = $_POST["Deposit_new"] ? 1 : 0;
		$DepositTime = $_POST["DepositTime_new"];
		$Remark = $_POST["Remark_new"];
		
		// 檔案上傳
		if($_FILES["Upload_new"]["tmp_name"] != "")
		{
			$Upload = $_POST["ActivityOID"]."_$Name"."_".$_FILES["Upload_new"]["name"];
			if(!move_uploaded_file($_FILES["Upload_new"]["tmp_name"], "uploads/attendants/".mb_convert_encoding($Upload, "UTF-8", "auto")))
				echo "檔案上傳失敗: $Upload <br>";
		}
		
		//再獲得一次OID
    $result = $_POST["Title1_new"] == "學生" ? mysql_query("select OID from attendant where StuID='$StuID'") : mysql_query("select OID from attendant where ID='$ID'");
    $row = mysql_fetch_object($result);
		sqlquery("insert into activity_signup (Activity_OID, Attendant_OID, Deposit, DepositTime, Upload, Remark) values('".$_POST["ActivityOID"]."', '$row->OID', '$Deposit', '$DepositTime', '$Upload', '$Remark')", "新增報名完成。<br />");
	}
	
	//修改報名者
	//針對報名紀錄表
  $result = mysql_query("select OID from activity_signup where Activity_OID='".$_POST["ActivityOID"]."'");
  while($row = mysql_fetch_object($result))
  {
		//刪除
		if($_POST["del_$row->OID"])
		{
			$sql = "delete from activity_signup where OID='$row->OID'";
			sqlquery($sql, "");
			sqlquery("insert into edit_log (`Account`, `SQL`) values('".$_SESSION["Activity_ID"]."', '".str_replace("'", "''", $sql)."')", "");
		}
		else if($_POST["SignupOID_$row->OID"] != "") //該人活動報名的備註修改
		{
  		$Deposit = $_POST["Deposit_$row->OID"] ? 1 : 0;
  		$DepositTime = $_POST["DepositTime_$row->OID"];
			$Remark = $_POST["Remark_$row->OID"];
			sqlquery("update activity_signup set Deposit='$Deposit', DepositTime='$DepositTime', Remark='$Remark' where OID='$row->OID'", "");
		}
  }
  mysql_query("optimize table activity_signup");
  
	//針對參加人資料表
  $result = mysql_query("select * from attendant");
  while($row = mysql_fetch_object($result))
  {
    if($_POST["AttendantOID_$row->OID"] != "")
    {
      $Name = $_POST["Name_$row->OID"] == "" ? $row->Name : $_POST["Name_$row->OID"];
      $Gender = $_POST["Gender_$row->OID"] == "" ? $row->Gender : $_POST["Gender_$row->OID"];
      $Title1 = $_POST["Title1_$row->OID"] == "" ? $row->Title1 : $_POST["Title1_$row->OID"];
      $Title2 = $_POST["Title2_$row->OID"] == "" ? $row->Title2 : $_POST["Title2_$row->OID"];
      $Title3 = $_POST["Title3_$row->OID"] == "" ? $row->Title3 : $_POST["Title3_$row->OID"];
      $ID = $_POST["ID_$row->OID"] == "" ? $row->ID : $_POST["ID_$row->OID"];
      $Birth = $_POST["Birth_$row->OID"] == "" ? $row->Birth : $_POST["Birth_$row->OID"];
      $Phone = $_POST["Phone_$row->OID"] == "" ? $row->Phone : $_POST["Phone_$row->OID"];
      $Mail = $_POST["Mail_$row->OID"] == "" ? $row->Mail : $_POST["Mail_$row->OID"];
      $Diet = $_POST["Diet_$row->OID"] == "" ? $row->Diet : $_POST["Diet_$row->OID"];
      $Contact = $_POST["Contact_$row->OID"] == "" ? $row->Contact : $_POST["Contact_$row->OID"];
      $ContactRelation = $_POST["ContactRelation_$row->OID"] == "" ? $row->ContactRelation : $_POST["ContactRelation_$row->OID"];
      $ContactPhone = $_POST["ContactPhone_$row->OID"] == "" ? $row->ContactPhone : $_POST["ContactPhone_$row->OID"];
      sqlquery("update attendant set Name='$Name', Title1='$Title1', Title2='$Title2', Title3='$Title3', ID='$ID', Birth='$Birth', Phone='$Phone', Mail='$Mail', Diet='$Diet', Contact='$Contact', ContactRelation='$ContactRelation', ContactPhone='$ContactPhone', Gender='$Gender' where OID='$row->OID'", "");
    }
  }
  echo "修改完成。";
}
?>
<p align="center"><a href="admin_signup_list.php?OID=<?= $_POST["ActivityOID"] ?>">返回上一頁</a></p>
<? require("template_bottom.php"); ?>
