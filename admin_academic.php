<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<form method="POST" action="update_admin_academic.php" enctype="multipart/form-data">
<h1>院別管理</h1>
<table align="center" width="50%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th align="center"><input type="text" size="50" name="new_title"></th>
    <td align="center"><input type="submit" value="新增" name="submit"></td>
  </tr>
</table>
<hr />
<table align="center" width="70%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th align="center" nowrap="nowrap">刪除</th>
    <th align="center">名稱</th>
  </tr>
  <?
  $result = mysql_query("select * from ncu_academic.setup_academic");
  while($row = mysql_fetch_object($result)){
  ?>
  <tr>
    <td align="center"><input name="del_<?= $row->OID ?>" type="checkbox"></td>
    <td align="center"><input type="text" size="50" name="title_<?= $row->OID ?>" value="<?= $row->Title ?>" /></td>
  </tr>
  <? } ?>
</table>
<p align="center"><input type="submit" value="修改" name="submit"></p>
</form>
<? require("template_bottom.php"); ?>