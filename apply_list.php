<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_login.php");
require("db.php");
?>

<? require("template_head.php"); ?>
<h1>活動搜尋</h1>
<form method="POST" action="apply_list.php" enctype="multipart/form-data">
<table id="list" border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr align="left">
    <th>年份</th>
    <th>月份</th>
    <th>類別</th>
    <th>細目別</th>
    <th>名稱</th>
    <th>狀態</th>
  </tr>
  <tr align="left">
    <td>
      <select name="Year">
        <option value=""></option>
        <?
        $now = date("Y-m-d");
        $result = mysqli_query($conn,"SELECT max(`reg_date`) Max,min(`reg_date`) Min FROM `activity_apply`");
        $row = mysqli_fetch_object($result);
        for($i = intval(substr($row->Max, 0, 4)); $i >= intval(substr($row->Min, 0, 4)); $i--){
        ?>
        <option value="<?= $i ?>" <? if($i == $_POST["Year"]) echo 'selected="selected"'; ?>><?= $i ?></option>
        <? } ?>
      </select>
    </td>
    <td>
      <select name="Month">
        <option value=""></option>
        <?
        for($i = 1; $i <= 12; $i++){
        ?>
        <option value="<?= $i ?>" <? if($i == $_POST["Month"]) echo 'selected="selected"'; ?>><?= $i ?></option>
        <? } ?>
      </select></td>
    <td>
      <select name="Type">
        <option value=""></option>
        <?
        $result = mysqli_query($conn,"select * from setup_type");
        while($row = mysqli_fetch_object($result)){
        ?>
        <option value="<?= $row->OID ?>" <? if($row->OID == $_POST["Type"]) echo 'selected="selected"'; ?>><?= $row->Title ?></option>
        <? } ?>
      </select>
    </td>
    <td>
      <select name="Type2">
        <option value=""></option>
        <?
        $result = mysqli_query($conn,"select * from setup_type2");
        while($row = mysqli_fetch_object($result)){
        ?>
        <option value="<?= $row->OID ?>" <? if($row->OID == $_POST["Type2"]) echo 'selected="selected"'; ?>><?= $row->Title ?></option>
        <? } ?>
      </select>
    </td>
    <td><input type="text" name="Title" size="16" value="<?= $_POST["Title"] ?>" /></td>
    <td>
      <select name="Result">
        <option value=""></option>    
        <option value="0">待審核</option>
        <option value="1">審核中</option>
        <option value="2">審核通過</option>
        <option value="3">審核未通過</option>
      </select>
    </td>
  </tr>
</table>
<p align="center"><input type="submit" name="submit" value="搜尋" /></p>
</form>

<form method="POST" action="update_apply.php" enctype="multipart/form-data">
<!--<p><font color="#FF0000">點選<u>名稱</u>進行編輯。灰底項目為已結束活動</font></p>-->
<table id="list" border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr align="left">
    <th width="30%">申請時間</th>
    <th width="50%">名稱</th>
    <th width="20%">審核狀態</th>
  </tr>
  <?
  $result = mysqli_query($conn,"select * from setup_type");
  while($row = mysqli_fetch_object($result))
    $type["$row->OID"] = $row->Title;
    
  $result = mysqli_query($conn,"select * from setup_type2");
  while($row = mysqli_fetch_object($result))
    $type2["$row->OID"] = $row->Title;
    
  $condition = "";
  if($_POST["Year"] != "")
    $condition = $condition."and year(reg_date)='".$_POST["Year"]."'";
  if($_POST["Month"] != "")
    $condition = $condition."and month(reg_date)='".$_POST["Month"]."'";
  if($_POST["Type"] != "")
    $condition = $condition."and Type='".$_POST["Type"]."'";
  if($_POST["Type2"] != "")
    $condition = $condition."and Type2='".$_POST["Type2"]."'";
  if($_POST["activity_name"] != "")
    $condition = $condition."and activity_name like '%".$_POST["activity_name"]."%'";
  if($_POST["Result"] != "")
    $condition = 
  $condition = $condition == "" ? "" : "where ".substr($condition, 3);
    
  $result = mysqli_query($conn,"select * from activity_apply $condition order by reg_date");
  while($row = mysqli_fetch_object($result))
  {?>
  <tr align="left">
    <td width="30%" nowrap="nowrap"><?= substr($row->reg_date, 0, 16) ?></td>
    <td width="50%"> <a href="./apply_edit.php?OID=<?$row->OID?>"><?= $row->activity_name?></a></td>
    <td>
      <?if ($row->result == 0){?><a> <font color="black"><?echo "未審核";?></a><?}?>        
      <?if ($row->result == 1){?><a> <font color="orange"><?echo "審核中";?></a><?}?>
      <?if ($row->result == 2){?><a> <font color="blue"><?echo "審核通過";?></a><?}?>
      <?if ($row->result == 3){?><a> <font color="red"><?echo "審核未通過";?></a><?}?>
    </td>
  </tr>
  <?}?>
</table>
<table align="center">
  <tr>
  <input type="submit" name="submit" value="送出">
  </tr>
</table>
</form>
<? require("template_bottom.php"); ?>