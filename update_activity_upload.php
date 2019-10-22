<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
require("template_query.php");
?>

<? require("template_head.php"); ?>
<h1>活動檔案重新上傳</h1>
<?
if($_POST["submit"] == "送出")
{
	
	$user_id = $_POST["USER_ID"]."@cc.ncu.edu.tw";
	$user_passwd = $_POST["USER_PASSWD"];
	if(isset($user_id) && isset($user_passwd))
	{
		//核對學校信箱帳號密碼
		
		$fp = fsockopen("cc.ncu.edu.tw", 110, $errno, $errstr, 10);
		$answer1 = fgets($fp,128);
		//echo "answer1 = $answer1<br />";
		if (!$fp)
			echo "$errstr ($errno)<br>\n";
		else
		{
			fwrite($fp, "USER $user_id\n");
			$answer2 = fgets($fp,128);
			//echo "answer2 = $answer2<br />";
			fwrite($fp, "PASS $user_passwd\n");
			$answer3 = fgets($fp,128);
			//echo "answer3 = $answer3<br />";
			if(strpos($answer3, 'OK') == FALSE)
			{
				echo "<p align='center'>登入資訊錯誤<br />";
				echo "<a href=javascript:history.back(1)>回上一頁</a></p>";
			}
			else
			{
				$result = mysql_query("select s.OID, a.Name from activity_signup s, attendant a where s.Activity_OID='".$_POST["OID"]."' and a.StuID='".$_POST["USER_ID"]."' and s.Attendant_OID=a.OID");
				$row = mysql_fetch_object($result);
				if($row->OID != "")
				{
					// 檔案上傳
					if($_FILES["Upload"]["tmp_name"] != "")
					{
						$Upload = $_POST["OID"]."_$row->Name"."_".$_FILES["Upload"]["name"];
						//echo "檔案上傳失敗: $Upload <br>";
						if(!move_uploaded_file($_FILES["Upload"]["tmp_name"], "uploads/attendants/".mb_convert_encoding($Upload, "UTF-8", "auto")))
							echo "檔案上傳失敗: $Upload <br>";
					}
					$now = date("Y-m-d H:i:s");
					
					//寫入報名
					sqlquery("update `activity_signup` set `Upload`='$Upload', PostTime='$now' where OID='$row->OID'", "檔案上傳完成");
				}
				else
					echo "尚未完成第一次報名。";
			}
		}
		fclose ($fp);
	}
}
?>
<? require("template_bottom.php"); ?>