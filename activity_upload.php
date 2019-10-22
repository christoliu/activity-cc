<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
$result = mysql_query("select * from activity where OID='".$_GET["OID"]."'");
$row = mysql_fetch_object($result);
if(!$row->NeedUpload)
	header("location: index.php");
?>

<? require("template_head.php"); ?>
<script type="text/javascript">
function submit_check()
{
	var file = document.form.Upload.value.substring(document.form.Upload.value.lastIndexOf('.') + 1, document.form.Upload.value.length).toLowerCase();
  if(document.form.USER_ID.value == "")
  {
    alert("帳號欄位有誤");
    document.form.USER_ID.focus();
  }
  else 
  if(document.form.USER_PASSWD.value == "")
  {
    alert("密碼欄位有誤");
    document.form.USER_PASSWD.focus();
  }
  else if((file != "pdf" && file != "ppt" && file != "doc" && file != "docx" && file != "pptx" && file != "zip" && file != "rar") || document.form.Upload.value == "")
  {
    alert("上傳檔案欄位有誤");
    document.form.Upload.focus();
  }
  else
    return true;
  return false;
}
</script>

<form name="form" method="POST" action="update_activity_upload.php" enctype="multipart/form-data" onsubmit="return submit_check()">
<h1>[<?= $row->Title ?>] 活動檔案重新上傳</h1>
<input type="hidden" name="OID" value="<?= $_GET["OID"] ?>">
<p align="center">請以 計算機中心郵件伺服器身分 進行驗證</p>
<table align="center" width="100%">
  <tr>
    <td align="center">帳號</td>
    <td nowrap="nowrap"><input type="text" name="USER_ID">@cc.ncu.edu.tw</td>
  </tr>
  <tr>
    <td align="center">密碼</td>
    <td><input type="password" name="USER_PASSWD"></td>
  </tr>
  <tr>
    <td align="center" nowrap="nowrap">上傳檔案</td>
    <td align="left"><input name="Upload" type="file" /><br /><font color="#FF0000">(將取代報名時上傳的舊檔案)</font><br /><font color="#FF0000">(檔案格式限定為.pdf .doc .docx .ppt .pptx .zip .rar)</font>
    </td>
  </tr>
</table>
<p align="center"><input type="submit" value="送出" name="submit"></p>
</form>
<? require("template_bottom.php"); ?>