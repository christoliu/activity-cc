<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<? session_start(); ?>
<? require("template_head.php"); ?>
<form name="index" method="POST" action="do_login.php" enctype="multipart/form-data">
<h1>系統管理登入</h1>
<table align="center" width="55%">
  <tr>
    <td>
    <p align="center">請以 計算機中心郵件伺服器身分 進行登入驗證</p>
    <p>帳號:<input type="text" name="USER_ID">@cc.ncu.edu.tw</p>
    <p>密碼:<input type="password" name="USER_PASSWD"></p>
    <p align="center"><input type="submit" value="身分驗證" name="submit"></p>
    </td>
  </tr>
</table>
</form>
<? require("template_bottom.php"); ?>