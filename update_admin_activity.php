<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
$result = mysql_query("select * from activity where OID='".$_POST["OID"]."'");
$row = mysql_fetch_object($result);
require($_POST["OID"] == "" ? "check_post.php" : "check_edit.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>活動管理</h1>
<?
$OID = $_POST["OID"];

// 檔案上傳
$Attachment = $_POST["Attachment_origin"];
if($_POST["del_Attachment"])
{
  echo unlink("./uploads/".$Attachment) ? $Attachment." 已刪除。<br />" : " 刪除失敗。<br />";
  $Attachment = "";
}
if($_FILES["Attachment"]["tmp_name"] != "")
{
  $Attachment = $OID."_".$_FILES["Attachment"]["name"];
  if(!move_uploaded_file($_FILES["Attachment"]["tmp_name"], "uploads/".$Attachment))
    echo "檔案上傳失敗: ".$Attachment." <br>";
}
$Attachment2 = $_POST["Attachment2_origin"];
if($_POST["del_Attachment2"])
{
  echo unlink("./uploads/".$Attachment2) ? $Attachment2." 已刪除。<br />" : " 刪除失敗。<br />";
  $Attachment2 = "";
}
if($_FILES["Attachment2"]["tmp_name"] != "")
{
  $Attachment2 = $OID."_".$_FILES["Attachment2"]["name"];
  if(!move_uploaded_file($_FILES["Attachment2"]["tmp_name"], "uploads/".$Attachment2))
    echo "檔案上傳失敗: $Attachment2 <br>";
}
$Attachment3 = $_POST["Attachment3_origin"];
if($_POST["del_Attachment3"])
{
  echo unlink("./uploads/".$Attachment3) ? $Attachment3." 已刪除。<br />" : " 刪除失敗。<br />";
  $Attachment3 = "";
}
if($_FILES["Attachment3"]["tmp_name"] != "")
{
  $Attachment3 = $OID."_".$_FILES["Attachment3"]["name"];
  if(!move_uploaded_file($_FILES["Attachment3"]["tmp_name"], "uploads/".$Attachment3))
    echo "檔案上傳失敗: $Attachment3 <br>";
}
// 郵件檔案上傳
$MailAttachment1 = $_POST["MailAttachment1_origin"];
if($_POST["del_MailAttachment1"])
{
  unlink("./uploads/".$MailAttachment1);
  $MailAttachment1 = "";
}
if($_FILES["MailAttachment1"]["tmp_name"] != "")
{
  $MailAttachment1 = $OID."_".$_FILES["MailAttachment1"]["name"];
  if(!move_uploaded_file($_FILES["MailAttachment1"]["tmp_name"], "uploads/".$MailAttachment1))
    echo "檔案上傳失敗: $MailAttachment1 <br>";
}
$MailAttachment2 = $_POST["MailAttachment2_origin"];
if($_POST["del_MailAttachment2"])
{
  unlink("./uploads/".$MailAttachment2);
  $MailAttachment2 = "";
}
if($_FILES["MailAttachment2"]["tmp_name"] != "")
{
  $MailAttachment2 = $OID."_".$_FILES["MailAttachment2"]["name"];
  if(!move_uploaded_file($_FILES["MailAttachment2"]["tmp_name"], "uploads/".$MailAttachment2))
    echo "檔案上傳失敗: $MailAttachment2 <br>";
}

//基本資料
$Type = $_POST["Type"];
$Type2 = $_POST["Type2"];
$Title = $_POST["Title"];
$Content = addslashes($_POST["Content"]);
$Location = $_POST["Location"];
$HoldBy = $_POST["HoldBy"];
$Restrict = $_POST["Restrict"] == "" ? 0 : $_POST["Restrict"];
$Restrict_Academic = implode(",", $_POST["Restrict_Academic"]);
$Restrict_Dept = implode(",", $_POST["Restrict_Dept"]);
////////////點選院別 其下系所會被自動選取////////////////
$Restrict_Dept = $Restrict_Dept.",".implode(",", $arr);
////////////若沒有選擇級別 代表所有級別////////////////

$Restrict_Grade = implode(",", $_POST["Restrict_Grade"]);

// if($Restrict_Grade == NULL){
//   $Restrict_Grade = "博士班,碩士班,四年級,三年級,二年級,一年級,其他";
// }

$PersonLimit = $_POST["PersonLimit"] == 0 ? -1 : $_POST["PersonLimit_input"];
$DateStart = $_POST["DateStart"]." ".$_POST["DateStart_Hour"].":".$_POST["DateStart_Minute"].":00";
$DateEnd = $_POST["DateEnd"]." ".$_POST["DateEnd_Hour"].":".$_POST["DateEnd_Minute"].":00";
$DateAction = $_POST["DateAction"]." ".$_POST["DateAction_Hour"].":".$_POST["DateAction_Minute"].":00";
$DateFinish = $_POST["DateFinish"]." ".$_POST["DateFinish_Hour"].":".$_POST["DateFinish_Minute"].":00";
$Link = $_POST["Link"];
$Specific = $_POST["Specific"] ? 1 : 0;

//報名通知設定
$NeedAlert_Career = $_POST["NeedAlertC"];
$career_mail1 = $_POST["CMail1"];
$career_mail2 = $_POST["CMail2"];
$NeedAlert = $_POST["NeedAlert"];
$MailAlertContent = $_POST["MailAlertContent"];
$AlertTime = $_POST["AlertTime"] == "其他" ? $_POST["AlertDate"] : $_POST["AlertTime"];
//$NeedCheck = $_POST["NeedCheck"];
//$YesContent = str_replace("[時間]", $DateAction, $_POST["YesContent"]);
//$YesContent = str_replace("[名稱]", $Title, $YesContent);
//$NoContent = $_POST["NoContent"];

//活動工讀生通知設定
$Staff_Alert = $_POST["Staff_Alert"];
$Staff_Content = $_POST["Staff_Content"];
$Staff_Time = $_POST["Staff_Time"] == "其他" ? $_POST["Staff_Date"]." ".$_POST["Staff_Date_Hour"].":".$_POST["Staff_Date_Minute"].":00" : $_POST["Staff_Time"];
for($i = 1; $i <= 6; $i++)
{
  if($_POST["Staff_OID$i"] != "")
  {
    if($_POST["Staff_Name$i"] != "" || $_POST["Staff_Mail$i"] != "")
      sqlquery("UPDATE activity_staff set `Name`='".$_POST["Staff_Name$i"]."', `Mail`='".$_POST["Staff_Mail$i"]."' where OID='".$_POST["Staff_OID$i"]."'", "");
    else
      sqlquery("delete from activity_staff where OID='".$_POST["Staff_OID$i"]."'", "");
  }
  else if($_POST["Staff_Name$i"] != "" || $_POST["Staff_Mail$i"] != "")
    sqlquery("insert into activity_staff (`Activity_OID`, `Name`, `Mail`) values('$OID', '".$_POST["Staff_Name$i"]."', '".$_POST["Staff_Mail$i"]."')", "");
}
  
//報名表單設定
$NeedName = $_POST["NeedName"];
$NeedStuID = $_POST["NeedStuID"];
$NeedDept = $_POST["NeedDept"];
$NeedID = $_POST["NeedID"];
$NeedGender = $_POST["NeedGender"];
$NeedBirth = $_POST["NeedBirth"];
$NeedPhone = $_POST["NeedPhone"];
$NeedDiet = $_POST["NeedDiet"];
$NeedContact = $_POST["NeedContact"];
$NeedContactPhone = $_POST["NeedContactPhone"];
$NeedContactRelation = $_POST["NeedContactRelation"];
$NeedMail = $_POST["NeedMail"];
$NeedDeposit = $_POST["NeedDeposit"];
$NeedUpload = $_POST["NeedUpload"];
$NeedRemark = $_POST["NeedRemark"] == 1 ? $_POST["Remark_Words"] : 0;
$Remark_Defult = $_POST["NeedRemark"] == 1 ? $_POST["Remark_Defult"] : "";

//花絮設定
$Impression = $_POST["Impression"];
$Photo = $_POST["Photo"];
$Photo_URL = $_POST["Photo_URL"];

//var_dump(array($Title,$Type,$Type2,$HoldBy,$Location,$DateStart,$DateEnd,$DateAction,$DateFinish,$NeedAlert,$MailAlertContent,$MailAttachment1,$MailAttachment2,$AlertTime,$Content,$Restrict,$Restrict_Academic,$Restrict_Dept,$Restrict_Grade,$PersonLimit,$NeedName,$NeedStuID,$NeedDept,$NeedID,$NeedGender,$NeedBirth,$NeedPhone,$NeedDiet,$NeedContact,$NeedContactPhone,$NeedContactRelation,$NeedMail,$NeedDeposit,$NeedUpload,$NeedRemark,$Remark_Defult,$Link,$Attachment,$Attachment2,$Attachment3,$Specific,$_SESSION["Activity_ID"],$Staff_Alert,$Staff_Content,$Staff_Time));

$sql = $_POST["submit"] == "新增" ? 
"INSERT INTO `activity` (`Title`, `Type`, `Type2`, `HoldBy`, `Location`, `DateStart`, `DateEnd`, `DateAction`, `DateFinish`, `NeedAlert_Career`, `career_mail1`, `career_mail2`, `NeedAlert`, `MailAlertContent`, `MailAttachment1`, `MailAttachment2`,`AlertTime`, `Content`, `Restrict`, `Restrict_Academic`, `Restrict_Dept`, `Restrict_Grade`, `PersonLimit`, `NeedName`, `NeedStuID`, `NeedDept`, `NeedID`, `NeedGender`, `NeedBirth`, `NeedPhone`, `NeedDiet`, `NeedContact`, `NeedContactPhone`, `NeedContactRelation`, `NeedMail`, `NeedDeposit`, `NeedUpload`, `NeedRemark`, `Remark_Defult`, `Link`, `Attachment`, `Attachment2`, `Attachment3`, `Specific`, `PostBy`, `Staff_Alert`, `Staff_Content`, `Staff_Time`) VALUES ('$Title', '$Type', '$Type2', '$HoldBy', '$Location', '$DateStart', '$DateEnd', '$DateAction', '$DateFinish', '$NeedAlert_Career', '$career_mail1', '$career_mail2', '$NeedAlert', '$MailAlertContent', '$MailAttachment1', '$MailAttachment2', '$AlertTime', '$Content', '$Restrict', '$Restrict_Academic', '$Restrict_Dept', '$Restrict_Grade', '$PersonLimit', '$NeedName', '$NeedStuID', '$NeedDept', '$NeedID', '$NeedGender', '$NeedBirth', '$NeedPhone', '$NeedDiet', '$NeedContact', '$NeedContactPhone', '$NeedContactRelation', '$NeedMail', '$NeedDeposit', '$NeedUpload', '$NeedRemark', '$Remark_Defult', '$Link', '$Attachment', '$Attachment2', '$Attachment3', '$Specific', '".$_SESSION["Activity_ID"]."', '$Staff_Alert', '$Staff_Content', '$Staff_Time')" : 
"UPDATE activity set `Title`='$Title', `Type`='$Type', `Type2`='$Type2', `HoldBy`='$HoldBy', `Location`='$Location', `DateStart`='$DateStart', `DateEnd`='$DateEnd', `DateAction`='$DateAction', `DateFinish`='$DateFinish', `NeedAlert_Career`='$NeedAlert_Career', `career_mail1`='$career_mail1', `career_mail2`='$career_mail2', `NeedAlert`='$NeedAlert', `MailAlertContent`='$MailAlertContent', `MailAttachment1`='$MailAttachment1', `MailAttachment2`='$MailAttachment2',`AlertTime`='$AlertTime', `Content`='$Content', `Restrict`='$Restrict', `Restrict_Academic`='$Restrict_Academic', `Restrict_Dept`='$Restrict_Dept', `Restrict_Grade`='$Restrict_Grade', `PersonLimit`='$PersonLimit', `NeedName`='$NeedName', `NeedStuID`='$NeedStuID', `NeedDept`='$NeedDept', `NeedID`='$NeedID', `NeedGender`='$NeedGender', `NeedBirth`='$NeedBirth', `NeedPhone`='$NeedPhone', `NeedDiet`='$NeedDiet', `NeedContact`='$NeedContact', `NeedContactPhone`='$NeedContactPhone', `NeedContactRelation`='$NeedContactRelation', `NeedMail`='$NeedMail', `NeedDeposit`='$NeedDeposit', `NeedUpload`='$NeedUpload', `NeedRemark`='$NeedRemark', `Remark_Defult`='$Remark_Defult', `Link`='$Link', `Attachment`='$Attachment', `Attachment2`='$Attachment2', `Attachment3`='$Attachment3', `Specific`='$Specific', `Impression`='$Impression', `Photo`='$Photo', `Photo_URL`='$Photo_URL', `Staff_Alert`='$Staff_Alert', `Staff_Content`='$Staff_Content', `Staff_Time`='$Staff_Time' where OID=$OID";

sqlquery($sql, "增修完成。");


?>
<? require("template_bottom.php"); ?>