<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<? 
require("sql_link.php");
$result = mysql_query("select * from activity where OID='".$_GET["OID"]."'");
$row = mysql_fetch_object($result);
require("check_attend_list.php");
?>

<? require("template_head.php"); ?>
<form method="POST" action="update_admin_signup_attend.php" enctype="multipart/form-data">
<?
$now = date("Y-m-d");

$result = mysql_query("select * from setup_type");
while($row = mysql_fetch_object($result))
  $type["$row->OID"] = $row->Title;
  
$result = mysql_query("select * from setup_type2");
while($row = mysql_fetch_object($result))
  $type2["$row->OID"] = $row->Title;
  
$result = mysql_query("select count(*) as count from activity_signup where Activity_OID=".$_GET["OID"]);
$row = mysql_fetch_object($result);
$count = $row->count;

$result = mysql_query("select * from activity where OID=".$_GET["OID"]);
$row = mysql_fetch_object($result);
?>
<h1><?= $row->Title ?><?= $row->Type2 == "" ? "" : "_".$type2[$row->Type2] ?> 參加清單</h1>
<hr />
<p align="right">按下<font color="#FF0000">Ctrl+F</font>可輸入關鍵字進行搜尋</p>
<?
if($count > 0)
{
	// Create new PHPExcel object
  require ("Classes/PHPExcel.php");
	$objPHPExcel = new PHPExcel();
		
	// Set properties
	$objPHPExcel->getProperties()->setCreator("國立中央大學職涯發展中心");
	$objPHPExcel->getProperties()->setLastModifiedBy("國立中央大學職涯發展中心");
	$objPHPExcel->getProperties()->setTitle($row->Title."活動報名清單");
	$objPHPExcel->getProperties()->setSubject("");
	$objPHPExcel->getProperties()->setDescription("");
	$objPHPExcel->getProperties()->setKeywords("");
	$objPHPExcel->getProperties()->setCategory("");
	
	// Add some data
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, $row->Title);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, substr($row->DateAction, 0, 16)."~".substr($row->DateFinish, 0, 16));
?>
<input type="hidden" name="ActivityOID" value="<?= $_GET["OID"] ?>" />
<table align="center" border="0" cellspacing="2" cellpadding="2" width="500">
  <tr>
    <th width="33%" style="border-bottom: 0px;"><a href="./export/<?= $row->OID ?>_attend.xlsx">下載Excel</a></th>
  </tr>
</table>
<table align="center" border="0" cellspacing="2" cellpadding="2" width="100%" style="font-size:13px">
  <tr>
    <th align="center" nowrap="nowrap">報到</th>
    <?
  	$excel_row = 3;
		$col = 0;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "序號");
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(7);
		$col++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "報到");
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(7);
		if($row->NeedStuID == 1){
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "學號");
    	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
		?><th width="20%" align="center" nowrap="nowrap">學號</th><? } ?>
    <?
		if($row->NeedName == 1){
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "姓名");
    	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
		?><th width="40%" align="center" nowrap="nowrap">姓名</th><? } ?>
    <?
    if($row->NeedDept == 1){
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "身分別");
    	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(15);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "系所");
    	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(30);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "年級");
    	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(15);
		?>
    <th width="10%" align="center" nowrap="nowrap">身分別</th>
    <th width="10%" align="center" nowrap="nowrap">系所</th>
    <th width="10%" align="center" nowrap="nowrap">年級</th>
		<? } ?>
  </tr>
  <tr>
    <td align="center" nowrap="nowrap">現場</td>
    <?
		if($row->NeedStuID == 1){
		?><td width="20%" align="center" nowrap="nowrap"><input type="text" name="StuID_new" size="9" /></td><? } ?>
    <?
    if($row->NeedName == 1){
		?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="Name_new" size="5" /></td><? } ?>
    <?
    if($row->NeedDept == 1){
		?>
    <td width="40%" align="center" nowrap="nowrap">學生</td>
    <td width="40%" nowrap="nowrap">
      <select name="Title2_new">
        <option value=""></option>
        <?
        $result_option = mysql_query("select * from ncu_academic.setup_dept");
        while($row_option = mysql_fetch_object($result_option))
            echo '<option value="'.$row_option->Title.'">'.$row_option->Title.'</option>';
        ?>
      </select>
    </td>
    <td width="40%" nowrap="nowrap"><input type="text" name="Title3_new" size="5" /></td>
		<? } ?>
  </tr>
<?
	$excel_row++;
	$result2 = mysql_query("select att.*, a.PostTime, a.OID as AOID, a.Upload, a.Onsite, a.Remark from attendant att, activity_signup a where att.OID=a.Attendant_OID and a.Activity_OID='".$_GET["OID"]."' and a.Onsite='1' order by a.PostTime");
	while($row2 = mysql_fetch_object($result2))
	{
		$col = 0;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, ($excel_row-3));
?>
  <tr>
    <?
		$col++;
		$objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, "現場", PHPExcel_Cell_DataType::TYPE_STRING);
		?>
    <td align="center" nowrap="nowrap">現場</td>
    <?
		if($row->NeedStuID == 1){
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->StuID, PHPExcel_Cell_DataType::TYPE_STRING);
		?><td width="20%" align="center" nowrap="nowrap"><?= $row2->StuID ?></td><? } ?>
    <?
    if($row->NeedName == 1){
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Name);
		?><td width="40%" align="center" nowrap="nowrap"><?= $row2->Name ?></td><? } ?>
    <?
    if($row->NeedDept == 1){
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Title1);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Title2);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Title3);
		?>
    <td width="40%" align="center" nowrap="nowrap"><?= $row2->Title1 ?></td>
    <td width="40%" nowrap="nowrap"><?= $row2->Title2 ?></td>
    <td width="40%" align="center" nowrap="nowrap"><?= $row2->Title3 ?></td>
		<? } ?>
  </tr>
<?
		$excel_row++;
  }
?>
  <tr>
    <td align="center" colspan="<?= $col+1 ?>">--- 以下為網路報名 ---</td>
  </tr>
<?
	$result2 = mysql_query("select att.*, a.PostTime, a.OID as AOID, a.Upload, a.Onsite, a.Absent, a.Remark from attendant att, activity_signup a where att.OID=a.Attendant_OID and a.Activity_OID='".$_GET["OID"]."' and a.Onsite is NULL order by a.PostTime");
	while($row2 = mysql_fetch_object($result2))
	{
		$col = 0;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, ($excel_row-3));
?>
  <tr>
    <?
		$col++;
		$objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->Absent ? '缺席' : '網路', PHPExcel_Cell_DataType::TYPE_STRING);
		?>
    <td align="center" nowrap="nowrap"><input type="hidden" name="AOID_<?= $row2->AOID ?>" value="<?= $row2->AOID ?>" /><input type="checkbox" name="Absent_<?= $row2->AOID ?>" <?= $row2->Absent ? '' : 'checked="checked"' ?> /></td>
    <?
		if($row->NeedStuID == 1){
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->StuID, PHPExcel_Cell_DataType::TYPE_STRING);
		?><td width="20%" align="center" nowrap="nowrap"><?= $row2->StuID ?></td><? } ?>
    <?
    if($row->NeedName == 1){
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Name);
		?><td width="40%" align="center" nowrap="nowrap"><?= $row2->Name ?></td><? } ?>
    <?
    if($row->NeedDept == 1){
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Title1);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Title2);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Title3);
		?>
    <td width="40%" align="center" nowrap="nowrap"><?= $row2->Title1 ?></td>
    <td width="40%" nowrap="nowrap"><?= $row2->Title2 ?></td>
    <td width="40%" align="center" nowrap="nowrap"><?= $row2->Title3 ?></td>
		<? } ?>
  </tr>
<?
		$excel_row++;
  }
?>
</table>
<?	
	$objPHPExcel->getActiveSheet()->setTitle("參加清單");
	$objPHPExcel->setActiveSheetIndex(0);
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save("./export/".$row->OID."_attend.xlsx");
?>
<p align="center"><input type="submit" name="submit" value="修改" /></p>
<?
}
else
  echo "目前無人報名。";
?>
</form>
<? require("template_bottom.php"); ?>