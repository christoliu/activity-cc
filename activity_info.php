<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<? 
require('db.php');
$conn->set_charset("utf8");
?>

<? 
require("template_head.php"); 
$stmt = $conn->prepare("SELECT count(*) as count FROM activity_signup WHERE Activity_OID=?");
$stmt->bind_param("i", $_GET['OID']);
$stmt->execute();
//$result = $stmt->get_result();
//$row = $result->fetch_object();
$stmt->close();
?>

<?
$now = date("Y-m-d H:i:s");

$result = mysqli_query($conn,"SELECT * FROM setup_type");
while($row = mysqli_fetch_object($result))
	$type["$row->OID"] = $row->Title;
		
$result = mysqli_query($conn,"SELECT * FROM setup_type2");
while($row = mysqli_fetch_object($result))
	$type2["$row->OID"] = $row->Title;
	$type2oid["$row->OID"] = $row->OID;
	
$result = mysqli_query($conn,"SELECT * FROM setup_location");
while($row = mysqli_fetch_object($result))
{
	$location["$row->OID"] = $row->Title;
	$size["$row->OID"] = $row->Size;
}

$result = mysqli_query($conn,"SELECT count(*) as count FROM activity_signup WHERE Activity_OID='".$_GET['OID']."'");
$row = mysqli_fetch_object($result);
$count = $row->count;

$stmt = $conn->prepare("SELECT * FROM activity WHERE OID=?");
$stmt->bind_param('i', $_GET['OID']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_object();

if(($row->Type2 == 12) && ($row->DateFinish < $now))
{
	echo "<script type='text/javascript'>alert('此問卷已過期');location.href='index.php';</script>";	
}
?>

<h1><?= $row->Title ?></h1>
<table border="0" cellspacing="2" cellpadding="2" width="100%">
  <tr align="center">
    <img src="./img/<?= $row->Type ?>.jpg" width="100%">
  </tr>
</table>
<table border="0" cellspacing="2" cellpadding="2" width="100%">
  <tr>
    <td colspan="2" align="right">
      <?
      //報名連結顯示與否
      if($now < $row->DateEnd)
      {
        if(intval($count) < intval($row->PersonLimit == -1 ? $size[$row->Location] : $row->PersonLimit) && $row->DateEnd >= $now && $row->DateStart <= $now)
          echo '<a href="activity_signup.php?OID='.htmlspecialchars($_GET['OID']).'">點此報名/ Register here</a>';
        //else if($row->DateStart >= $now)
          //echo "尚未開始報名";
        else if(intval($count) >= intval($row->PersonLimit == -1 ? $size[$row->Location] : $row->PersonLimit))
          echo '<font color="#FF0000">報名額滿</font>';
      }
      //重新上傳檔案顯示與否
      if($row->NeedUpload)
        echo '<a href="activity_upload.php?OID='.htmlspecialchars($_GET['OID']).'"><br />已報名者點此重新上傳檔案</a>';
      ?>
    </td>
  </tr>
  <tr>
    <th>分類</th>
    <td align="left"><?= $type[$row->Type] ?></td>
  </tr>
  <tr>
    <th>名稱</th>
    <td align="left"><?= $row->Title ?><?= $row->Type2 == "" ? "" : "_".$type2[$row->Type2] ?></td>
  </tr>
  <tr>
    <th valign="top">內容</th>
    <td align="left" style="word-break: break-all;"><?= $row->Content ?></td>
  </tr>
  <tr>
    <th>地點</th>
    <td align="left"><?= $location[$row->Location] ?></td>
  </tr>
  <tr>
    <th>報名人數/上限</th>
    <td align="left"><?= $count ?> / <?= $row->PersonLimit == -1 ? $size[$row->Location] : $row->PersonLimit ?></td>
  </tr>
  <tr>
    <th>活動日期與時間</th>
    <td align="left"><?= substr($row->DateAction, 0, 16) ?></td>
  </tr>
  <tr>
    <th>報名截止日期</th>
    <td align="left"><?= substr($row->DateEnd, 0, 16) ?></td>
  </tr>
  <tr>
    <th>網站連結</th>
    <td align="left">
      <?
      foreach(explode("\n", $row->Link) as $url)
      {
        if(substr($url, 0, 4) == "http")
          echo '<a href="'.$url.'" target="_blank">'.$url.'</a><br>';
        else
          echo $url.'<br>';
      }
      ?>
    </td>
  </tr>
  <tr>
    <th>附件</th>
    <td align="left">
		<? if($row->Attachment != "" && $now < $row->DateEnd) {?><a href="uploads/<?= $row->Attachment ?>" target="_blank"><?= $row->Attachment ?></a><br /><?}
		else if ($row->Attachment != "" && $now > $row->DateEnd){?><a><font color="gray"><?= $row->Attachment ?></font></a><br /><?}?>
		<? if($row->Attachment2 != "" && $now < $row->DateEnd) {?><a href="uploads/<?= $row->Attachment2 ?>" target="_blank"><?= $row->Attachment2 ?></a><br /><?}
		else if ($row->Attachment != "" && $now > $row->DateEnd){?><a><font color="gray"><?= $row->Attachment ?></font></a><br /><?}?>
		<? if($row->Attachment3 != "" && $now < $row->DateEnd) {?><a href="uploads/<?= $row->Attachment3 ?>" target="_blank"><?= $row->Attachment3 ?></a><?}
		else if ($row->Attachment != "" && $now > $row->DateEnd){?><a><font color="gray"><?= $row->Attachment ?></font></a><br /><?}?></td>
  </tr>
  <?
  //花絮顯示與否
  if($now >= $row->DateAction)
  {
    ?>
  <tr>
    <th align="center" valign="top">活動花絮</th>
    <td align="left"><?= str_replace("\n", "<br>", $row->Impression) ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <? if($row->Photo_URL != ""){ foreach(explode("\n", $row->Photo_URL) as $url){ ?><img src="img_resize.php?title=<?= $url ?>&width=260&height=195"> <? }} ?></td>
  </tr>
  <tr>
    <th align="center">花絮連結</th>
    <td align="left"><? if($row->Photo != ""){ ?><a href="<?= $row->Photo ?>" target="_blank"><?= $row->Photo ?></a><? } ?></td>
  </tr>
  <? } ?>
</table>
<?
//報名清單顯示與否
if($now < $row->DateAction && $count > 0)
{
?>
<hr />
<p align="center"><b>報名清單</b></p>
<table border="0" cellspacing="3" cellpadding="2" width="100%">
  <tr>
    <th align="center">報名時間</th>
    <th align="center">學號</th>
    <th width="20%" align="left">姓名</th>
    <th align="center">報名時間</th>
    <th align="center">學號</th>
    <th width="20%" align="left">姓名</th>
  </tr>
  <?
  $result = mysqli_query($conn,"SELECT att.*, a.PostTime FROM attendant att, activity_signup a where att.OID=a.Attendant_OID and a.Activity_OID='".$_GET['OID']."' order by a.PostTime");
  $count = 0;
  while($row = mysqli_fetch_object($result))
  {
    $count++;
    echo $count % 2 == 1 ? "<tr>" : "";
  ?>
    <td align="center" nowrap="nowrap"><?= $row->PostTime ?></td>
    <td align="center" nowrap="nowrap"><?= str_pad(substr($row->StuID, 0, 3), strlen($row->StuID), "*") ?></td>
    <td align="left"><?= mb_substr($row->Name, 0, 1, "utf-8") ?><? for($i = 0; $i < mb_strlen($row->Name, "utf-8") - 1; $i++){ echo "Ｏ";} ?></td>
  <?
    echo $count % 2 == 0 ? "</tr>" : "";
  }
  ?>
</table>
<? } ?>
<? require("template_bottom.php"); ?>
