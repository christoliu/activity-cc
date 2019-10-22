<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" language="javascript">
google.load("jquery", "1.3");
//jquery全選
function CheckedAll_Edit(){
    var checkall = $('#chkAll_Edit').val();
    $('input:checkbox.edit').each(function(){
        this.checked = checkall == 0;
        this.disabled = checkall != 1;
    });
}
function CheckedAll_Signup(){
    var checkall = $('#chkAll_Signup').val();
    $('input:checkbox.signup').each(function(){
        this.checked = checkall == 0;
        this.disabled = checkall != 1;
    });
}
function CheckedAll_Attend_rw(){
    var checkall = $('#chkAll_Attend_rw').val();
    $('input:checkbox.attend_rw').each(function(){
        this.checked = checkall == 0;
        this.disabled = checkall != 1;
    });
}
function CheckedAll_Attend_r(){
    var checkall = $('#chkAll_Attend_r').val();
    $('input:checkbox.attend_r').each(function(){
        this.checked = checkall == 0;
        this.disabled = checkall != 1;
    });
}
</script>
<?
$result = mysql_query("select * from administrator where OID='".$_GET["OID"]."'");
$row = mysql_fetch_object($result);
$Edit = explode(",", $row->Activity_Edit);
$Signup = explode(",", $row->Activity_Signup);
$Attend_rw = explode(",", $row->Activity_Attend_rw);
$Attend_r = explode(",", $row->Activity_Attend_r);
?>
<h1>活動管理權限: <?= $row->Account ?> (<?= $row->Remark ?>)</h1>
<form method="POST" action="admin_account_activity.php?OID=<?= $_GET["OID"] ?>" enctype="multipart/form-data">
<table id="list" border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr align="center">
    <th>年份</th>
    <th>月份</th>
    <th>類別</th>
    <th>細目別</th>
    <th>名稱</th>
    <th></th>
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
    <td><input type="text" name="Title" size="15" value="<?= $_POST["Title"] ?>" /></td>
    <td><input type="submit" name="submit" value="搜尋" /></td>
  </tr>
</table>
</form>
<hr />
<form method="POST" action="update_admin_account_activity.php" enctype="multipart/form-data">
<input type="hidden" name="Admin_OID" value="<?= $_GET["OID"] ?>" />
<?
$result = mysql_query("select * from setup_type");
while($row = mysql_fetch_object($result))
	$type["$row->OID"] = $row->Title;
	
$result = mysql_query("select * from setup_type2");
while($row = mysql_fetch_object($result))
	$type2["$row->OID"] = $row->Title;
	
$condition = "where `Specific`='1'";
if($_POST["Year"] != "")
	$condition = $condition." and year(DateAction)='".$_POST["Year"]."'";
if($_POST["Month"] != "")
	$condition = $condition." and month(DateAction)='".$_POST["Month"]."'";
if($_POST["Type"] != "")
	$condition = $condition." and Type='".$_POST["Type"]."'";
if($_POST["Type2"] != "")
	$condition = $condition." and Type2='".$_POST["Type2"]."'";
if($_POST["Title"] != "")
	$condition = $condition." and Title like '%".$_POST["Title"]."%'";
?>
<p align="center"><input type="submit" name="submit" value="修改" /></p>
<? if($condition != "") {?><p align="right"><font color="#FF0000">※即便有搜尋條件，首列設定若為[允許/禁止/自創]，都是針對系統內全部活動。</font></p><? } ?>
<table id="list" border="0" cellspacing="1" cellpadding="2" width="100%">
  <tr align="center">
    <th>活動時間</th>
    <th>名稱</th>
    <th>管理<br />活動<br />
      <select name="Edit" id="chkAll_Edit" onchange="CheckedAll_Edit()">
        <option value="1">指定</option>
        <option value="0" <?= in_array("0", $Edit) ? 'selected="selected"' : "" ?>>允許</option>
        <option value="-1" <?= in_array("-1", $Edit) ? 'selected="selected"' : "" ?>>禁止</option>
        <option value="-2" <?= in_array("-2", $Edit) ? 'selected="selected"' : "" ?>>自創</option>
      </select>
    </th>
    <th>編輯<br />報名<br />
      <select name="Signup" id="chkAll_Signup" onchange="CheckedAll_Signup()">
        <option value="1">指定</option>
        <option value="0" <?= in_array("0", $Signup) ? 'selected="selected"' : "" ?>>允許</option>
        <option value="-1" <?= in_array("-1", $Signup) ? 'selected="selected"' : "" ?>>禁止</option>
        <option value="-2" <?= in_array("-2", $Signup) ? 'selected="selected"' : "" ?>>自創</option>
      </select>
    </th>
    <th>編輯<br />參加<br />
      <select name="Attend_rw" id="chkAll_Attend_rw" onchange="CheckedAll_Attend_rw()">
        <option value="1">指定</option>
        <option value="0" <?= in_array("0", $Attend_rw) ? 'selected="selected"' : "" ?>>允許</option>
        <option value="-1" <?= in_array("-1", $Attend_rw) ? 'selected="selected"' : "" ?>>禁止</option>
        <option value="-2" <?= in_array("-2", $Attend_rw) ? 'selected="selected"' : "" ?>>自創</option>
      </select>
    </th>
    <th>瀏覽<br />參加<br />
      <select name="Attend_r" id="chkAll_Attend_r" onchange="CheckedAll_Attend_r()">
        <option value="1">指定</option>
        <option value="0" <?= in_array("0", $Attend_r) ? 'selected="selected"' : "" ?>>允許</option>
        <option value="-1" <?= in_array("-1", $Attend_r) ? 'selected="selected"' : "" ?>>禁止</option>
        <option value="-2" <?= in_array("-2", $Attend_r) ? 'selected="selected"' : "" ?>>自創</option>
      </select>
    </th>
  </tr>
  <?
	$count = 0;
  $result = mysql_query("select * from activity $condition order by DateAction DESC");
  while($row = mysql_fetch_object($result))
  {
		$count++;
  ?>
  <tr <? if($count % 2 == 0) { echo 'bgcolor="#FFFFCC"'; } ?>>
    <td rowspan="2" nowrap="nowrap"><font size="-6"><?= substr($row->DateAction, 0, 16) ?></font></td>
    <td style="border-bottom:none"><font size="-6">[<?= $type[$row->Type] ?><?= $row->Type2 == "" ? "" : "_".$type2[$row->Type2] ?>]</font></td>
    <td style="border-bottom:none" align="center">
      <input type="checkbox" name="Edit_<?= $row->OID ?>" class="edit" <?= in_array("0", $Edit) || in_array($row->OID, $Edit) ? 'checked="checked"' : "" ?> <?= in_array("-1", $Edit) || in_array("-2", $Edit) || in_array("0", $Edit) ? 'disabled="disabled"' : "" ?>>
    </td>
    <td style="border-bottom:none" align="center">
      <input type="checkbox" name="Signup_<?= $row->OID ?>" class="signup" <?= in_array("0", $Signup) || in_array($row->OID, $Signup) ? 'checked="checked"' : "" ?> <?= in_array("-1", $Signup) || in_array("-2", $Signup) || in_array("0", $Signup) ? 'disabled="disabled"' : "" ?>>
    </td>
    <td style="border-bottom:none" align="center">
      <input type="checkbox" name="Attend_rw_<?= $row->OID ?>" class="attend_rw" <?= in_array("0", $Attend_rw) || in_array($row->OID, $Attend_rw) ? 'checked="checked"' : "" ?> <?= in_array("-1", $Attend_rw) || in_array("-2", $Attend_rw) || in_array("0", $Attend_rw) ? 'disabled="disabled"' : "" ?>>
    </td>
    <td style="border-bottom:none" align="center">
      <input type="checkbox" name="Attend_r_<?= $row->OID ?>" class="attend_r" <?= in_array("0", $Attend_r) || in_array($row->OID, $Attend_r) ? 'checked="checked"' : "" ?> <?= in_array("-1", $Attend_r) || in_array("-2", $Attend_r) || in_array("0", $Attend_r) ? 'disabled="disabled"' : "" ?>>
    </td>
  </tr>
  <tr <? if($count % 2 == 0) { echo 'bgcolor="#FFFFCC"'; } ?>>
    <td colspan="5"><font size="-6"><?= $row->Title ?></font></td>
  </tr>
  <?
  }
  ?>
</table>
<p align="center"><input type="submit" name="submit" value="修改" /></p>
</form>
<? require("template_bottom.php"); ?>