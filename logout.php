<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
session_start();
session_unset( );
session_destroy( );
//header("Location: index.php");
?>

<? require("template_head.php"); ?>
<p align="center">已登出本系統，<a href="https://portal.ncu.edu.tw/logout" target="iframe_logout">點此連同登出Portal系統</a>。</p>
<iframe border="0" width="0" height="0" name="iframe_logout"></iframe>
<? require("template_bottom.php"); ?>