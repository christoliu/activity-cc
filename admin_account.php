<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require("sql_link.php");
?>

<? require("template_head.php"); ?>
<form method="POST" action="update_admin_account.php" enctype="multipart/form-data">
<h1>帳號管理</h1>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th width="30%" align="center" nowrap="nowrap">帳號</th>
    <th width="15%" align="center" nowrap="nowrap">姓名/備註</th>
    <th width="15%" align="center" nowrap="nowrap">系統管理</th>
    <th width="15%" align="center" nowrap="nowrap">新增活動</th>
    <th width="15%" align="center" nowrap="nowrap">管理權限</th>
  </tr>
  <tr>
    <td width="40%" align="center"><input type="text" name="Account_new" size="12"></td>
    <td width="40%" align="center"><input type="text" name="Remark_new" size="12"></td>
    <td width="20%" align="center"><input type="checkbox" name="Admin_new" onchange="new_Activity_OID.disabled=new_admin.checked"></td>
    <td width="20%" align="center"><input type="checkbox" name="Post_new"></td>
    <td width="15%" align="center" nowrap="nowrap">建立帳號後，將進入設定頁面</td>
  </tr>
</table>
<p align="center"><input type="submit" value="新增" name="submit"></p>
<hr />

<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th width="5%" align="center" nowrap="nowrap">刪除</th>
    <th width="30%" align="center" nowrap="nowrap">帳號</th>
    <th width="15%" align="center" nowrap="nowrap">姓名/備註</th>
    <th width="15%" align="center" nowrap="nowrap">系統<br />管理</th>
    <th width="15%" align="center" nowrap="nowrap">新增<br />活動</th>
    <th width="15%" align="center" nowrap="nowrap">管理<br />活動</th>
    <th width="15%" align="center" nowrap="nowrap">編輯<br />報名</th>
    <th width="15%" align="center" nowrap="nowrap">編輯<br />參加</th>
    <th width="15%" align="center" nowrap="nowrap">瀏覽<br />參加</th>
    <th width="15%" align="center" nowrap="nowrap"></th>
  </tr>
  <?
  $SQL = "select * from administrator order by Admin DESC, Post DESC, Account";
  $rowsPerPage = 20;
  
  require("paging.php");
  do_SQL();
  while($row = mysql_fetch_object($result))
  {
  ?>
  <tr>
    <td width="5%" align="center"><input name="del_<?= $row->OID ?>" type="checkbox"></td>
    <td width="30%" align="center"><input type="hidden" name="OID_<?= $row->OID ?>" value="<?= $row->OID ?>" /><?= $row->Account ?></td>
    <td width="40%" align="center"><input type="text" name="Remark_<?= $row->OID ?>" value="<?= $row->Remark ?>" size="12"></td>
    <td width="15%" align="center"><input type="checkbox" name="Admin_<?= $row->OID ?>" <? if($row->Admin) echo 'checked="checked"' ?> onchange="Activity_OID_<?= $row->OID ?>.disabled=admin_<?= $row->OID ?>.checked"></td>
    <td width="15%" align="center"><input type="checkbox" name="Post_<?= $row->OID ?>" <? if($row->Post) echo 'checked="checked"' ?>></td>
    <td width="15%" align="center" nowrap="nowrap"><?= $row->Activity_Edit == 0 ? "允許" : ($row->Activity_Edit == -1 ? "禁止" : ($row->Activity_Edit == -2 ? "自創" : "指定")) ?></td>
    <td width="15%" align="center" nowrap="nowrap"><?= $row->Activity_Signup == 0 ? "允許" : ($row->Activity_Signup == -1 ? "禁止" : ($row->Activity_Signup == -2 ? "自創" : "指定")) ?></td>
    <td width="15%" align="center" nowrap="nowrap"><?= $row->Activity_Attend_rw == 0 ? "允許" : ($row->Activity_Attend_rw == -1 ? "禁止" : ($row->Activity_Attend_rw == -2 ? "自創" : "指定")) ?></td>
    <td width="15%" align="center" nowrap="nowrap"><?= $row->Activity_Attend_r == 0 ? "允許" : ($row->Activity_Attend_r == -1 ? "禁止" : ($row->Activity_Attend_r == -2 ? "自創" : "指定")) ?></td>
    <th width="15%" align="center" nowrap="nowrap"><a href="admin_account_activity.php?OID=<?= $row->OID ?>" target="_blank">編輯權限</a></th>
  </tr>
  <? } ?>
</table>
<p align="right"><? do_paging(); ?></p>
<p align="center"><input type="submit" value="修改" name="submit"></p>
</form>
<? require("template_bottom.php"); ?>