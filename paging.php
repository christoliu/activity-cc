<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require_once("url_params.php");

function do_SQL()
{
	global $SQL, $count, $rowsPerPage, $result;
	$result = mysql_query("select count(*) as count from ($SQL) t");
	$row = mysql_fetch_object($result);
	$count = $row->count;
	$page = $_GET["page"] == "" ? 1 : $_GET["page"];
	$result = mysql_query($SQL." limit ".strval(($page - 1) * $rowsPerPage).", $rowsPerPage");
}

function do_paging()
{
	global $count, $rowsPerPage;
	$page = $_GET["page"] == "" ? 1 : $_GET["page"];
	for($i = 1; $count > 0; $i++)
	{
		echo $page == $i ? $i." " : '<a href="?'.url_params_set("page", $i, 0).'">'.$i.'</a> ';
		$count -= $rowsPerPage;
	}
}
?>