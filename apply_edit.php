<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("db.php");
$g_oid = mysqli_insert_id ();
$result = mysqli_query($conn,"SELECT * FROM activity_apply where OID='".$g_oid."'");
$row = mysqli_fetch_object($conn,$result);

?>
<? require("template_head.php"); ?>

<form name="apply" method="POST" action="apply_submit.php" align="center">
	<h1>「多元職涯發展與輔導活動」需求調查表</h1>
	<input type="hidden" name="OID" value="<?= $_GET['OID'] ?>" />
	<table id="X" border="0" cellspacing="2" cellpadding="2" width="100%">	
		<tr>
			<th align="center" colspan="2" bgcolor="#FFFFCC"><font color="#000099">基本資料</font></th>
		</tr>
		<tr>
			<th align="center">行政人員請填入對應活動ID</th>
			<td align="left"><input type="text" name="connect" size="5"></td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>活動或講座名稱</th>
			<td align="left"><input type="text" name="Title" size="40" required></td>
		</tr>	
		<tr>
			<th align="center"><font color="#FF0000">*</font>地點</th>
			<td align="left"><input type="text" name="Location" size="40" required></td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>申請單位<br></th>
			<td align="left">
        	 <select name="Restrict_Academic" size="15" required>
				<option value=""></option>
          		<?
					//$array = explode(",", $row->Restrict_Academic);
          			$result2 = mysqli_query($conn,"SELECT * FROM ncu_academic.setup_academic");
          			while($row2 = mysqli_fetch_object($result2))
						echo '<option value="'.$row2->Title.'" name="'.$row2->OID.'" onclick="selectDept()">'.$row2->Title.'</option>';  				//
          		?>
        		</select> - 
        	<select name="Restrict_Dept" size="15" required>
				<option value=""></option>
          		<?
					//$array = explode(",", $row->Restrict_Dept);
          			$result2 = mysqli_query($conn,"SELECT * FROM ncu_academic.setup_Dept");
          			while($row2 = mysqli_fetch_object($result2))         			
          					echo '<option value="'.$row2->Title.'" class="'.$row2->AcademicOID.'" hidden>'.$row2->Title.'</option>';	//			
          		?>
        	</select> 
			</td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>活動開始時間</th>
			<td align="left">
			<?
			require("datetime.php");
			datetime("DateAction", $row->DateAction, 1, 1, 1, 0);
			?>
			</td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>活動結束時間</th>
			<td align="left">
			<?
			datetime("DateFinish", $row->DateFinish, 1, 1, 1, 0);
			?>
			</td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>活動類型</th>
			<td align="left">
				<select name="Type">
					<option value=""></option>
					<?
					$result2 = mysqli_query($conn,"SELECT * FROM setup_type");
					while($row2 = mysqli_fetch_object($result2))
					{
					?>
					<option value="<?= $row2->Title ?>" <? if($row->Type == $row2->OID){ echo 'selected="selected"'; } ?>><?= $row2->Title ?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>預估參加對象及人數</th>
			<td align="left">
				<b>大學部</b><br>
				一年級<input type="text" id="Grade_01" name="Grade_01" size="2" value="0" required>人<br>
				二年級<input type="text" id="Grade_02" name="Grade_02" size="2" value="0" required>人<br>
				三年級<input type="text" id="Grade_03" name="Grade_03" size="2" value="0" required>人<br>
				四年級<input type="text" id="Grade_04" name="Grade_04" size="2" value="0" required>人<br>
				<b>研究生</b><br>
				碩士班新生<input type="text" id="Grade_n_master" name="Grade_n_master" size="2" value="0" required>人<br>
				碩士班<input type="text" id="Grade_master" name="Grade_master" size="2" value="0" required>人<br>
				博士班新生<input type="text" id="Grade_n_doctor" name="Grade_n_doctor" size="2" value="0" required>人<br>
				博士班<input type="text" id="Grade_doctor"name="Grade_doctor" size="2" value="0" required>人<br>
				<!--<input type="button" value="總計" onclick="total()"><input type="text" class="t" id="predict_person" size="2">人<br>-->
			</td>
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>院系所承辦人</th>
			<td align="left"<font color="#FF0000"></font>
			姓名<input type="text" name="t_name" size="10" required><br>
			職稱/系級<input type="text" name="t_posi" size="10" required><br>
			分機/手機<input type="text" name="t_phone" size="10" required><br>
			Email<input type="text" name="t_email" size="30" required><br></td>	
		</tr>
		<tr>
			<th align="center"><font color="#FF0000">*</font>活動聯繫人<br>
			<font size="1">同上</font>
			<input name="Same" type="checkbox" value="theSame" onclick="check()"></th>			
			<td align="left">
			姓名<input type="text" name="c_name" size="10" class="c_"><br>
			職稱/系級<input type="text" name="c_posi" size="10" class="c_"><br>
			分機/手機<input type="text" name="c_phone" size="10" class="c_"><br>
			Email<input type="text" name="c_email" size="30" class="c_"><br>
			</td>	
		</tr>
		<tr>
			<th align="center">合作或執行方式簡述</th>
			<td align="left">
			<textarea rows="5" name="description" cols="50"><?= $row->description ?></textarea>
			<br />
			</td>
		</tr>
		<tr id="oneCost">
			<th align="center" id="x">經費預估</th>
			<td align="left" name="predct_count[]">
			費用名稱<input type="text" name="item[]" size="20"><br>
			用途<input type="text" name="purpose[]" size="30"><br>
			單價<input type="text" name="sin_price[]" size="5">
			數量<input type="text" name="quan[]" size="5">
			小計<input type="text" name="tol_price[]" size="5"><br>
			分攤金額-院系所<input type="text" name="p_depart[]" size="5">
			分攤金額-職涯<input type="text" name="p_career[]" size="5"><br>
			<br />
			</td>
		</tr>
	</table>
	<table border="0" cellspacing="2" cellpadding="2" width="100%">
		<tr>
			<th align="center"></th>	
			<td align="right">
			<input type="button" value="再加一筆費用" onclick="new_item()">
			</td>
		</tr>
	</table>

		<input type="submit"><br><br>
		送出後列印
		
</form>

<script>
	function check(){
		if (jQuery("[name='Same']").attr('checked')){
			jQuery($('.c_')).attr('disabled', true);
		}
		else{
			jQuery($('.c_')).attr('disabled', false);
		}
	}

	var counter = 0;
	function new_item(){
		$("#oneCost").clone().attr("oneCost", "oneCost"+counter++).insertAfter("[id^id]:last").find("input[type='text']").val("").end().appendTo("#X");
	}

	function selectDept(){
		for (var i=1; i<14; i++){
			if (jQuery("[name="+i+"]").attr('selected')){
				jQuery($("."+i).show());
			}
			else{
				jQuery($("."+i).hide());
			}
		}		
	}

</script>
</form>


<? require("template_bottom.php"); ?>
