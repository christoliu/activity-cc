<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
function sqlquery($sql, $msg)
{
	//執行SQL語法
	if(!mysql_query($sql))
	{
		mysql_query("insert into error_log (`SQL`) values('".str_replace("'", "''", $sql)."')");
		echo "<p>語法錯誤:<br>".$sql."<br>，已記錄，並請通知管理員。</p>";
	}
	else
		echo $msg;
}
?>