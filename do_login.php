<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
session_start();
$user_id = $_POST["USER_ID"]."@cc.ncu.edu.tw";
$user_passwd = $_POST["USER_PASSWD"];
echo '<html><head><meta charset="utf-8"></head><body>';
if(isset($user_id) && isset($user_passwd))
{
  //核對學校信箱帳號密碼
  $fp = fsockopen("cc.ncu.edu.tw", 110, &$errno, &$errstr, 10);
  $answer1 = fgets($fp,128);
  //echo "answer1 = $answer1<br />";
  if (!$fp)
    echo "$errstr ($errno)<br>\n";
  else
  {
    fwrite($fp, "USER $user_id\n");
    $answer2 = fgets($fp,128);
    //echo "answer2 = $answer2<br />";
    fwrite($fp, "PASS $user_passwd\n");
    $answer3 = fgets($fp,128);
    //echo "answer3 = $answer3<br />";
    if(strpos($answer3, 'OK') == FALSE)
    {
      echo "<p align='center'>登入資訊錯誤<br />";
      echo "<a href=javascript:history.back(1)>回上一頁</a></p>";
    }
    else
    {
      require("sql_link.php");
      $Mail_ID = $_POST["USER_ID"];
      $result = mysql_query("select * from administrator where Account='$Mail_ID'");
      $row = mysql_fetch_object($result);
      if($row->OID != "")
      {
        $_SESSION["Activity_ID"] = $_POST["USER_ID"];
        $_SESSION["Activity_admin"] = $row->Admin == 1 ? 1 : NULL;
        $_SESSION["Activity_post"] = $row->Post == 1 ? 1 : NULL;
        $_SESSION["Activity_Edit"] = $row->Activity_Edit;
        $_SESSION["Activity_Signup"] = $row->Activity_Signup;
        $_SESSION["Activity_Attend_rw"] = $row->Activity_Attend_rw;
        $_SESSION["Activity_Attend_r"] = $row->Activity_Attend_r;
        header("Location: index.php");
      }
      else
      {
        echo "<p align='center'>此帳號無管理者權限<br />";
        echo "<a href=javascript:history.back(1)>回上一頁</a></p>";
      }
    }
  }
  fclose ($fp);
}
?>