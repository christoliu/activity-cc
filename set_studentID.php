<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_admin.php");
require('sql_link.php');
?>

<? require("template_head.php"); ?>
<form method="POST" action="update_set_studentID.php" enctype="multipart/form-data">
<h1>切換身分</h1>
<p align="center"><input type="text" name="StudentID"> <input type="submit" value="切換" name="submit"></p>
</form>
<? require("template_bottom.php"); ?>