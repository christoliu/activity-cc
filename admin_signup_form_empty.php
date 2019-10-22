<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<? 
require("check_login.php");
require("sql_link.php");
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

$result = mysql_query("select * from activity where OID=".$_GET["OID"]);
$row = mysql_fetch_object($result);
?>
<h1 align="center"><?= $row->Title ?><?= $row->Type2 == "" ? "" : "_".$type2[$row->Type2] ?></h1>
<table id="list" align="center" border="0" cellspacing="2" cellpadding="2" width="95%">
	<tr>
		<th align="left" width="30%">活動日期與時間</th>
		<td width="70%"><?= substr($row->DateAction, 0, 16) ?></td>
	</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="10" width="95%">
	<tr>
		<th align="center" nowrap="nowrap">序號</th>
		<th width="250" align="center" nowrap="nowrap">單位/系級</th>
		<th width="180" align="center" nowrap="nowrap">學號</th>
		<th width="150" align="center" nowrap="nowrap">姓名</th>
	</tr>
<?
for($i = 0; $i < 20; $i++)
{
?>
	<tr valign="top">
		<td align="center" nowrap="nowrap"><?= $i + 1 ?></td>
		<td nowrap="nowrap"></td>
		<td align="center" nowrap="nowrap"></td>
		<td align="center" nowrap="nowrap"></td>
	</tr>
<? } ?>
</table>
</body>

</html>