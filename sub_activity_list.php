<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<form>
<h1>活動報名</h1>
<?
$now = date("Y-m-d H:i:s");
$order = $_GET["order"] == NULL ? "Type" : $_GET["order"];
$queue = $_GET["queue"] == NULL ? "DESC" : $_GET["queue"];

$result = mysql_query("select * from setup_type");
while($row = mysql_fetch_object($result))
  $type["$row->OID"] = $row->Title;
  
$result = mysql_query("select * from setup_type2");
while($row = mysql_fetch_object($result))
  $type2["$row->OID"] = $row->Title;
  
$result = mysql_query("select count(*) as Count from activity where DateStart<'$now' and DateFinish>'$now' order by $order $queue");

$row = mysql_fetch_object($result);
if($row->Count > 0)
{
?>
<p><font color="#FF0000">點擊欄位名稱可依該欄位排序，再次點擊則反排</font></p>
  <table id="list" border="0" cellspacing="2" cellpadding="2" width="100%">
    <tr align="center">
      <th><a href="./index.php?year=<?= $_GET["year"] ?>&order=Type&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">分類</a></th>
      <th><a href="./index.php?year=<?= $_GET["year"] ?>&order=DateAction&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">活動時間</a></th>
      <th><a href="./index.php?year=<?= $_GET["year"] ?>&order=Title&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">名稱</a></th>
      <th><a href="./index.php?year=<?= $_GET["year"] ?>&order=DateEnd&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">報名截止日期</a></th>
    </tr>
<?
  $result = mysql_query("select * from activity where DateStart<='$now' and DateFinish>='$now' and Type=".$_GET['type']." order by $order $queue");
  while($row = mysql_fetch_object($result))
  {
?>
    <tr>
      <td nowrap="nowrap"><?= $type[$row->Type] ?></td>
      <td nowrap="nowrap"><?= substr($row->DateAction, 0, 16) ?></td>
      <td><?= $row->Type2 == "" ? "" : "[".$type2[$row->Type2]."]<br />" ?><a href="./activity_info.php?OID=<?= $row->OID ?>"><?= $row->Title ?></a></td>
      <td nowrap="nowrap"><?= substr($row->DateEnd, 0, 16) ?></td>
    </tr>
<?
  }
}
else
  echo "目前無活動。";
?>
</table>
</form>
<? require("template_bottom.php"); ?>