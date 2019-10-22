<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>活動報名</h1>
<?
if($_POST["submit"] == "submit")
{
  $now = date("Y-m-d H:i:s");
  
  //取得報名人數
  $result = mysql_query("select count(*) as Count from activity_signup where Activity_OID='".$_POST["OID"]."'");
  $row = mysql_fetch_object($result);
  $count = $row->Count;

  //取得地點可容納人數
  $result = mysql_query("select * from setup_location");
  while($row = mysql_fetch_object($result))
    $size["$row->OID"] = $row->Size;

  $result = mysql_query("select * from activity where OID='".$_POST["OID"]."'");
  $row = mysql_fetch_object($result);
  //檢查人數和時間是否符合報名條件
  if((intval($count) < intval($row->PersonLimit == -1 ? $size[$row->Location] : $row->PersonLimit) && $now < $row->DateEnd && $now > $row->DateStart) || $_SESSION["Activity_admin"])
  {
    //檢查是否重複報名
    $result = $_POST["Attendant_type"] == "學生" ? mysql_query("select OID from attendant where StuID='".$_POST["StuID"]."'") : mysql_query("select OID from attendant where ID='".$_POST["ID_career"]."'");
    $row = mysql_fetch_object($result);
    $Attendant_OID = $row->OID;
    
    $result = mysql_query("select count(*) as Count from activity_signup where Activity_OID='".$_POST["OID"]."' and Attendant_OID='$Attendant_OID'");
    $row = mysql_fetch_object($result);
    if($row->Count == 0)
    {
      $Name = $_POST["Name"];
      $StuID = $_POST["StuID"];
      if($_POST["Attendant_type"] == "學生")
      {
        $Title1 = "學生";
        $Title2 = $_POST["Title2_stu"];
        $Title3 = $_POST["Title3_stu"];
        $ID = $_POST["ID_stu"];
      }
      else
      {
        $Title1 = $_POST["Title1_career"];
        $Title2 = $_POST["Title2_career"];
        $Title3 = $_POST["Title3_career"];
        $ID = $_POST["ID_career"];
      }
      $Gender = $_POST["Gender"] == "" ? 0 : $_POST["Gender"];
      $Birth = $_POST["Birth"] != "" ? $_POST["Birth"] : "0000-00-00";
      $Phone = $_POST["Phone"];
      $Diet = $_POST["Diet"] == "其他" ? $_POST["Diet_else"] : $_POST["Diet"];
      $Contact = $_POST["Contact"];
      $ContactPhone = $_POST["ContactPhone"];
      $ContactRelation = $_POST["ContactRelation"];
      $Mail = $_POST["Mail"];
      $Remark = $_POST["Remark"];
      $Public_Profiles = $_POST["Public_Profiles"];
      
      // 檔案上傳
      if($_FILES["Upload"]["tmp_name"] != "")
      {
        $Upload = $_POST["OID"]."_$Name"."_".$_FILES["Upload"]["name"];
        if(!move_uploaded_file($_FILES["Upload"]["tmp_name"], "uploads/attendants/".mb_convert_encoding($Upload, "UTF-8", "auto")))
          echo "檔案上傳失敗: $Upload <br>";
      }
      
      //增修參加者資料
      if($Attendant_OID == "")
      {
        sqlquery("INSERT INTO `activity`.`attendant` (`Name` ,`StuID` ,`Title1` ,`Title2` ,`Title3` ,`ID` ,`Gender` ,`Birth` ,`Phone` ,`Diet` ,`Contact` ,`ContactPhone` ,`ContactRelation` ,`Mail`, `Public_Profiles`) VALUES ('$Name', '$StuID', '$Title1', '$Title2', '$Title3', '$ID', '$Gender', '$Birth', '$Phone', '$Diet', '$Contact', '$ContactPhone', '$ContactRelation', '$Mail', '$Public_Profiles' )", "");
          
        $result = mysql_query("select OID from attendant where `Name`='$Name' and `StuID`='$StuID' and `ID`='$ID'");
        $row = mysql_fetch_object($result);
        $Attendant_OID = $row->OID;
      }
      else
      {
        $result = mysql_query("select * from activity where OID='".$_POST["OID"]."'");
        $row = mysql_fetch_object($result);
        $str = "";
        if($row->NeedName)
          $str = $str.", `Name`='$Name'";
        if($row->NeedStuID)
          $str = $str.", `StuID`='$StuID'";
        if($row->NeedDept)
          $str = $str.", `Title1`='$Title1', `Title2`='$Title2', `Title3`='$Title3'";
        if($row->NeedID)
          $str = $str.", `ID`='$ID'";
        if($row->NeedGender)
          $str = $str.", `Gender`='$Gender'";
        if($row->NeedBirth)
          $str = $str.", `Birth`='$Birth'";
        if($row->NeedPhone)
          $str = $str.", `Phone`='$Phone'";
        if($row->NeedDiet)
          $str = $str.", `Diet`='$Diet'";
        if($row->NeedContact)
          $str = $str.", `Contact`='$Contact'";
        if($row->NeedContactPhone)
          $str = $str.", `ContactPhone`='$ContactPhone'";
        if($row->NeedContactRelation)
          $str = $str.", `ContactRelation`='$ContactRelation'";
        if($row->NeedMail)
          $str = $str.", `Mail`='$Mail'";
        $str = substr($str, 2);
				
        sqlquery("update attendant set $str, `Public_Profiles`='$Public_Profiles' where OID='$Attendant_OID'", "");
      }
      
      //寫入報名
      sqlquery("INSERT INTO `activity_signup` (`Activity_OID` ,`Attendant_OID`, `Upload`, `Remark`) VALUES ('".$_POST["OID"]."', '$Attendant_OID', '$Upload', '$Remark')", "");
      
      //寄通知信
      $result = mysql_query("select * from activity where OID='".$_POST["OID"]."'");
      $row = mysql_fetch_object($result);
      $time = $row->DateAction;
	  
	    //寄給職員
      if($row->NeedAlert_Career == 1){
        require("../PHPMailer/mail.php");
		    mb_internal_encoding("UTF-8");
		    $mail->AddAddress($row->career_mail1, $row->career_mail1);
		    if ($row->career_mail2 != ""){
			    $mail->AddAddress($row->career_mail2, $row->career_mail2);
		    }
        $mail->Subject =  mb_encode_mimeheader("完成報名", "UTF-8");
        $mail->IsHTML(true);
        $message = "您好，".$row->Title."有".$Name."完成報名。<br>報名完成時間為 ".$time."<br>請協助安排後續作業。<br>謝謝。";

        $mail->MsgHTML($message);

        if (!$mail->Send()){
          echo "Mail error! ";//.$mail->ErrorInfo;
        }
        else{
          echo "success. ";
        }
	    }
		
      //寄給學生
      if($row->NeedAlert == 1){
        $mail->ClearAllRecipients();
      
        $message = "";
        mb_internal_encoding("UTF-8");
        $mail->AddAddress($Mail, $Mail);
        $mail->Subject =  mb_encode_mimeheader("感謝您報名職涯中心 ".$row->Title." 活動", "UTF-8");
        $message = $row->MailAlertContent;
        $message = str_replace("[時間]", $time, $message);
        $message = str_replace("[名稱]", $row->Title, $message);
        $mail->MsgHTML($message);
          
        //夾帶附件檔
        if($row->MailAttachment1 != "")
          $mail->AddAttachment("./uploads/".$row->MailAttachment1);
        if($row->MailAttachment2 != "")
          $mail->AddAttachment("./uploads/".$row->MailAttachment2);
          
        if(!$mail->Send())
          echo "報名成功 通知信寄送失敗。<br>";
      }
      echo "報名完成。";
    }
    else
      echo "您已報名過本活動，請勿重複報名。";
  }
  else
    echo "報名人數已滿或非報名時段";
}
?>
<? require("template_bottom.php"); ?>
