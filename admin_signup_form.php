<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<? 
require("sql_link.php");
$result = mysql_query("select * from activity where OID='".$_GET['OID']."'");
$row = mysql_fetch_object($result);
require("check_signup_list.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>　</title>
<style type="text/css">
<!--
body {
  margin:0px 0px 0px 0px;
}
th { 
  white-space:nowrap;
  border-bottom: 1px solid rgb(208, 220, 224);
} 
td { 
  border-bottom: 1px solid rgb(208, 220, 224);
}
-->
</style>
</head>
<link rel="stylesheet" type="text/css" href="./style.css" />

<body>
<?
$now = date("Y-m-d");

$result = mysql_query("select * from setup_type2");
while($row = mysql_fetch_object($result))
  $type2["$row->OID"] = $row->Title;

$result = mysql_query("select count(*) as count from activity_signup where Activity_OID=".$_GET["OID"]);
$row = mysql_fetch_object($result);
$count = $row->count;

$result = mysql_query("select * from activity where OID=".$_GET["OID"]);
$row = mysql_fetch_object($result);

$result2 = mysql_query("select att.* from attendant att, activity_signup a where att.OID=a.Attendant_OID and a.Activity_OID=".$_GET["OID"]." order by Title2, Name");
$row_count = 0;
while($row2 = mysql_fetch_object($result2))
{
	if($row_count % 20 == 0)
	{
?>
<h1 align="center"><?= $row->Title ?><?= $row->Type2 == "" ? "" : "_".$type2[$row->Type2] ?></h1>
<table id="list" align="center" border="0" cellspacing="2" cellpadding="2" width="95%">
	<tr>
		<th align="left" width="30%">活動日期與時間</th>
		<td width="70%"><?= substr($row->DateAction, 0, 16) ?></td>
	</tr>
	<tr>
		<th align="left">已報名人數</th>
		<td><?= $count ?></td>
	</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="10" width="95%">
	<tr>
		<th align="center" nowrap="nowrap">序號</th>
		<th width="250" align="center" nowrap="nowrap">單位/系級</th>
		<th width="100" align="center" nowrap="nowrap">學號</th>
		<th width="100" align="center" nowrap="nowrap">姓名</th>
		<th width="100" align="center" nowrap="nowrap">簽名處</th>
		<th width="50" align="center" nowrap="nowrap">問卷<br>繳交</th>
	</tr>
<?
	}
	$row_count++;
?>
	<tr valign="top">
		<td align="center" nowrap="nowrap"><?= $row_count ?></td>
		<td nowrap="nowrap"><?= $row2->Title2 ?> <?=$row2->Title3 ?></td>
		<td align="center" nowrap="nowrap"><?= $row2->StuID ?></td>
		<td align="center" nowrap="nowrap"><?= $row2->Name ?></td>
		<td align="center" nowrap="nowrap"></td>
		<td align="center" nowrap="nowrap"></td>
	</tr>
<?
	if($row_count % 20 == 0)
	  echo '</table><P style="page-break-after:always"></P>';
}
?>
</body>

</html>