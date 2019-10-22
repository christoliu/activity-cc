<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<? 
require("sql_link.php");
$result = mysql_query("select * from activity where OID='".$_GET["OID"]."'");
$row = mysql_fetch_object($result);
require("check_signup_list.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<script type="text/javascript" src="./jquery.js"></script>
<script type="text/javascript" src="./add_deposit_time.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>國立中央大學 職涯發展中心活動系統</title>
<style type="text/css">
<!--
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

<body style="background:none">
<form method="POST" action="update_admin_signup_list.php" enctype="multipart/form-data">
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
<h1 align="center"><?= $row->Title ?><?= $row->Type2 == "" ? "" : "_".$type2[$row->Type2] ?> 報名清單</h1>
<hr />
<?
if($count > 0)
{
    // Create new PHPExcel object
	require ("./Classes/PHPExcel.php");
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
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, substr($row->DateAction, 0, 16)."~".substr($row->DateFinish, 0, 16));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, $row->Title);
?>
<input type="hidden" name="ActivityOID" value="<?= $_GET["OID"] ?>" />
<iframe width="0" height="0" name="print_frame" ></iframe>
<iframe width="0" height="0" name="signup_form" src="./admin_signup_form.php?OID=<?= $_GET["OID"] ?>" ></iframe>
<iframe width="0" height="0" name="signup_form_empty" src="./admin_signup_form_empty.php?OID=<?= $_GET["OID"] ?>"></iframe>

<table align="center" border="0" cellspacing="2" cellpadding="2" width="1000">
  <tr>
    <th width="0%" style="border-bottom: 0px;"><input type="text" name="dis" value="請輸入學號" onfocus='if(value=="請輸入學號"){value=""}' onblur='if(value==""){value="請輸入學號"}' /></th><!--$excelrow-3、$row2->StuId-->                            <!--the data will be sent back to phpself-->
    <th width="0%" style="border-bottom: 0px;"><input type="button" name="search" value="search" onclick="sear()"/></th>
    <th width="0%" style="border-bottom: 0px;"><input type="button" name="return" value="復原" onclick="ret()"/></th>
    <th width="0%" style="border-bottom: 0px;color:gray" >請以滑鼠點擊按鈕</th>
    <script>
    function sear(){
        $('#A tr').each(function(idx,ele){
        var x=$(ele).find("#B").text();
            if(x==$('input[name="dis"]').val()){
                $(ele).show();
            }else{
                $(ele).hide();
            } 
        });      
    }
    function ret(){
         $('#A tr').each(function(idx,ele){
            $(ele).show();
         });
    }
    </script>
    <th width="33%" style="border-bottom: 0px;"><a href="./export/<?= $row->OID ?>.xlsx">下載Excel</a></th>
    <th width="33%" style="border-bottom: 0px;"><a href="#" onclick="window.frames['signup_form'].focus(); window.frames['signup_form'].print();">列印簽到表</a></th>
    <th width="33%" style="border-bottom: 0px;"><a href="#" onclick="window.frames['signup_form_empty'].focus(); window.frames['signup_form_empty'].print();">列印空白簽到表</a></th>
  </tr>
</table>
<table id="A" align="center" border="0" cellspacing="2" cellpadding="5" width="80%" style="font-size:13px">
    <tr>
        <th align="center" nowrap="nowrap">刪除</th>
        <th width="30%" align="center" nowrap="nowrap">報名時間</th>
        <?
        $excel_row = 3;  
            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "序號");
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(7);
            ?><th width="10%" align="center" nowrap="nowrap">序號</th><!--我加的-->
        <?
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
            if($row->NeedGender == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "性別");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(7);
            ?><th width="10%" align="center" nowrap="nowrap">性別</th><? } ?>
        <?
            if($row->NeedDept == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "身分別");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(15);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "系所");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(30);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "年級/職稱");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(15);
            ?>
        <th width="10%" align="center" nowrap="nowrap">身分別</th>
        <th width="10%" align="center" nowrap="nowrap">系所</th>
        <th width="10%" align="center" nowrap="nowrap">年級/職稱</th>
            <? } ?>
        <?
        if($row->NeedDeposit > 0){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "保證金");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(8);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "保證金繳交時間");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(15);
            ?><th width="10%" align="center" nowrap="nowrap">保證金</th>
              <th width="10%" align="center" nowrap="nowrap">保證金繳交時間</th><? } ?>
        <?
        if($row->NeedID == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "身分證字號");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
            ?><th width="10%" align="center" nowrap="nowrap">身分證字號</th><? } ?>
        <?
        if($row->NeedBirth == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "出生日期");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
            ?><th width="10%" align="center" nowrap="nowrap">出生日期</th><? } ?>
        <?
        if($row->NeedPhone == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "電話");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
            ?><th width="10%" align="center" nowrap="nowrap">電話</th><? } ?>
        <?
        if($row->NeedMail == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "信箱");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
            ?><th width="10%" align="center" nowrap="nowrap">信箱</th><? } ?>
        <?
        if($row->NeedDiet == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "飲食");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(5);
            ?><th width="10%" align="center" nowrap="nowrap">飲食</th><? } ?>
        <?
        if($row->NeedContact == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "聯絡人");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
            ?><th width="10%" align="center" nowrap="nowrap">聯絡人</th><? } ?>
        <?
        if($row->NeedContactRelation == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "聯絡人關係");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
            ?><th width="10%" align="center" nowrap="nowrap">聯絡人關係</th><? } ?>
        <?
        if($row->NeedContactPhone == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "聯絡人電話");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
            ?><th width="10%" align="center" nowrap="nowrap">聯絡人電話</th><? } ?>
        <?
        if($row->NeedUpload > 0){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "上傳檔案");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
            ?><th width="10%" align="center" nowrap="nowrap">上傳檔案</th><? } ?>
        <?
        if($row->NeedRemark > 0){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, "其他");
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
            ?><th width="10%" align="center" nowrap="nowrap">其他</th><? } ?>
    </tr>
    <tr>                                                                                                    
        <td align="center" nowrap="nowrap" colspan="3">[姓名]填入資料即新增，可有空白欄位</td>
        <?
            if($row->NeedStuID == 1){
            ?><td width="20%" align="center" nowrap="nowrap"><input type="text" name="StuID_new" size="8" /></td><? } ?>
        <?
        if($row->NeedName == 1){
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="Name_new" size="6" /></td><? } ?>
        <?
        if($row->NeedGender == 1){
            ?>
        <td width="10%" align="center" nowrap="nowrap">
          <select name="Gender_new">
          <option value="1">男</option>
          <option value="0">女</option>
          </select>
        </td>
            <? } ?>
        <?
        if($row->NeedDept == 1){
            ?>
        <td width="40%" nowrap="nowrap">
          <select name="Title1_new">
            <option value="學生">學生</option>
            <option value="" disabled="disabled">以下為職員用</option>
            <?
            $result_option = mysql_query("select * from ncu_academic.setup_academic");
            while($row_option = mysql_fetch_object($result_option))
                echo '<option value="'.$row_option->Title.'">'.$row_option->Title.'</option>';
            ?>
          </select>
        </td>
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
        <td width="40%" nowrap="nowrap"><input type="text" name="Title3_new" size="6" /></td>
            <? } ?>
        <?
        if($row->NeedDeposit == 1){
            ?><td width="40%" align="center" nowrap="nowrap"><input type="checkbox" name="Deposit_new" /></td>
            <td width="40%" align="center" nowrap="nowrap"><input type="hidden" name="DepositTime_new" /><span id="DepositTime_new"></span></td><? } ?>
        <?
        if($row->NeedID == 1){
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="ID_new" size="10" /></td><? } ?>
        <?
        if($row->NeedBirth == 1){
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="Birth_new" size="10" /></td><? } ?>
        <?
        if($row->NeedPhone == 1){
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="Phone_new" size="10" /></td><? } ?>
        <?
        if($row->NeedMail == 1){
            ?><td width="40%" nowrap="nowrap"><input type="text" name="Mail_new" /></td><? } ?>
        <?
        if($row->NeedDiet == 1){
            ?><td width="40%" nowrap="nowrap"><input type="text" name="Diet_new" size="2" /></td><? } ?>
        <?
        if($row->NeedContact == 1){
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="Contact_new" size="8" /></td><? } ?>
        <?
        if($row->NeedContactRelation == 1){
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="ContactRelation_new" size="4" /></td><? } ?>
        <?
        if($row->NeedContactPhone == 1){
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="ContactPhone_new" size="10" /></td><? } ?>
        <?
        if($row->NeedUpload > 0){
            ?><td width="40%" align="center" nowrap="nowrap"><input type="file" name="Upload_new"></td><? } ?>
        <?
        if($row->NeedRemark > 0){
            ?><td width="40%" align="center" nowrap="nowrap"><textarea name="Remark_new" rows="3" cols="30"></textarea></td><? } ?>
    </tr>
    <?
    $excel_row++;
    $result2 = mysql_query("select att.*, a.PostTime, a.OID as AOID, a.Deposit, a.DepositTime, a.Upload, a.Onsite, a.Remark from attendant att, activity_signup a where att.OID=a.Attendant_OID and a.Activity_OID='".$_GET["OID"]."' order by a.PostTime");

    while($row2 = mysql_fetch_object($result2))
    {
        $col = 0;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, ($excel_row-3));
    ?>
    <tr>                                                                                        
        <td align="center" nowrap="nowrap">
        <input type="hidden" name="AttendantOID_<?= $row2->OID ?>" value="<?= $row2->OID ?>" />
        <input type="hidden" name="SignupOID_<?= $row2->AOID ?>" value="<?= $row2->AOID ?>" />
        <input name="del_<?= $row2->AOID ?>" type="checkbox">
        </td>
        <td width="30%" align="center" nowrap="nowrap"><?= $row2->PostTime ?></td>
        <td width="30%" align="center" nowrap="nowrap"><?= ($excel_row-3) ?></td>
        <?
            if($row->NeedStuID == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->StuID, PHPExcel_Cell_DataType::TYPE_STRING);
            ?><td id="B" width="20%" align="center" nowrap="nowrap"><?= $row2->StuID ?></td><? } ?>
        <?
        if($row->NeedName == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Name);
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="Name_<?= $row2->OID ?>" size="6" value="<?= $row2->Name ?>" /></td><? } ?>
        <?
        if($row->NeedGender == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Gender == 1 ? "男" : "女");
            ?><td width="10%" align="center" nowrap="nowrap">
          <select name="Gender_<?= $row2->OID ?>">
          <option value="" <?= $row2->Gender == "" ? 'selected="selected"' : "" ?>></option>
          <option value="1" <?= $row2->Gender == '1' ? 'selected="selected"' : "" ?>>男</option>
          <option value="0" <?= $row2->Gender == '0' ? 'selected="selected"' : "" ?>>女</option>
          </select>
                </td>
            <? } ?>
        <?
        if($row->NeedDept == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Title1);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Title2);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Title3);
            ?>
        <td width="40%" nowrap="nowrap">
          <select name="Title1_<?= $row2->OID ?>">
            <option value="學生" <?= $row2->Title1 == "學生" ? 'selected="selected"' : "" ?>>學生</option>
            <option value="" disabled="disabled">以下為職員用</option>
            <?
            $result_option = mysql_query("select * from ncu_academic.setup_academic");
            while($row_option = mysql_fetch_object($result_option))
              echo '<option value="'.$row_option->Title.'" '.($row_option->Title == $row2->Title1 ? 'selected="selected"' : "").'>'.$row_option->Title.'</option>';
            ?>
          </select>
        </td>
        <td width="40%" nowrap="nowrap">
          <select name="Title2_<?= $row2->OID ?>">
            <option value=""></option>
            <?
            $result_option = mysql_query("select * from ncu_academic.setup_dept");
            while($row_option = mysql_fetch_object($result_option))
              echo '<option value="'.$row_option->Title.'" '.($row_option->Title == $row2->Title2 ? 'selected="selected"' : "").'>'.$row_option->Title.'</option>';
            ?>
          </select>
        </td>
        <td width="40%" nowrap="nowrap"><input type="text" name="Title3_<?= $row2->OID ?>" size="6" value="<?= $row2->Title3 ?>" /></td>
            <? } ?>
        <?
        if($row->NeedDeposit > 0){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->Deposit ? "是" : "否", PHPExcel_Cell_DataType::TYPE_STRING);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->DepositTime);
            ?>
            <td width="40%" align="center" nowrap="nowrap"><input type="checkbox" name="Deposit_<?= $row2->AOID ?>" <?= $row2->Deposit ? 'checked="checked"' : "" ?> /></td>
              <td width="40%" align="center" nowrap="nowrap"><input type="hidden" name="DepositTime_<?= $row2->AOID?>" value="<?=$row2->DepositTime?>"><span id="DepositTime_<?= $row2->AOID ?>"><?=$row2->DepositTime?></span></td><? } ?>
        <?
        if($row->NeedID == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->ID);
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="ID_<?= $row2->OID ?>" size="10" value="<?= $row2->ID ?>" /></td><? } ?>
        <?
        if($row->NeedBirth == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Birth);
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="Birth_<?= $row2->OID ?>" size="10" value="<?= $row2->Birth ?>" /></td><? } ?>
        <?
        if($row->NeedPhone == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->Phone, PHPExcel_Cell_DataType::TYPE_STRING);
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="Phone_<?= $row2->OID ?>" size="10" value="<?= $row2->Phone ?>" /></td><? } ?>
        <?
        if($row->NeedMail == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->Mail, PHPExcel_Cell_DataType::TYPE_STRING);
            ?><td width="40%" nowrap="nowrap"><input type="text" name="Mail_<?= $row2->OID ?>" value="<?= $row2->Mail ?>" /></td><? } ?>
        <?
        if($row->NeedDiet == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Diet);
            ?><td width="40%" nowrap="nowrap"><input type="text" name="Diet_<?= $row2->OID ?>" size="2" value="<?= $row2->Diet ?>" /></td><? } ?>
        <?
        if($row->NeedContact == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->Contact);
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="Contact_<?= $row2->OID ?>" size="8" value="<?= $row2->Contact ?>" /></td><? } ?>
        <?
        if($row->NeedContactRelation == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $excel_row, $row2->ContactRelation);
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="ContactRelation_<?= $row2->OID ?>" size="4" value="<?= $row2->ContactRelation ?>" /></td><? } ?>
        <?
        if($row->NeedContactPhone == 1){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->ContactPhone, PHPExcel_Cell_DataType::TYPE_STRING);
            ?><td width="40%" align="center" nowrap="nowrap"><input type="text" name="ContactPhone_<?= $row2->OID ?>" size="10" value="<?= $row2->ContactPhone ?>" /></td><? } ?>
        <?
        if($row->NeedUpload > 0){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->Upload, PHPExcel_Cell_DataType::TYPE_STRING);
            ?><td width="40%" align="center" nowrap="nowrap"><a href="./uploads/attendants/<?= $row2->Upload ?>" target="_blank"><?= $row2->Upload ?></a></td><? } ?>
        <?
        if($row->NeedRemark > 0){
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $excel_row, $row2->Remark, PHPExcel_Cell_DataType::TYPE_STRING);
            ?><td width="40%" align="center" nowrap="nowrap"><textarea name="Remark_<?= $row2->AOID ?>" rows="3" cols="30"><?= $row2->Remark ?></textarea></td><? } ?>
    </tr>
    <?
        $excel_row++;
    }
	$objPHPExcel->getActiveSheet()->setTitle("報名清單");
    $objPHPExcel->setActiveSheetIndex(0);
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	header('Content-Type: application/xlsx');
	header("Content-Disposition: attachment;");
	header('Cache-Control: max-age=0');
    $objWriter->save("./export/".$row->OID.".xlsx");
	
    ?>
</table>

<p align="center"><input type="submit" name="submit" value="修改" /></p>
<?  

}
else
  echo "目前無人報名。";
?>
</form>
</body>

</html>