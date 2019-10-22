<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_login.php");
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<h1>活動搜尋</h1>
<form method="POST" action="admin_list.php" enctype="multipart/form-data">
<table id="list" border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr align="center">
    <th>年份</th>
    <th>月份</th>
    <th>類別</th>
    <th>細目別</th>
    <th>名稱</th>
  </tr>
  <tr align="center">
    <td>
      <select name="Year">
        <option value=""></option>
        <?
        $now = date("Y-m-d H:i:s");
        $result = mysql_query("SELECT max(`DateAction`) Max,min(`DateAction`) Min FROM `activity`");
        $row = mysql_fetch_object($result);
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
        $result = mysql_query("select * from setup_type");
        while($row = mysql_fetch_object($result)){
        ?>
        <option value="<?= $row->OID ?>" <? if($row->OID == $_POST["Type"]) echo 'selected="selected"'; ?>><?= $row->Title ?></option>
        <? } ?>
      </select>
    </td>
    <td>
      <select name="Type2">
        <option value=""></option>
        <?
        $result = mysql_query("select * from setup_type2");
        while($row = mysql_fetch_object($result)){
        ?>
        <option value="<?= $row->OID ?>" <? if($row->OID == $_POST["Type2"]) echo 'selected="selected"'; ?>><?= $row->Title ?></option>
        <? } ?>
      </select>
    </td>
    <td><input type="text" name="Title" size="20" value="<?= $_POST["Title"] ?>" /></td>
  </tr>
</table>
<p align="center"><input type="submit" name="submit" value="搜尋" /></p>
</form>
<form method="POST" action="update_admin_list.php" enctype="multipart/form-data">
<p><font color="#FF0000">點選<u>名稱</u>進行編輯。灰底項目為已結束活動</font></p>
<table id="list" border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr align="center">
    <th>刪除</th>
    <th>活動時間</th>
    <th>名稱</th>
    <th>報名清單</th>
    <th>參加清單</th>
  </tr>
  <?
  $result = mysql_query("select * from setup_type");
  while($row = mysql_fetch_object($result))
    $type["$row->OID"] = $row->Title;
    
  $result = mysql_query("select * from setup_type2");
  while($row = mysql_fetch_object($result))
    $type2["$row->OID"] = $row->Title;
    
  $condition = "";
  if($_POST["Year"] != "")
    $condition = $condition."and year(DateAction)='".$_POST["Year"]."'";
  if($_POST["Month"] != "")
    $condition = $condition."and month(DateAction)='".$_POST["Month"]."'";
  if($_POST["Type"] != "")
    $condition = $condition."and Type='".$_POST["Type"]."'";
  if($_POST["Type2"] != "")
    $condition = $condition."and Type2='".$_POST["Type2"]."'";
  if($_POST["Title"] != "")
    $condition = $condition."and Title like '%".$_POST["Title"]."%'";
  $condition = $condition == "" ? "" : "where ".substr($condition, 3);
    
  $result = mysql_query("select * from activity $condition order by DateAction DESC");
  while($row = mysql_fetch_object($result))
  {
		// 全活動允許or指定活動or該帳號建立的活動
		$Edit = explode(",", $_SESSION["Activity_Edit"]);
		$Signup = explode(",", $_SESSION["Activity_Signup"]);
		$Attend_rw = explode(",", $_SESSION["Activity_Attend_rw"]);
		$Attend_r = explode(",", $_SESSION["Activity_Attend_r"]);
		
		$canEdit = in_array("0", $Edit) || in_array($row->OID, $Edit) || (in_array("-2", $Edit) && $row->PostBy == $_SESSION["Activity_ID"]);
		$canSignupList = in_array("0", $Signup) || in_array($row->OID, $Signup) || (in_array("-2", $Signup) && $row->PostBy == $_SESSION["Activity_ID"]);
		$canAttendList = in_array("0", $Attend_rw) || in_array($row->OID, $Attend_rw) || (in_array("-2", $Attend_rw) && $row->PostBy == $_SESSION["Activity_ID"]);
		$canAttendList_r = in_array("0", $Attend_r) || in_array($row->OID, $Attend_r) || (in_array("-2", $Attend_r) && $row->PostBy == $_SESSION["Activity_ID"]);
		if($canEdit || $canSignupList || $canAttendList || $canAttendList_r)
		{
  ?>
  <tr <? if($row->DateAction < $now) { echo 'bgcolor="#E0E0E0"'; } ?>>
    <td align="center"><input name="del_<?= $row->OID ?>" type="checkbox"></td>
    <td nowrap="nowrap"><?= substr($row->DateAction, 0, 16) ?></td>
    <td>[<?= $type[$row->Type] ?><?= $row->Type2 == "" ? "" : "_".$type2[$row->Type2] ?>]<br />
    <? if($canEdit) { ?><a href="./admin_edit.php?OID=<?= $row->OID ?>"><?= $row->Title ?></a><? } else { ?><?= $row->Title ?><? } ?></td>
    <td align="center" nowrap="nowrap"><? if($canSignupList){ ?><a href="admin_signup_list.php?OID=<?= $row->OID ?>" target="_blank">開啟</a><? } ?></td>
    <td align="center" nowrap="nowrap"><? if($canAttendList){ ?><a href="admin_signup_attend.php?OID=<?= $row->OID ?>" target="_blank">開啟</a>
    <? } else if($canAttendList_r){ ?><a href="admin_signup_attend_readonly.php?OID=<?= $row->OID ?>" target="_blank">開啟</a><? } ?></td>
  </tr>
  <?
		}
  }
  ?>
</table>
<p align="center"><input type="submit" name="submit" value="刪除勾選項目" /></p>
</form>
<? require("template_bottom.php"); ?>