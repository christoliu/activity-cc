<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
    <ul>
	    <li><a href="../">職涯發展中心首頁</a></li>
    </ul>
    <h1>活動相關</h1>
    <ul>
        <li><a href="index.php">活動報名</a></li>
        <li><a href="outtake.php">活動花絮</a></li>
    </ul>
<? 
if($_SESSION["Activity_ID"] != "")
{
?>
    <h1>活動管理</h1>
    <ul>
		<? if($_SESSION["Activity_post"] == 1){ ?><li><a href="admin_edit.php">新增活動</a></li><? } ?>
		<li><a href="admin_list.php">管理活動</a></li>
    </ul>
<?
	if($_SESSION["Activity_admin"] == 1)
	{
?>
    <h1>系統管理</h1>
    <ul>
		<li><a href="set_studentID.php">帳號身分切換</a></li>
		<li><a href="admin_account.php">帳號管理</a></li>
		<li><a href="admin_type.php">類別管理</a></li>
		<li><a href="admin_type2.php">細目別管理</a></li>
		<li><a href="admin_location.php">地點管理</a></li>
    <li><a href="admin_academic.php">院別管理</a></li>
    <li><a href="admin_dept.php">系所管理</a></li>
    </ul>
<? 
	}
?>
    <ul>
	    <li><a href="logout.php">登出</a></li>
    </ul>
<?
}
else
{
?>
    <ul>
	    <li><a href="login_portal.php">管理入口</a></li>
    </ul>
<?
}
?>