<?php
/*apply_submit.php*/
require_once("db.php");
/*function sql_string$string)
{
	if(get_magic_quotes_gpc()) $string=stringlash($string);
	return $conn -> real_escape_string($string);
}
function sql_entities_string$string)
{
	return htmlentities(sql_string$string));
}*/


$Title = $_POST['Title'];
$Location = $_POST['Location'];
$Restrict_Academic = $_POST['Restrict_Academic'];
$Restrict_Dept = $_POST['Restrict_Dept'];
$DateAction = $_POST['DateAction'];
$DateFinish = $_POST['DateFinish'];
$Type = $_POST['Type'];
$Grade_01 = $_POST['Grade_01'];
$Grade_02 = $_POST['Grade_02'];
$Grade_03 = $_POST['Grade_03'];
$Grade_04 = $_POST['Grade_04'];
$Grade_n_master = $_POST['Grade_n_master'];
$Grade_master = $_POST['Grade_master'];
$Grade_n_doctor = $_POST['Grade_n_doctor'];
$Grade_doctor = $_POST['Grade_doctor'];
$prediction_person=$_POST['Grade_01']+$_POST['Grade_02']+$_POST['Grade_03']+$_POST['Grade_04']+$_POST['Grade_n_master']+$_POST['Grade_master']+$_POST['Grade_n_doctor']+$_POST['Grade_doctor'];
$t_name = $_POST['t_name'];
$t_posi = $_POST['t_posi'];
$t_phone = $_POST['t_phone'];
$t_email = $_POST['t_email'];
$Same = $_POST['Same'];//(同上)
if (!isset ($_POST['Same']))
{
	$c_name = $_POST['c_name'];
	$c_posi = $_POST['c_posi'];
	$c_phone = $_POST['c_phone'];
	$c_email = $_POST['c_email'];
}
else
{
	$c_name = $_POST['t_name'];
	$c_posi = $_POST['t_posi'];
	$c_phone = $_POST['t_phone'];
	$c_email = $_POST['t_email'];
}
$description = htmlentities( $_POST['description']);
$item = $_POST['item'];
$purpose = $_POST['purpose'];
$sin_price = $_POST['sin_price'];
$quan = $_POST['quan'];

$tol_price = $_POST['tol_price'];//小計
$t = $tol_price;
$total_cost = array_sum($t);//總計

$p_career = $_POST['p_career'];//小職涯分擔
$c = $p_career;
$career_cost = array_sum($c);//總職涯分擔

$p_depart = $_POST['p_depart'];//小系所分擔
$d = $p_depart;
$depart_cost = array_sum($d);

$res=0;
/*0=未審核,1=成功,2=失敗*/




$sql = 
"
INSERT INTO activity_apply 
(
activity_name,
location,
academic,
dept,
date_action,
date_finish,
type,
predict_person, 
t_name,
t_posi,
t_phone,
t_email,
c_name,
c_posi,
c_phone,
c_email,
description,
total_cost,
dep_cost,
career_cost,
result
)
VALUES 
(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn -> prepare($sql);

	$stmt -> bind_param('sssssssssssssssssdddi',
	$Title,
	$Location,
	$Restrict_Academic,
	$Restrict_Dept,
	$DateAction,
	$DateFinish,
	$Type,
	$prediction_person,
	$t_name,
	$t_posi,
	$t_phone,
	$t_email,
	$c_name,
	$c_posi,
	$c_phone,
	$c_email,
	$description,
	$total_cost,
	$depart_cost,
	$career_cost,
	$res);
	

$stmt -> execute();
$_SESSION["g_oid"] = $conn ->insert_id;
//echo $_SESSION["g_oid"];
$stmt->close();
$conn->close();

for($i=0;$i<count($item);$i++)
{
	require("db.php");

	$sql = 
	"
	INSERT INTO activity_apply_cost 
	(
	activity_apply_id,
	cost_name,
	cost_des,
	single_price,
	quantity,
	pxq,
	p_career,
	p_depart
	)
	VALUES 
	(?,?,?,?,?,?,?,?)";

	$stmt = $conn -> prepare($sql);
	$stmt -> bind_param('issdiiii',
	$_SESSION["g_oid"],
	$item[$i],
	$purpose[$i],
	$sin_price[$i],
	$quan[$i],
	$tol_price[$i],
	$p_career[$i],
	$p_depart[$i]);
	$stmt -> execute();
	$stmt->close();
	$conn->close();
}

 require("apply_print.php");

 
/*
0=未審核,1=成功,2=失敗
*/
/*if (!mysqli_query($sql))
  {
  die('Error: ' . mysqli_error());
  }
 else
 {
	$g_oid = mysqli_insert_id ();
 //require_once("apply_print.php");
 header("apply_print.php");
 }
*/
?>



