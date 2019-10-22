<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
$result = mysql_query("select * from activity where OID='".$_GET["OID"]."'");
$row = mysql_fetch_object($result);
require($_GET["OID"] == "" ? "check_post.php" : "check_edit.php");
//var_dump($row);
?>

<? require("template_head.php"); ?>
<script type="text/javascript">
function submit_check()
{
  if(document.form.Title.value == "")
  {
    alert("名稱欄位有誤");
    document.form.Title.focus();
  }
  else if(document.form.Type.value == "")
  {
    alert("類別欄位有誤");
    document.form.Type.focus();
  }
  else if(document.form.Location.value == "")
  {
    alert("地點欄位有誤");
    document.form.Location.focus();
  }
  else if(document.form.PersonLimit[1].checked && document.form.PersonLimit_input.value == "")
  {
    alert("人數上限欄位有誤");
    document.form.PersonLimit_input.focus();
  }
  else if(document.form.NeedAlert[0].checked && document.form.MailAlertContent.value == "")
  {
    alert("發信內容欄位有誤");
    document.form.MailAlertContent.focus();
  }
  else if(document.form.DateStart.value == "" || document.form.DateStart_Hour.value == "" || document.form.DateStart_Minute.value == "")
  {
    alert("報名開始欄位有誤");
    document.form.DateStart.focus();
  }
  else if(document.form.DateEnd.value == "" || document.form.DateEnd_Hour.value == "" || document.form.DateEnd_Minute.value == "")
  {
    alert("報名截止欄位有誤");
    document.form.DateEnd.focus();
  }
  else if(document.form.DateAction.value == "" || document.form.DateAction_Hour.value == "" || document.form.DateAction_Minute.value == "")
  {
    alert("活動時間欄位有誤");
    document.form.DateAction.focus();
  }
  else if(document.form.AlertTime[2].checked && document.form.AlertDate.value == "")
  {
    alert("活動提醒時間欄位有誤");
    document.form.AlertDate.focus();
  }
  else
    return true;
  return false;
}
</script>
<script>
	function selectDept(){
		for (var i=1; i<14; i++){
			if (jQuery("[name="+i+"]").attr('selected')){
				jQuery($("."+i).show());
			}
			else{
				jQuery($("."+i).hide());
			}
		}		
	}
</script>

<form name="form" method="POST" action="update_admin_activity.php" enctype="multipart/form-data" onsubmit="return submit_check()">
<h1>活動管理: <?= $_GET["OID"] == "" ? "新增" : $row->Title ?></h1>
<div style="border-style:dotted; border-width:1px">
	<input type="hidden" name="OID" value="<?= $_GET['OID'] ?>" />
	<table id="list" border="0" cellspacing="2" cellpadding="2" width="100%">
		<tr>
			<th align="center" colspan="2" bgcolor="#FFFFCC"><font color="#000099">基本資料</font></th>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>類別</th>
			<td align="left">
				<select name="Type">
					<option value=""></option>
					<?
					$result2 = mysql_query("select * from setup_type");
					while($row2 = mysql_fetch_object($result2))
					{
					?>
					<option value="<?= $row2->OID ?>" <? if($row->Type == $row2->OID){ echo 'selected="selected"'; } ?>><?= $row2->Title ?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th align="center">細目別</th>
			<td align="left">
				<select name="Type2">
					<option value=""></option>
					<?
					$result2 = mysql_query("select * from setup_type2");
					while($row2 = mysql_fetch_object($result2))
					{
					?>
					<option value="<?= $row2->OID ?>" <? if($row->Type2 == $row2->OID){ echo 'selected="selected"'; } ?>><?= $row2->Title ?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>名稱</th>
			<td align="left"><input type="text" name="Title" size="60" value="<?= $row->Title ?>"></td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>內容</th>
			<td align="left"><textarea rows="25" name="Content" cols="50"><?= $row->Content ?></textarea></td>
			<?php
			include_once "ckeditor/ckeditor.php";
			$CKEditor = new CKEditor();
			$CKEditor->basePath = 'ckeditor/';
			$CKEditor->replace("Content");
			?>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>地點</th>
			<td align="left">
				<select name="Location">
					<option value=""></option>
					<?
					$result2 = mysql_query("select * from setup_location");
					while($row2 = mysql_fetch_object($result2))
					{
					?>
					<option value="<?= $row2->OID ?>" <? if($row->Location == $row2->OID){ echo 'selected="selected"'; } ?>><?= $row2->Title ?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th align="center">承辦單位</th>
			<td align="left"><input type="text" name="HoldBy" size="60" value="<?= $row->HoldBy ?>"></td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>人數上限</th>
			<td align="left">
				<input name="PersonLimit" type="radio" value="0" <? if($row->PersonLimit == -1){ echo 'checked="checked"'; } ?>>依場地可容納人數 
				<input name="PersonLimit" type="radio" value="1" <? if($row->PersonLimit != -1){ echo 'checked="checked"'; } ?>>自訂: 
				<input type="text" name="PersonLimit_input" size="5" value="<?= $row->PersonLimit != -1 ? $row->PersonLimit : "" ?>">
			</td>
		</tr>
		<tr>
			<th align="center">系所限制<br /><a href="admin_edit_RestrictSample.php" target="_blank">範例</a></th>
			<td align="left">
        <select name="Restrict">
          <option value="0" <? if($row->Restrict == 0){ echo 'selected="selected"'; } ?>>禁止</option>
          <option value="1" <? if($row->Restrict == 1){ echo 'selected="selected"'; } ?>>允許</option>
        </select>: <br />
        <select name="Restrict_Academic[]" multiple="multiple" size="15">
					<option value=""></option>
          <?
					$array = explode(",", $row->Restrict_Academic);
          $result2 = mysql_query("select * from ncu_academic.setup_academic");
          while($row2 = mysql_fetch_object($result2))
	/**/					echo '<option value="'.$row2->OID.'"  name="'.$row2->OID.'" onclick="selectDept()" '.(in_array($row2->OID, $array) ? 'selected="selected"' : "").'>'.$row2->Title.'</option>';
          ?>
        </select> - 
        <select name="Restrict_Dept[]" multiple="multiple" size="15">
					<option value=""></option>
          <?
					$array = explode(",", $row->Restrict_Dept);
          $result2 = mysql_query("select * from ncu_academic.setup_Dept");
          while($row2 = mysql_fetch_object($result2))
	/**/					echo '<option value="'.$row2->OID.'"  class="'.$row2->AcademicOID.'" '.(in_array($row2->OID, $array) ? 'selected="selected"' : "").'>'.$row2->Title.'</option>';
          ?>
        </select> 
        <select name="Restrict_Grade[]" multiple="multiple" size="15">
					<option value=""></option>
          <? $array = explode(",", $row->Restrict_Grade) ?>
          <option class="grades" value="博士班" <?= in_array("博士班", $array) ? 'selected="selected"' : "" ?>>博士班</option><!---->
          <option class="grades" value="碩士班" <?= in_array("碩士班", $array) ? 'selected="selected"' : "" ?>>碩士班</option><!---->
          <option class="grades" value="四年級" <?= in_array("四年級", $array) ? 'selected="selected"' : "" ?>>四年級</option><!---->
          <option class="grades" value="三年級" <?= in_array("三年級", $array) ? 'selected="selected"' : "" ?>>三年級</option><!---->
          <option class="grades" value="二年級" <?= in_array("二年級", $array) ? 'selected="selected"' : "" ?>>二年級</option><!---->
          <option class="grades" value="一年級" <?= in_array("一年級", $array) ? 'selected="selected"' : "" ?>>一年級</option><!---->
          <option class="grades" value="其他" <?= in_array("其他", $array) ? 'selected="selected"' : "" ?>>其他</option>
        </select><br />
        <font color="#FF0000">(按住 Ctrl 鍵可進行多選作業)</font>
			</td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>報名開始</th>
			<td align="left">
			<?
			require("datetime_manage.php");
			datetime("DateStart", $row->DateStart, 1, 1, 1, 0);
			?>
			<font color="#FF0000">(自動出現在活動報名清單的時間)</font>
			</td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>報名截止</th>
			<td align="left">
			<?
			datetime("DateEnd", $row->DateEnd, 1, 1, 1, 0);
			?>
			<font color="#FF0000">(無法報名，但仍在活動報名清單中)</font>
			</td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>活動開始時間</th>
			<td align="left">
			<?
			datetime("DateAction", $row->DateAction, 1, 1, 1, 0);
			?>
			<font color="#FF0000">(顯示給使用者，活動舉辦的時間)</font></td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>活動結束時間</th>
			<td align="left">
			<?
			datetime("DateFinish", $row->DateFinish, 1, 1, 1, 0);
			?>
			<font color="#FF0000">(變成活動花絮的時間)</font></td>
		</tr>
		<tr>
			<th align="center">網站連結</th>
			<td align="left">
			<textarea rows="5" name="Link" cols="50"><?= $row->Link ?></textarea>
			<br /><font color="#FF0000">(一行一個網址，太長自動換行不會影響，僅Enter換行才接受辨識)</font></td>
		</tr>
		<tr>
			<th align="center" rowspan="3">夾帶附件</th>
			<td align="left">

			<? if($row->Attachment != ""){ ?>
			<input name="del_Attachment" type="checkbox">勾選將清除既有附加檔案<br />
			目前附加檔案: <a href="uploads/<?= $row->Attachment ?>"><?= $row->Attachment ?></a> <font color="#FF0000">(若重複上傳將取代)</font><br />
			<? } ?>
			1. <input name="Attachment" type="file" /><input name="Attachment_origin" type="hidden" value="<?= $row->Attachment ?>" />
			</td>
		</tr>
		<tr>
			<td align="left">
			<? if($row->Attachment2 != ""){ ?>
			<input name="del_Attachment2" type="checkbox">勾選將清除既有附加檔案<br />
			目前附加檔案: <a href="uploads/<?= $row->Attachment2 ?>"><?= $row->Attachment2 ?></a> <font color="#FF0000">(若重複上傳將取代)</font><br />
			<? } ?>
			2. <input name="Attachment2" type="file" /><input name="Attachment2_origin" type="hidden" value="<?= $row->Attachment2 ?>" />
			</td>
		</tr>
		<tr>
			<td align="left">
			<? if($row->Attachment3 != ""){ ?>
			<input name="del_Attachment3" type="checkbox">勾選將清除既有附加檔案<br />
			目前附加檔案: <a href="uploads/<?= $row->Attachment3 ?>"><?= $row->Attachment3 ?></a> <font color="#FF0000">(若重複上傳將取代)</font><br />
			<? } ?>
			3. <input name="Attachment3" type="file" /><input name="Attachment3_origin" type="hidden" value="<?= $row->Attachment3 ?>" />
			</td>
		</tr>
		<tr>
			<th align="center">特定帳號之使用權</th>
			<td align="left">
			<input name="Specific" type="checkbox" <?= $row->Specific ? 'checked="checked"' : "" ?>>
			</td>
		</tr>
		<tr>
	</table>
</div>
<br />
<div style="border-style:dotted; border-width:1px">
	<table id="list" border="0" cellspacing="2" cellpadding="2" width="100%">
		<tr>
			<th align="center" colspan="2" bgcolor="#33FF99"><font color="#000099">報名通知設定</font></th>
		</tr>
		<tr>
			<th align="center" width="10%">報名後通知-職員</th>
			<td align="left">
				<?$row->NeedAlert_Career = 1?>
				<input name="NeedAlertC" type="radio" value="1" <? if($row->NeedAlert_Career == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是
				<input name="NeedAlertC" type="radio" value="0" <? if($row->NeedAlert_Career == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th align="center" width="10%">職員信箱</th>
			<td>
				1. <input type="text" name="CMail1" size="20" value="<?= $row->career_mail1 ?>"><br>
				2. <input type="text" name="CMail2" size="20" value="<?= $row->career_mail2 ?>">				
			</td>
		</tr>
		<tr>
			<th align="center" width="10%">報名後通知</th>
			<td align="left">
			<?$row->NeedAlert = 1?>
			<input name="NeedAlert" type="radio" value="1" <? if($row->NeedAlert == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?> onclick="Mail_alert.style.display=''">是
			<input name="NeedAlert" type="radio" value="0" <? if($row->NeedAlert == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?> onclick="Mail_alert.style.display='none'">否
			</td>
		</tr>
	</table>
	<div id="Mail_alert" style="<? if($row->NeedAlert == 0){ echo 'display:none'; } ?>">
	<table width="100%">
		<tr>
			<th align="center">Mail內容</th>
			<td align="left">
			<textarea rows="10" name="MailAlertContent" cols="50">
			<?
			if($_GET["OID"] == "")
			{
			?>
			<p>親愛的同學，您好：<br />感謝您報名<font color="#3366FF">[時間] [名稱]</font>，此信為確認您已完成線上報名手續。</p>
			<p>如有任何問題歡迎來信或來電洽詢，謝謝！</p>
			<p>國立中央大學 學務處 職涯發展中心<br />Tel: (03)422-7151  分機 </p>
			<?
			}
			else
				echo $row->MailAlertContent;
			?>
			</textarea>
			<br /><font color="#FF0000">(文中只要有<font color="#3366FF"><b>[時間]</b></font>或<font color="#3366FF"><b>[名稱]</b></font>，儲存後將自動替換為活動時間及活動名稱)</font>
			</td>
			<?php
			include_once "ckeditor/ckeditor.php";
			$CKEditor = new CKEditor();
			$CKEditor->basePath = 'ckeditor/';
			$CKEditor->replace("MailAlertContent");
			?>
		</tr>
		<tr>
			<th align="center">夾帶附件</th>
			<td align="left">
				<? if($row->MailAttachment1 != ""){ ?>
				<input name="del_MailAttachment1" type="checkbox">勾選將清除既有附加檔案<br />
				目前附加檔案:<a href="uploads/<?= $row->MailAttachment1 ?>"><?= $row->MailAttachment1 ?></a> <font color="#FF0000">(若重複上傳將取代)</font><br />
				<? } ?>
				<input name="MailAttachment1" type="file" /><input name="MailAttachment1_origin" type="hidden" value="<?= $row->MailAttachment1 ?>" /><br />
				<? if($row->MailAttachment2 != ""){ ?>
				<input name="del_MailAttachment2" type="checkbox">勾選將清除既有附加檔案<br />
				目前附加檔案: <a href="uploads/<?= $row->MailAttachment2 ?>"><?= $row->MailAttachment2 ?></a> <font color="#FF0000">(若重複上傳將取代)</font><br />
				<? } ?>
				<input name="MailAttachment2" type="file" /><input name="MailAttachment2_origin" type="hidden" value="<?= $row->MailAttachment2 ?>" />
			</td>
		</tr>
		<tr>
			<th align="center">發信時間</th>
			<td align="left">
				<input name="AlertTime" type="radio" value="完成報名即通知" <? if($row->AlertTime == "完成報名即通知" || $_GET["OID"] == ""){ echo 'checked="checked"'; } ?>>完成報名即通知 <br/>
				<input name="AlertTime" type="radio" value="活動前二日通知" <? if($row->AlertTime == "活動前二日通知"){ echo 'checked="checked"'; } ?>>活動前二日通知 <br/>
				<input name="AlertTime" type="radio" value="其他" <? if($row->AlertTime != "完成報名即通知" && $row->AlertTime != "活動前二日通知" && $_GET["OID"] != ""){ echo 'checked="checked"'; } ?>>其他：
				<?
				datetime("AlertDate", ($row->AlertTime != "完成報名即通知" && $row->AlertTime != "活動前二日通知" && $_GET["OID"] != "") ? $row->AlertTime : "", 1, 0, 0, 0);
				?>
			</td>
		</tr>
	</table>
	</div>
	<?
	/*
	<tr>
		<th align="center">由活動承辦人確認<br />報名成功與否</th>
		<td align="left">
		<input name="NeedCheck" type="radio" value="1" <? if($row->NeedCheck == 1){ echo 'checked="checked"'; } ?>>是 <input name="NeedCheck" type="radio" value="0" <? if($row->NeedCheck == 0){ echo 'checked="checked"'; } ?>>否</td>
	</tr>
	<tr>
		<th align="center">報名成功通知內容</th>
		<td align="left">
			<input name="YesContent" type="text" size="60" value="<?= $row->CheckContent1 ?>">
			<br /><font color="#FF0000">(文中只要有<font color="#3366FF"><b>[時間]</b></font>或<font color="#3366FF"><b>[名稱]</b></font>，儲存後將自動替換為活動時間及活動名稱)</font>
		</td>
	</tr>
	<tr>
		<th align="center">報名失敗通知內容</th>
		<td align="left"><input name="NoContent" type="text" size="60" value="<?= $row->CheckContent2 ?>"></td>
	</tr>
	*/
	?>
</div>
<br />
<div style="border-style:dotted; border-width:1px">
	<table id="list" border="0" cellspacing="2" cellpadding="2" width="100%">
		<tr>
			<th align="center" colspan="2" bgcolor="#FFCCFF"><font color="#000099">活動工讀生通知設定</font></th>
		</tr>
		<tr>
			<th align="center" width="10%">活動前通知</th>
			<td align="left">
			<input name="Staff_Alert" type="radio" value="1"<? if($row->Staff_Alert == 1){ echo 'checked="checked"'; } ?> onclick="Staff_alert.style.display=''">是
			<input name="Staff_Alert" type="radio" value="0"<? if($row->Staff_Alert == 0){ echo 'checked="checked"'; } ?> onclick="Staff_alert.style.display='none'">否
			</td>
		</tr>
	</table>
	<div id="Staff_alert" style="<? if($row->Staff_Alert == 0){ echo 'display:none'; } ?>">
	<table width="100%">
		<tr>
			<th align="center">發信內容</th>
			<td align="left">
			<textarea rows="10" name="Staff_Content" cols="50">
			<?
			if($_GET["OID"] == "")
			{
			?>
			<p>親愛的同學，您好：<br />請您於<font color="#3366FF">[時間]</font> 前去協助<font color="#3366FF">[名稱]</font>活動的進行。</p>
			<p>如有任何問題歡迎來信或來電洽詢，謝謝！<br />國立中央大學職涯志工暨校園徵才團隊 敬邀</p>
			<p>國立中央大學 學務處 職涯發展中心<br />Tel: (03)422-7151  分機 57280<br />
			職涯志工暨校園徵才資訊網 <a href="http://www.alumni.ncu.edu.tw/Careerdemo/index.php" target="_blank">http://www.alumni.ncu.edu.tw/Careerdemo/index.php</a> <br />
			職涯志工粉絲頁 <a href="http://www.facebook.com/ncucareer" target="_blank">http://www.facebook.com/ncucareer</a> <br />
			校園x徵才x情報in NCU <a href="http://www.facebook.com/NCUcampus" target="_blank">http://www.facebook.com/NCUcampus</a></p>
			<?
			}
			else
				echo $row->Staff_Content;
			?>
			</textarea>
			<br /><font color="#FF0000">(文中只要有<font color="#3366FF"><b>[時間]</b></font>或<font color="#3366FF"><b>[名稱]</b></font>，儲存後將自動替換為活動時間及活動名稱)</font>
			</td>
			<?php
			include_once "ckeditor/ckeditor.php";
			$CKEditor = new CKEditor();
			$CKEditor->basePath = 'ckeditor/';
			$CKEditor->replace("Staff_Content");
			?>
		</tr>
		<tr>
			<th align="center">提醒時間</th>
			<td align="left">
				<input name="Staff_Time" type="radio" value="活動前二日通知" <? if($row->Staff_Time == "活動前二日通知" || $_GET["OID"] == ""){ echo 'checked="checked"'; } ?>>活動前二日通知<br/>
				<input name="Staff_Time" type="radio" value="其他" <? if($row->Staff_Time != "活動前二日通知" && $_GET["OID"] != ""){ echo 'checked="checked"'; } ?>>其他：
				<?
				datetime("Staff_Date", ($row->Staff_Time != "活動前二日通知" && $_GET["OID"] != "") ? $row->Staff_Time : "", 1, 1, 1, 0);
				?>
			</td>
		</tr>
		<tr>
			<th align="center">人員設定</th>
			<td align="left">
			<?
			$result2 = mysql_query("select * from activity_staff where Activity_OID='".$_GET['OID']."'");
			for($i = 1; $i <= 6; $i++)
			{
				$row2 = mysql_fetch_object($result2);
			?>
			<input name="Staff_OID<?= $i ?>" type="hidden" value="<?= $row2->OID ?>">
			姓名:<input name="Staff_Name<?= $i ?>" type="text" value="<?= $row2->Name ?>" size="6"> Mail:<input name="Staff_Mail<?= $i ?>" type="text" value="<?= $row2->Mail ?>" size="40"><br />
			<? } ?>
			</td>
		</tr>
	</table>
	</div>
</div>
<br />
<div style="border-style:dotted; border-width:1px">
	<table id="list" border="0" cellspacing="2" cellpadding="2" width="100%">
		<tr>
			<th align="center" colspan="2" bgcolor="#999999"><font color="#000099">報名表單必填欄位設定</font></th>
		</tr>
		<tr>
			<th width="40%" align="center">姓名</th>
			<td align="left">
				
				<input name="NeedName" type="radio" value="1"<? if($row->NeedName == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedName" type="radio" value="0"<? if($row->NeedName == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">學號</th>
			<td align="left">
				<input name="NeedStuID" type="radio" value="1"<? if($row->NeedStuID == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedStuID" type="radio" value="0"<? if($row->NeedStuID == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">系級(單位)</th>
			<td align="left">
				<input name="NeedDept" type="radio" value="1"<? if($row->NeedDept == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedDept" type="radio" value="0"<? if($row->NeedDept == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">身分證字號</th>
			<td align="left">
				<input name="NeedID" type="radio" value="1"<? if($row->NeedID == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedID" type="radio" value="0"<? if($row->NeedID == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">性別</th>
			<td align="left">
				<input name="NeedGender" type="radio" value="1"<? if($row->NeedGender == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedGender" type="radio" value="0"<? if($row->NeedGender == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">生日</th>
			<td align="left">
				<input name="NeedBirth" type="radio" value="1"<? if($row->NeedBirth == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedBirth" type="radio" value="0"<? if($row->NeedBirth == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">手機</th>
			<td align="left">
				<input name="NeedPhone" type="radio" value="1"<? if($row->NeedPhone == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedPhone" type="radio" value="0"<? if($row->NeedPhone == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">飲食習慣</th>
			<td align="left">
				<input name="NeedDiet" type="radio" value="1"<? if($row->NeedDiet == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedDiet" type="radio" value="0"<? if($row->NeedDiet == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">緊急聯絡人</th>
			<td align="left">
				<input name="NeedContact" type="radio" value="1"<? if($row->NeedContact == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedContact" type="radio" value="0"<? if($row->NeedContact == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">聯絡人電話</th>
			<td align="left">
				<input name="NeedContactPhone" type="radio" value="1"<? if($row->NeedContactPhone == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedContactPhone" type="radio" value="0"<? if($row->NeedContactPhone == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">聯絡人關係</th>
			<td align="left">
				<input name="NeedContactRelation" type="radio" value="1"<? if($row->NeedContactRelation == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedContactRelation" type="radio" value="0"<? if($row->NeedContactRelation == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">信箱</th>
			<td align="left">
				<input name="NeedMail" type="radio" value="1"<? if($row->NeedMail == 1 || !isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedMail" type="radio" value="0"<? if($row->NeedMail == 0 && isset($_GET['OID'])){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">保證金</th>
			<td align="left">
				<input name="NeedDeposit" type="radio" value="1"<? if($row->NeedDeposit == 1){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedDeposit" type="radio" value="0"<? if($row->NeedDeposit == 0){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">上傳檔案</th>
			<td align="left">
				<input name="NeedUpload" type="radio" value="1"<? if($row->NeedUpload == 1){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedUpload" type="radio" value="0"<? if($row->NeedUpload == 0){ echo 'checked="checked"'; } ?>>否
			</td>
		</tr>
		<tr>
			<th width="40%" align="center">其他訊息</th>
			<td align="left">
				<input name="NeedRemark" type="radio" value="1" onclick="Remark_div.style.display=''" <? if($row->NeedRemark > 0){ echo 'checked="checked"'; } ?>>是 
				<input name="NeedRemark" type="radio" value="0" onclick="Remark_div.style.display='none'" <? if($row->NeedRemark == 0){ echo 'checked="checked"'; } ?>>否
				<div id="Remark_div" style="<? if($row->NeedRemark == 0){ echo 'display:none'; } ?>">
				字數上限: <select name="Remark_Words">
					<?
					for($w = 50; $w <= 500; $w += 50)
					{
					?>
					<option value="<?= $w ?>" <? if($row->NeedRemark == $w){ echo 'selected="selected"'; } ?>><?= $w ?></option>
					<? } ?>
				</select><br />
				預設文字: <input type="text" name="Remark_Defult" value="<?= $row->Remark_Defult ?>" size="30" />
				</div>
			</td>
		</tr>
	</table>
</div>
<?
if($_GET["OID"] != "")
{
?>
<br />
<div style="border-style:dotted; border-width:1px">
	<table id="list" border="0" cellspacing="2" cellpadding="2" width="100%">
		<tr>
			<th align="center" colspan="2" bgcolor="#66FFFF"><font color="#000099">花絮資料</font></th>
		</tr>
		<tr>
			<th align="center">花絮文字介紹</th>
			<td align="left"><textarea rows="10" name="Impression" cols="50"><?= $row->Impression ?></textarea></td>
			<?php
			include_once "ckeditor/ckeditor.php";
			$CKEditor = new CKEditor();
			$CKEditor->basePath = 'ckeditor/';
			$CKEditor->replace("Impression");
			?>
		</tr>
		<tr>
			<th align="center">花絮相簿網址</th>
			<td align="left"><input type="text" name="Photo" size="60" value="<?= $row->Photo ?>"></td>
		</tr>
		<tr>
			<th align="center">花絮相片網址</th>
			<td align="left">
			<textarea rows="5" name="Photo_URL" cols="50"><?= $row->Photo_URL ?></textarea>
			<br /><font color="#FF0000">(照片<b>圖檔</b>之網址，一行一個)</font></td>
		</tr>
	</table>
</div>
<? } ?>
<p align="center"><input type="submit" name="submit" value="<?= $_GET["OID"] == "" ? "新增" : "修改" ?>" /></p>
</form>
<? require("template_bottom.php"); ?>