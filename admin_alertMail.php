<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
require("PHPMailer/class.phpmailer.php");
?>

<? require("template_head.php"); ?>
<h1>本日應寄之通知信清單</h1>
<?
$result = mysql_query("SELECT * FROM setup");
$row = mysql_fetch_object($result);
$Last_MailAlert = $row->Last_MailAlert;
?>
<p align="right">最後寄送日期: <?= $Last_MailAlert ?></p>
<table align="center" border="0" cellpadding="2" cellspacing="2" width="100%">
  <tr>
    <th align="center">活動名稱</th>
    <th align="center">活動日期</th>
    <th align="center">通知條件/日期</th>
    <th align="center">報名者</th>
    <th align="center">狀態</th>
  </tr>
<?
$result = mysql_query("SELECT * FROM activity WHERE NeedAlert=1 and ((AlertTime='活動前二日通知' and date(DateAction)=DATE_ADD(CURDATE(),INTERVAL 2 DAY)) or AlertTime=CURDATE())");
while($row = mysql_fetch_object($result))
{
  $result_attendant = mysql_query("select * from activity_signup s, attendant a where s.Activity_OID=$row->OID and s.Attendant_OID=a.OID");
  while($row_attendant = mysql_fetch_object($result_attendant))
	{
?>
  <tr>
    <td><?= $row->Title ?></td>
    <td align="center"><?= substr($row->DateAction, 0, 10) ?></td>
    <td align="center"><?= $row->AlertTime ?></td>
    <td align="center"><?= $row_attendant->Name ?></td>
    <td align="center">
<?
    if(date("Y-m-d") > $Last_MailAlert)
    {
			//寄通知信
			$mail = new PHPMailer(); 
			mb_internal_encoding("UTF-8");
			$mail->From = "ncu7241@ncu.edu.tw";
			$mail->FromName = mb_encode_mimeheader("國立中央大學職涯發展中心", "UTF-8");
			$mail->AddAddress($row_attendant->Mail, $row_attendant->Mail);
			$mail->Subject =  mb_encode_mimeheader("感謝您報名職涯中心 ".$row->Title." 活動", "UTF-8");
			$mail->IsHTML(true);
			$message = $row->MailAlertContent;
			$message = str_replace("[時間]", $row->DateAction, $message);
			$message = str_replace("[名稱]", $row->Title, $message);
			$mail->MsgHTML($message);
			
			//夾帶附件檔
			if($row->MailAttachment1 != "")
				$mail->AddAttachment("./uploads/".$row->MailAttachment1);
			if($row->MailAttachment2 != "")
				$mail->AddAttachment("./uploads/".$row->MailAttachment2);
				
			if($mail->Send())
			  echo "成功";
			else
			  echo "失敗";
    }
		echo "</td></tr>";
  }
}
mysql_query("UPDATE setup set Last_MailAlert='".date("Y-m-d")."'");
?>
</table>
<? require("template_bottom.php"); ?>