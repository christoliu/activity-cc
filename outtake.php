<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<script type="text/javascript">
function submit_check()
{
	window.open("outtake.php?year="+document.form.Year.value+"&order=<?= $_GET["order"] ?>&queue=<?= $_GET["queue"] ?>", "_self");
}
</script>

<form name="form">
<h1>活動花絮</h1>
<p><font color="#FF0000">點擊欄位名稱可依該欄位排序，再次點擊則反排</font></p>
<select name="Year" onchange="submit_check()">
<?
$now = date("Y-m-d H:i:s");

$order = $_GET["order"] == NULL ? "DateAction" : $_GET["order"];
$queue = $_GET["queue"] == NULL ? "DESC" : $_GET["queue"];
$result = mysql_query("SELECT max(`DateAction`) Max,min(`DateAction`) Min FROM `activity` where DateAction<'$now'");
$row = mysql_fetch_object($result);
$max = intval(substr($row->Max, 5, 2)) >= 9 ? intval(substr($row->Max, 0, 4)) - 1911 : intval(substr($row->Max, 0, 4)) - 1912;
$min = intval(substr($row->Min, 5, 2)) >= 9 ? intval(substr($row->Min, 0, 4)) - 1911 : intval(substr($row->Min, 0, 4)) - 1912;
$year = intval($_GET["year"] == NULL ? $max : $_GET["year"]) + 1911;
for($i = $max; $i >= $min; $i--){
?>
  <option value="<?= $i ?>" <? if($_GET["year"] == strval($i)){ echo 'selected="selected"'; } ?>><?= $i ?>學年度</option>
<? } ?>
</select>
<table id="list" border="0" cellspacing="2" cellpadding="2" width="100%">
  <tr align="center">
    <th><a href="./outtake.php?year=<?= $_GET["year"] ?>&order=Type&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">分類</a></th>
    <th><a href="./outtake.php?year=<?= $_GET["year"] ?>&order=DateAction&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">活動時間</a></th>
    <th><a href="./outtake.php?oyear=<?= $_GET["year"] ?>&rder=Title&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">名稱</a></th>
  </tr>
<?
$result = mysql_query("select * from setup_type");
while($row = mysql_fetch_object($result))
  $type["$row->OID"] = $row->Title;

$result = mysql_query("select * from setup_type2");
while($row = mysql_fetch_object($result))
  $type2["$row->OID"] = $row->Title;

$result = mysql_query("select * from activity where DateFinish<'$now' and ((year(DateAction)=$year and month(DateAction)>=9) or (year(DateAction)=$year+1 and month(DateAction)<=6)) order by $order $queue");
while($row = mysql_fetch_object($result)){
?>
  <tr>
    <td nowrap="nowrap"><?= $type[$row->Type] ?></td>
    <td nowrap="nowrap"><?= substr($row->DateAction, 0, 16) ?></td>
    <td><?= $row->Type2 == "" ? "" : "[".$type2[$row->Type2]."]<br />" ?><a href="./activity_info.php?OID=<?= $row->OID ?>"><?= $row->Title ?></a></td>
  </tr>
<? } ?>
</table>
</form>
<? require("template_bottom.php"); ?>