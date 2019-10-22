<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<form method="POST" action="update_type.php" enctype="multipart/form-data">
<h1>類別管理</h1>
<table align="center" width="10%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th align="center">名稱</th>
  </tr>
  <tr>
    <td align="center"><input type="text" name="new_title"></td>
  </tr>
</table>
<p align="center"><input type="submit" value="新增" name="submit"></p>
<hr />
<table align="center" width="70%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th align="center" nowrap="nowrap">刪除</th>
    <th align="center">名稱</th>
  </tr>
  <?
  $result = mysql_query("select * from setup_type");
  while($row = mysql_fetch_object($result))
  {
  ?>
  <tr>
    <td align="center"><input name="del_<?= $row->OID ?>" type="checkbox"></td>
    <td align="center"><input type="text" size="50" name="title_<?= $row->OID ?>" value="<?= $row->Title ?>" /></td>
  </tr>
  <?
  }
  ?>
</table>
<p align="center"><input type="submit" value="修改" name="submit"></p>
</form>
<? require("template_bottom.php"); ?>