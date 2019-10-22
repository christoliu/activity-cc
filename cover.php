<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("sql_link.php");
?>

<style>
	
	td {
		padding-top:8px;
		//vertical-align: baseline;
		margin-top:8px;
		font-size: 8pt;
		vertical-align: initial;
		text-align: left;
	}
	li {
		margin-left:-30px;
		color:#777;
	}
	h4 {
		color: #777;
		
	}
	ul {
		margin-left:-30px;
	}
	.pic {
		font-size:12pt;
		margin-left:5pt;
	}
	tr {
		//margin-bottom: 19px;
	}
	.list {
		font-size:12pt;
	}
	a {
		text-decoration:none;
		
	}
	a:hover {
		text-decoration:underline;
	}
</style>

<script>
	$(document).ready(function(){
		$("#src").hide();

		if (parseInt($("#num").html())>4){
			$("#src").show();
		}
	})

</script>

<? require("template_head.php"); ?>
<form>
	<h1>活動報名</h1>
	<a>您可點選點選活動標題，即前往該活動的報名網頁</a>
	<?
	$now = date("Y-m-d H:i:s");

	function actcount($type, $show){
		$result = mysql_query("select count(*) as Count from activity where DateAction>'".date("Y-m-d H:i:s")." 'and Type=".$type." order by DateAction");
		$row = mysql_fetch_object($result);
		$counter = $row->Count;
		if ($show == 1){
			echo $counter;
		}
		else{
			return $counter;
		}
	}

	function dump($type){
		$now = date("Y-m-d H:i:s");
		$result = mysql_query("select OID, Title, DateAction from activity where DateAction>'".date("Y-m-d H:i:s")."' and Type=".$type." order by DateAction ASC LIMIT 4");
		while($row = mysql_fetch_object($result)){
			$actdate = explode(' ',$row->DateAction);
			echo "<li style='margin-left:-2px; padding:3pt; list-style-type:none; width:35em; white-space: nowrap; text-overflow:ellipsis; overflow: hidden;'><a style='color:#777; cursor:pointer;' href='./activity_info.php?OID=".$row->OID."'>".$actdate[0]."&nbsp;&nbsp;".$row->Title."</a></li>";
		}
	}
	?>
	<table>
		<?
		$t = [];
		$c = 0;
		$result2 = mysql_query("select * from setup_type");
		while($row2 = mysql_fetch_object($result2)){
			$t[$c] = $row2->Title;
			$c = $c + 1;
		}
		$pic = array("lecture1","visit2","others","others","others","others","others","others","others","others","workshop11","others","others","others","consult15");
		
		for ($i=1;$i<=15;$i++){
			if (actcount($i, 0) != 0){
				?>
				<div name='type<?echo $i;?>' class='block'>
					<tr style='background:#EEE;'>
						<td width='20%'>
							<h4 class='pic'><?echo $t[$i];?></h4>
							<img src='./img/<?echo $pic[$i-1];?>.png' width='100%'>
						</td>
						<td>
							<ul>
								<h4 class='list'>目前開放報名有<? actcount($i, 1); ?>場</h4>
							</ul>
							<ul>
							<?	
								dump($i);
							?>
							</ul>
							<ul>
								<?
								if (actcount($i, 0)>4){
									?><a id='sr' href='./sub_activity_list.php?type=<?echo $i;?>'>...more</a><?
								}
								?>
							</ul>
						</td>
					</tr>
				</div><?
			}			
		}
		?>
	</table>
</form>
<? require("template_bottom.php"); ?>