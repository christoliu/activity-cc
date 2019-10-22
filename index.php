<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<form>
	<h1><font color="red">職涯發展中心主辦之重大活動，除企業參訪、履歷面試外，其他活動都轉移到本校Portal活動報名系統。<br>網址為<a href="https://cis.ncu.edu.tw/ActivitySys/"target="_blank">https://cis.ncu.edu.tw/ActivitySys/</a></font></h1>
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
	?>    
	<?  
	//NEW
	//$result = mysql_query("select count(*) as Count from activity where `DateAction`>DATE_SUB('$now', INTERVAL 14 DAY) and DateStart<'$now' and DateEnd>'$now' order by DateAction DESC");
	$result = mysql_query("select count(*) as Count from activity where '$now'>DATE_SUB(DateAction, INTERVAL 14 DAY) and DateEnd>'$now'");
	$row = mysql_fetch_object($result);
	if($row->Count > 0)
	{?>
		<table id="list_static" border="0" cellspacing="2" cellpadding="2" width="100%" style="text-align: center;">
			<tr><p align="center" style="color:orange;"><b>NEW 近期活動</b></p></tr><?
			//$result0 = mysql_query("select * from `activity` WHERE `DateAction`>DATE_SUB('$now', INTERVAL 14 DAY) and DateStart<'$now' and DateEnd>'$now' order by DateAction ASC");
			$result0 = mysql_query("select * from `activity` WHERE '$now'>DATE_SUB(DateAction, INTERVAL 14 DAY) and DateEnd>'$now' order by DateAction ASC");
			while($row0 = mysql_fetch_object($result0))
			{?>			
				<tr>
					<td nowrap="nowrap"><?= $type[$row0->Type] ?></td>
					<td nowrap="nowrap"><?= substr($row0->DateAction, 0, 16) ?></td>
					<td style="text-align: initial;"><?= $row0->Type2 == "" ? "" : "[".$type2[$row0->Type2]."]<br />" ?><a href="./activity_info.php?OID=<?= $row0->OID ?>"><?= $row0->Title ?></a></td>				
				</tr><?
			}?>
		</table><br><?
	}
	
	//List
	$result = mysql_query("select count(*) as Count from activity where DateStart<'$now' and DateFinish>'$now' order by $order $queue");
	$row = mysql_fetch_object($result);
	if($row->Count > 0)
	{
		//Arrange List?>		
		<table id="list" border="0" cellspacing="2" cellpadding="2" width="100%" style="text-align: center;">
		<tr><p align="center" style="color:orange;"><b>All 所有活動</b></p></tr>
		<center><p><font color="#FF0000">點擊欄位名稱，例如分類、活動時間、名稱，可以排序喔!</font></p></center>
			<tr align="center">
			  <th><a href="./index.php?year=<?= $_GET["year"] ?>&order=Type&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">分類</a></th>
			  <th><a href="./index.php?year=<?= $_GET["year"] ?>&order=DateAction&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">活動時間</a></th>
			  <th><a href="./index.php?year=<?= $_GET["year"] ?>&order=Title&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">名稱</a></th>
			  <th><a href="./index.php?year=<?= $_GET["year"] ?>&order=DateEnd&queue=<?= ($_GET["queue"] == NULL || $_GET["queue"] == "DESC") ? "ASC" : "DESC" ?>">報名截止日期</a></th>
			  <th align="center"><a>報名人數</a></th>
			</tr>
		<?
			$result = mysql_query("select * from activity where DateAction>'$now' order by $order $queue");
                        //$result = mysql_query("select * from activity where DateEnd>='$now' and DateAction>'$now' order by $order $queue");

			while($row = mysql_fetch_object($result))
			{
				$result2 = mysql_query("SELECT COUNT(OID) as c FROM `activity_signup` WHERE `Activity_OID`=".$row->OID);
				$row2 = mysql_fetch_object($result2);?>
				<tr>
				  <td nowrap="nowrap"><?= $type[$row->Type] ?></td>
				  <td nowrap="nowrap"><?= substr($row->DateAction, 0, 16) ?></td>
				  <td style="text-align: initial;"><?= $row->Type2 == "" ? "" : "[".$type2[$row->Type2]."]<br />" ?><a href="./activity_info.php?OID=<?= $row->OID ?>"><?= $row->Title ?></a></td>
				  <td nowrap="nowrap"><?= substr($row->DateEnd, 0, 16) ?></td>
				  <td nowrap="nowrap"><?= (string)$row2->c ?></td>
				</tr><?
			}?>
		</table><?
	}
	else
		echo "目前無活動。";
	?>

</form>
<? require("template_bottom.php"); ?>
