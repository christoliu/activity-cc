<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<form method="POST" action="update_admin_dept.php" enctype="multipart/form-data">
<h1>系所管理</h1>
<table align="center" width="50%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th align="center">名稱</th>
    <th align="center">院別</th>
    <th align="center">簡稱</th>
  </tr>
  <tr>
    <th align="center"><input type="text" size="40" name="Title_new"></th>
    <th align="center">
    <select name="AcademicOID_new">
    <option value="0"></option>
    <?
    $result_academic = mysql_query("SELECT * FROM ncu_academic.setup_academic");
    while($row_academic = mysql_fetch_object($result_academic)){
    ?>
    <option value="<?= $row_academic->OID ?>"><?= $row_academic->Title ?></option>
    <? } ?>
    </select></th>
    <th align="center"><input type="text" size="6" name="Abbreviation_new"></th>
    <td align="center"><input type="submit" value="新增" name="submit"></td>
  </tr>
</table>
<hr />
<table align="center" width="70%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th align="center" nowrap="nowrap">刪除</th>
    <th align="center">名稱</th>
    <th align="center">院別</th>
    <th align="center">簡稱</th>
  </tr>
  <?
  $result = mysql_query("select * from ncu_academic.setup_dept");
  while($row = mysql_fetch_object($result)){
  ?>
  <tr>
    <td align="center"><input name="del_<?= $row->OID ?>" type="checkbox"></td>
    <td align="center"><input type="text" size="40" name="Title_<?= $row->OID ?>" value="<?= $row->Title ?>" /></td>
    <th align="center">
    <select name="AcademicOID_<?= $row->OID ?>">
    <option value="0"></option>
    <?
    $result_academic = mysql_query("SELECT * FROM ncu_academic.setup_academic");
    while($row_academic = mysql_fetch_object($result_academic)){
    ?>
    <option value="<?= $row_academic->OID ?>" <? if($row->AcademicOID == $row_academic->OID){ echo 'selected="selected"'; } ?>><?= $row_academic->Title ?></option>
    <? } ?>
    </select></th>
    <td align="center"><input type="text" size="6" name="Abbreviation_<?= $row->OID ?>" value="<?= $row->Abbreviation ?>" /></td>
  </tr>
  <? } ?>
</table>
<p align="center"><input type="submit" value="修改" name="submit"></p>
</form>
<? require("template_bottom.php"); ?>