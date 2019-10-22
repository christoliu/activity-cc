<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<form method="POST" action="update_location.php" enctype="multipart/form-data">
<h1>地點管理</h1>
<table align="center" width="50%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th align="center">名稱</th>
    <th align="center">人數</th>
    <th align="center">地址</th>
    <th align="center">管理人</th>
    <th align="center">聯絡電話</th>
    <th align="center">備註</th>
  </tr>
  <tr>
    <td align="center"><input type="text" name="new_title" size="10"></td>
    <td align="center"><input type="text" name="new_size" size="2"></td>
    <td align="center"><input type="text" name="new_address" size="15"></td>
    <td align="center"><input type="text" name="new_contact" size="5"></td>
    <td align="center"><input type="text" name="new_tel" size="9"></td>
    <td align="center"><input type="text" name="new_remark" size="8"></td>
  </tr>
</table>
<p align="center"><input type="submit" value="新增" name="submit"></p>
<hr />
<table align="center" width="70%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th align="center" nowrap="nowrap">刪除</th>
    <th align="center">名稱</th>
    <th align="center" nowrap="nowrap">人數</th>
    <th align="center">地址</th>
    <th align="center">管理人</th>
    <th align="center">聯絡電話</th>
    <th align="center">備註</th>
  </tr>
  <?
  $result = mysql_query("select * from setup_location order by Title");
  while($row = mysql_fetch_object($result))
  {
  ?>
  <tr>
    <td align="center"><input name="del_<?= $row->OID ?>" type="checkbox"></td>
    <td align="center"><input type="text" size="10" name="title_<?= $row->OID ?>" value="<?= $row->Title ?>" /></td>
    <td align="center"><input type="text" size="2" name="size_<?= $row->OID ?>" value="<?= $row->Size ?>" /></td>
    <td align="center"><input type="text" name="address_<?= $row->OID ?>" value="<?= $row->Address ?>" size="12"></td>
    <td align="center"><input type="text" name="contact_<?= $row->OID ?>" value="<?= $row->Contact ?>" size="5"></td>
    <td align="center"><input type="text" name="tel_<?= $row->OID ?>" value="<?= $row->Telephone ?>" size="9"></td>
    <td align="center"><input type="text" name="remark_<?= $row->OID ?>" value="<?= $row->Remark ?>" size="8"></td>
  </tr>
  <?
  }
  ?>
</table>
<p align="center"><input type="submit" value="修改" name="submit"></p>
</form>
<? require("template_bottom.php"); ?>