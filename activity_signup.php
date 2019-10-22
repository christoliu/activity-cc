<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require('sql_link.php');

//放最上方是因為javascript需要用到SQL資料
$now = date("Y-m-d H:i:s");

$result = mysql_query("select * from setup_type2");
while($row = mysql_fetch_object($result))
  $type2["$row->OID"] = $row->Title;
  
$result = mysql_query("select * from setup_location");
while($row = mysql_fetch_object($result))
{
  $location["$row->OID"] = $row->Title;
  $size["$row->OID"] = $row->Size;
}
  
$result = mysql_query("select count(*) as count from activity_signup where Activity_OID=".$_GET['OID']);
$row = mysql_fetch_object($result);
$count = $row->count;

$result = mysql_query("select * from activity where OID=".$_GET['OID']);
$row = mysql_fetch_object($result);
//報名人數超過、尚未到報名時間或超過報名時限則返回首頁; 管理員例外
if((intval($count) >= intval($row->PersonLimit == -1 ? $size[$row->Location] : $row->PersonLimit) || $now > $row->DateEnd || $now < $row->DateStart) && !$_SESSION["Activity_admin"]){
  if($now > $row->DateEnd)
    alert("報名已結束");
  else if($now < $row->DateStart)
    alert("報名尚未開始");
  else
    alert("報名已滿");
  header('Location: index.php');
}
?>
<? require("template_head.php"); ?>

<script type="text/javascript">
function submit_check()
{
  <? if($row->NeedUpload == 1){ ?>
	var file = document.form.Upload.value.substring(document.form.Upload.value.lastIndexOf('.') + 1, document.form.Upload.value.length).toLowerCase();
	<? } ?>
  if("A" != "A"){}
  <? if($row->NeedName == 1){ ?>
  else if(document.form.Name.value == "")
  {
    alert("姓名欄位有誤");
    document.form.Name.focus();
  }
  <? } ?>
  else if(!(document.form.Attendant_type[0].checked || document.form.Attendant_type[1].checked))
  {
    alert("身分別欄位尚未選取");
    document.form.Attendant_type[0].focus();
  }
  else if(document.form.Attendant_type[0].checked && (document.form.StuID.value == "" || document.form.StuID.value.length != 9))
  {
    alert("學號欄位有誤");
    document.form.StuID.focus();
  }
  <? if($row->NeedID == 1){ ?>
  else if(document.form.Attendant_type[0].checked && !checkID(document.form.ID_stu.value) && !checkForeignID(document.form.ID_stu.value))
  {
    alert("身分證字號或居留證號有誤");
    document.form.ID_stu.focus();
  }
  <? } ?>
  <? if($row->NeedDept == 1){ ?>
  else if(document.form.Attendant_type[0].checked && document.form.Title2_stu.value == "")
  {
    alert("系級(單位)欄位有誤");
    document.form.Title2_stu.focus();
  }
  else if(document.form.Attendant_type[0].checked && document.form.Title3_stu.value == "")
  {
    alert("年級欄位有誤");
    document.form.Title3_stu.focus();
  }
  else if(document.form.Attendant_type[1].checked && document.form.Title1_career.value == "")
  {
    alert("系級(單位)欄位有誤");
    document.form.Title1_career.focus();
  }
  else if(document.form.Attendant_type[1].checked && document.form.Title2_career.value == "")
  {
    alert("系級(單位)欄位有誤");
    document.form.Title2_career.focus();
  }
  else if(document.form.Attendant_type[1].checked && document.form.Title3_career.value == "")
  {
    alert("職稱欄位有誤");
    document.form.Title3_career.focus();
  }
  <? } ?>
  else if(document.form.Attendant_type[1].checked && !checkID(document.form.ID_career.value))
  {
    alert("身分證字號欄位有誤");
    document.form.ID_career.focus();
  }
  <? if($row->NeedGender == 1){ ?>
  else if(!(document.form.Gender[0].checked || document.form.Gender[1].checked))
  {
    alert("性別欄位有誤");
    document.form.Gender[0].focus();
  }
  <? } ?>
  <? if($row->NeedBirth == 1){ ?>
  else if(document.form.Birth.value == "")
  {
    alert("生日欄位有誤");
    document.form.Birth.focus();
  }
  <? } ?>
  <? if($row->NeedPhone == 1){ ?>
  else if(document.form.Phone.value == "" || document.form.Phone.value.length != 10)
  {
    alert("手機欄位有誤");
    document.form.Phone.focus();
  }
  <? } ?>
  <? if($row->NeedDiet == 1){ ?>
  else if(!(document.form.Diet[0].checked || document.form.Diet[1].checked))
  {
    alert("飲食習慣欄位有誤");
    document.form.Diet[0].focus();
  }
  <? } ?>
  <? if($row->NeedContact == 1){ ?>
  else if(document.form.Contact.value == "")
  {
    alert("緊急聯絡人欄位有誤");
    document.form.Contact.focus();
  }
  <? } ?>
  <? if($row->NeedContactPhone == 1){ ?>
  else if(document.form.ContactPhone.value == "" || document.form.ContactPhone.value.length != 10)
  {
    alert("緊急聯絡人手機欄位有誤");
    document.form.ContactPhone.focus();
  }
  <? } ?>
  <? if($row->NeedContactRelation == 1){ ?>
  else if(document.form.ContactRelation.value == "")
  {
    alert("緊急聯絡人關係欄位有誤");
    document.form.ContactRelation.focus();
  }
  <? } ?>
  <? if($row->NeedMail == 1){ ?>
  else if(document.form.Mail.value == "" || document.form.Mail.value.indexOf("@") < 1)
  {
    alert("信箱欄位有誤");
    document.form.Mail.focus();
  }
  <? } ?>
  <? if($row->NeedUpload == 1){ ?>
  else if((file != "pdf" && file != "ppt" && file != "doc" && file != "docx" && file != "pptx" && file != "zip" && file != "rar") || document.form.Upload.value == "")
  {
    alert("上傳檔案欄位有誤");
    document.form.Upload.focus();
  }
  <? } ?>
  <? if($row->NeedRemark > 0){ ?>
  else if(document.form.Remark.value.length > <?= $row->NeedRemark ?>)
  {
    alert("其他欄位字數超過上限");
    document.form.Remark.focus();
  }
  else if(document.form.Remark.value.length == 0)
  {
    alert("其他欄位尚未填寫");
    document.form.Remark.focus();
  }
  <? } ?>
  else
  {
    return true;
  }
  return false;
}

function checkID(id)
{
  tab = "ABCDEFGHJKLMNPQRSTUVXYWZIO"
  A1 = new Array (1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3);
  A2 = new Array (0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5);
  Mx = new Array (9,8,7,6,5,4,3,2,1,1);
  
  if (id.length != 10)
    return false;
  i = tab.indexOf(id.charAt(0));
  if (i == -1)
    return false;
  sum = A1[i] + A2[i] * 9;
  
  for (i = 1; i < 10; i++)
  {
    v = parseInt(id.charAt(i));
    if (isNaN(v))
      return false;
    sum += v * Mx[i];
  }
  if (sum % 10 != 0)
    return false;
  return true;
}
function checkForeignID(id)
{
  if (id.length != 10)
    return false;
  
  if (isNaN(id.substr(2,8)) || (id.substr(0,1)<"A" ||id.substr(0,1)>"Z") || (id.substr(1,1)<"A" ||id.substr(1,1)>"Z"))
    return false;
  
  var head="ABCDEFGHJKLMNPQRSTUVXYWZIO";
  id = (head.indexOf(id.substr(0,1))+10) +''+ ((head.indexOf(id.substr(1,1))+10)%10) +''+ id.substr(2,8)
  s =parseInt(id.substr(0,1)) + 
  parseInt(id.substr(1,1)) * 9 + 
  parseInt(id.substr(2,1)) * 8 + 
  parseInt(id.substr(3,1)) * 7 +       
  parseInt(id.substr(4,1)) * 6 + 
  parseInt(id.substr(5,1)) * 5 + 
  parseInt(id.substr(6,1)) * 4 + 
  parseInt(id.substr(7,1)) * 3 + 
  parseInt(id.substr(8,1)) * 2 + 
  parseInt(id.substr(9,1)) + 
  parseInt(id.substr(10,1));
  
  //判斷是否可整除
  if ((s % 10) != 0)
    return false;
  //居留證號碼正確    
  return true;
}
</script>

<form name="form" method="POST" action="update_activity_signup.php" enctype="multipart/form-data" onsubmit="return submit_check()">
<h1>活動報名: <?= $row->Title ?><?= $row->Type2 == "" ? "" : "_".$type2[$row->Type2] ?></h1>
<input type="hidden" name="OID" value="<?= $_GET['OID'] ?>" />
<table id="list" align="center" border="0" cellspacing="2" cellpadding="5" width="100%">
  <tr>
    <td colspan="2" align="right"><a href="activity_info.php?OID=<?= $_GET['OID'] ?>">回上一頁/ Back</a></td>
  </tr>
  <tr>
    <th width="20%" align="left">身分別<br>Identity</th>
    <td width="80%" align="left">
      <input name="Attendant_type" type="radio" value="學生" onclick="Dept_student.style.display=''; Dept_career.style.display='none'" checked>學生 Student
      <input name="Attendant_type" type="radio" value="教職員" onclick="Dept_student.style.display='none'; Dept_career.style.display=''">教職員 Staff
    </td>
  </tr>
  <tr>
    <td align="center" colspan="2">
      <div id="Dept_student" style="display">
      <table align="center" border="0" cellspacing="2" cellpadding="2" width="100%">
        <? if($row->NeedDept == 1){ ?>
        <tr>
          <th width="26%" align="left">系級(單位)<br>Department/<br>Organization</th>
          <td align="left">
            <select name="Title2_stu">
              <option value=""></option>
              <?
    					$array = explode(",", $row->Restrict_Dept);
              $result2 = mysql_query("select * from ncu_academic.setup_dept");
              while($row2 = mysql_fetch_object($result2))
							{
								if(($row->Restrict == 1 && in_array($row2->OID, $array)) || ($row->Restrict == 0 && !in_array($row2->OID, $array)))
                  echo '<option value="'.$row2->Title.'">'.$row2->Title.' '.$row2->eng_title.'</option>';
							}
              ?>
            </select> - 
            <select name="Title3_stu">
              <option value=""></option>
              <? $array = explode(",", $row->Restrict_Grade); ?>
              <? if(($row->Restrict == 1 && in_array("博士班", $array)) || ($row->Restrict == 0 && !in_array("博士班", $array))){ ?><option value="博士班">博士班</option><? } ?>
              <? if(($row->Restrict == 1 && in_array("碩士班", $array)) || ($row->Restrict == 0 && !in_array("碩士班", $array))){ ?><option value="碩士班">碩士班</option><? } ?>
              <? if(($row->Restrict == 1 && in_array("四年級", $array)) || ($row->Restrict == 0 && !in_array("四年級", $array))){ ?><option value="四年級">四年級</option><? } ?>
              <? if(($row->Restrict == 1 && in_array("三年級", $array)) || ($row->Restrict == 0 && !in_array("三年級", $array))){ ?><option value="三年級">三年級</option><? } ?>
              <? if(($row->Restrict == 1 && in_array("二年級", $array)) || ($row->Restrict == 0 && !in_array("二年級", $array))){ ?><option value="二年級">二年級</option><? } ?>
              <? if(($row->Restrict == 1 && in_array("一年級", $array)) || ($row->Restrict == 0 && !in_array("一年級", $array))){ ?><option value="一年級">一年級</option><? } ?>
              <? if(($row->Restrict == 1 && in_array("其他", $array)) || ($row->Restrict == 0 && !in_array("其他", $array))){ ?><option value="其他">其他</option><? } ?>
            </select>
          </td>
        </tr>
        <? } ?>
        <tr>
          <th width="20%" align="left">學號<br>Student ID</th>
          <td align="left"><input type="text" name="StuID" size="10"></td>
        </tr>
        <? if($row->NeedID == 1){ ?>
        <tr>
          <th width="20%" align="left">身分證字號<br />(外籍生請填居留證號)<br>ID Number or Resident Permit Number</th>
          <td align="left"><input type="text" name="ID_stu" size="10"><font color="#FF0000">(保險用，首位字母請大寫)</font></td>
        </tr>
        <? } ?>
      </table>
      </div>
      <div id="Dept_career" style="display:none">
      <table align="center" border="0" cellspacing="2" cellpadding="2" width="100%">
        <? if($row->NeedDept == 1){ ?>
        <tr>
          <th width="26%" align="left">系級(單位)<br>Department/<br>Organization</th>
          <td align="left">
            <select name="Title1_career">
              <option value=""></option>
              <?
    					$array = explode(",", $row->Restrict_Academic);
              $result2 = mysql_query("select * from ncu_academic.setup_academic");
              while($row2 = mysql_fetch_object($result2))
							{
								if($row->Restrict == 1 && in_array($row2->OID, $array))
                  echo '<option value="'.$row2->Title.'">'.$row2->Title.'</option>';
								else if($row->Restrict == 0 && !in_array($row2->OID, $array))
                  echo '<option value="'.$row2->Title.'">'.$row2->Title.'</option>';
							}
              ?>
            </select> - 
            <select name="Title2_career">
              <option value=""></option>
              <?
    					$array = explode(",", $row->Restrict_Dept);
              $result2 = mysql_query("select * from ncu_academic.setup_dept");
              while($row2 = mysql_fetch_object($result2))
							{
								if($row->Restrict == 1 && in_array($row2->OID, $array))
                  echo '<option value="'.$row2->Title.'">'.$row2->Title.'</option>';
								else if($row->Restrict == 0 && !in_array($row2->OID, $array))
                  echo '<option value="'.$row2->Title.'">'.$row2->Title.'</option>';
							}
							?>
            </select>
          </td>
        </tr>
        <tr>
          <th width="20%" align="left">職稱<br>Position</th>
          <td align="left"><input type="text" name="Title3_career" size="10"></td>
        </tr>
        <? } ?>
		<? /* 這邊忘了加判斷式了QQQQQQ by 網管林桓加 */ ?>
		<? if($row->NeedID == 1){ ?>
        <tr>
          <th width="20%" align="left">身分證字號<br>ID Number</th>
          <td align="left"><input type="text" name="ID_career" size="10"></td>
        </tr>
		<? } ?>
      </table>
      </div>
    </td>
  </tr>
  <? if($row->NeedName == 1){ ?>
  <tr>
    <th width="20%" align="left">姓名<br>Name</th>
    <td width="80%" align="left"><input type="text" name="Name" size="20"></td>
  </tr>
  <? } ?>
  <? if($row->NeedGender == 1){ ?>
  <tr>
    <th width="20%" align="left">性別<br>Gender</th>
    <td width="80%" align="left"><input name="Gender" type="radio" value="1">男 Male <input name="Gender" type="radio" value="0">女 Female</td>
  </tr>
  <? } ?>
  <? if($row->NeedBirth == 1){ ?>
  <tr>
    <th width="20%" align="left">生日<br>Birthday</th>
    <td width="80%" align="left">
    <?
    require("datetime.php");
    datetime("Birth", "", 1, 0, 0, 0);
    ?>
    <font color="#FF0000">(sample: 1996-01-01)</font>
    </td>
  </tr>
  <? } ?>
  <? if($row->NeedPhone == 1){ ?>
  <tr>
    <th width="20%" align="left">手機<br>Phone Number</th>
    <td width="80%" align="left"><input type="text" name="Phone" size="10"><font color="#FF0000">(sample: 0912345678)</font></td>
  </tr>
  <? } ?>
  <? if($row->NeedDiet == 1){ ?>
  <tr>
    <th width="20%" align="left">飲食習慣<br>Eating Habit</th>
    <td width="80%" align="left">
      <input name="Diet" type="radio" value="葷">葷 Non-Vegetarian <input name="Diet" type="radio" value="素">素 Vegetarian <!--<input name="Diet" type="radio" value="其他">其他: <input type="text" name="Diet_else" size="10">-->
    </td>
  </tr>
  <? } ?>
  <? if($row->NeedContact == 1){ ?>
  <tr>
    <th width="20%" align="left">緊急聯絡人<br>Contact Person</th>
    <td width="80%" align="left"><input type="text" name="Contact" size="10"></td>
  </tr>
  <? } ?>
  <? if($row->NeedContactPhone == 1){ ?>
  <tr>
    <th width="20%" align="left">聯絡人手機<br>Contact-Person's Phone Number</th>
    <td width="80%" align="left"><input type="text" name="ContactPhone" size="10"><font color="#FF0000">(範例: 0912345678)</font></td>
  </tr>
  <? } ?>
  <? if($row->NeedContactRelation == 1){ ?>
  <tr>
    <th width="20%" align="left">聯絡人關係<br>Relationship</th>
    <td width="80%" align="left" size="10">
        <select name="ContactRelation">
          <option value="親屬">親屬<br>Relatives</option>
          <option value="師長">師長<br>Teacher</option>
          <option value="系辦">系辦<br>Department-Office</option>
        </select>
    </td>
  </tr>
  <? } ?>
  <? if($row->NeedMail == 1){ ?>
  <tr>
    <th width="20%" align="left">信箱<br>E-mail</th>
    <td width="80%" align="left"><input type="text" name="Mail" size="40"> </td>
  </tr>
  <? } ?>
  <? if($row->NeedUpload == 1){ ?>
  <tr>
    <th width="20%" align="left">上傳檔案<br>Upload-File</th>
    <td width="80%" align="left"><input type="file" name="Upload"><br /><font color="#FF0000">(檔案格式限定為.pdf .doc .docx .ppt .pptx .zip .rar，檔案大小限制為25MB)<br>(Format limit: .pdf .doc .docx .ppt .zip .rar, smaller than 25MB)</font></td>
  </tr>
  <? } ?>
  <? if($row->NeedRemark > 0){ ?>
  <tr>
    <th width="20%" align="left">其他備註<br>Others</th>
    <td width="80%" align="left"><font color="#FF0000"><?= $row->Remark_Defult ?></font><br /><textarea name="Remark" cols="50" rows="5"></textarea><br /><font color="#FF0000">(字數上限為<?= $row->NeedRemark ?>字)<br>Up to <?= $row->NeedRemark ?> words</font></td>
  </tr>
  <? } ?>
  <tr>
    <th width="20%" align="left">個人資料<br />供本中心用於其他活動<br>Could these data <br>be used in <br>other activities of<br>NCU Career Center?</th>
    <td width="80%" align="left"><input name="Public_Profiles" type="radio" value="1" checked="checked">允許 Apply <input name="Public_Profiles" type="radio" value="0">拒絕 Refuse</td>
  </tr>
  <tr>
      <th width="20%" align="left">已閱讀 Read<br /><input type="checkbox" name="c" onclick="check()"></th>
      <td width="20%" align="left"><a href="../activity/uploads/for_signup.html" target="_blank">職涯發展中心個資聲明</a><br>Declaration </td>
  </tr>
</table>

<p align="center"><input type="submit" name="submit" class="S" value="submit" disabled="true" style="color:gray"/></p>
</form>
<? require("template_bottom.php"); ?>    


<script>
    function check(){
      //console.log($('#c').attr('checked', true), 123);
      if (jQuery("[name='c']").attr('checked')){
        jQuery($('.S')).attr('disabled', false);
        jQuery($('.S')).attr('style', "color:black"); 
      }
      else{
        jQuery($('.S')).attr('disabled', true);
        jQuery($('.S')).attr('style', "color:gray"); 
      }
    }
</script>
