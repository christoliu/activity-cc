<?

//$sql="select * from activity_apply where reg_date = (select max(reg_date) from activity_apply)";
//$result = mysql_query($sql);
require("db.php");
$result = $conn -> query("select * from activity_apply where OID= '{$_SESSION["g_oid"] }' ");


while($row = $result -> fetch_assoc())
{
echo "<script>alert('系統自動產生申請表後將導回首頁');</script>";
$id = $row["OID"];
$date = $row["reg_date"];
}

?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html" charset="UTF-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">

<title>活動申請單</title>

<link rel=dataStoreItem href="系所合作_需求調查表_v20160125.files/item0001.xml"
target="系所合作_需求調查表_v20160125.files/props002.xml">
<link rel=themeData href="系所合作_需求調查表_v20160125.files/themedata.thmx">
<link rel=colorSchemeMapping
href="系所合作_需求調查表_v20160125.files/colorschememapping.xml">


<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:表格內文;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;}
table.MsoTableGrid
	{mso-style-name:表格格線;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:none;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2049"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->

 </head>

<body lang=ZH-TW link=blue vlink=purple style='tab-interval:24.0pt;text-justify-trim:
punctuation' onload="printpage()">

<div class=WordSection1 style='layout-grid:18.0pt'>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=888
 style='width:532.85pt;border-collapse:collapse;border:none;mso-border-alt:
 solid windowtext .5pt;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=888 colspan=8 valign=top style='width:532.85pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
  0pt;layout-grid-mode:char'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;font-family:"微軟正黑體",sans-serif;color:black'>國立中央大學<span
  class=GramE>學務</span>處職<span class=GramE>涯</span>發展中心「多元職<span class=GramE>涯</span>發展與輔導活動」<span
  lang=EN-US><o:p></o:p></span></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
  0pt;layout-grid-mode:char'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:14.0pt;font-family:"微軟正黑體",sans-serif;color:black'>需求調查表#<?php echo $id ;?></span></b><b
  style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:14.0pt;
  font-family:標楷體;color:black'><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:28.5pt'>
  <td width=517 colspan=4 style='width:310.1pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:28.5pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  line-height:150%;layout-grid-mode:char'><span style='mso-bidi-font-size:12.0pt;
  line-height:150%;font-family:"微軟正黑體",sans-serif;color:black'>院<span
  lang=EN-US>/</span>系<span lang=EN-US>/</span>所：<?php echo $Restrict_Academic."-".$Restrict_Dept;?><u><span lang=EN-US><o:p></o:p></span></u></span></p>
  </td>
  <td width=371 colspan=4 style='width:222.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:28.5pt'>
  <p class=MsoNormal align=right style='text-align:right;layout-grid-mode:char'><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>填表日期：<?php echo $date;?></span></p>
  <p class=MsoNormal align=right style='text-align:right;layout-grid-mode:char'><span
  style='mso-bidi-font-size:14.0pt;font-family:"微軟正黑體",sans-serif;color:black'>活動舉辦日期：<?php echo $DateAction."　　";?></span>
  </p>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  layout-grid-mode:char'><span lang=EN-US style='font-size:1.0pt;font-family:
  "微軟正黑體",sans-serif;color:black'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:29.15pt'>
  <td width=139 rowspan=2 style='width:83.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:29.15pt'>
  <p class=MsoNormal align=center style='text-align:center;layout-grid-mode:
  char'><b style='mso-bidi-font-weight:normal'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>院系所 <span lang=EN-US><o:p></o:p></span></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;layout-grid-mode:
  char'><b style='mso-bidi-font-weight:normal'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>承辦人<span lang=EN-US><o:p></o:p></span></span></b></p>
  </td>
  <td width=253 colspan=2 style='width:151.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:29.15pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  layout-grid-mode:char'><span style='mso-bidi-font-size:12.0pt;font-family:
  "微軟正黑體",sans-serif;mso-bidi-font-family:新細明體'>姓名：<?php echo $t_name;?><span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=496 colspan=5 style='width:297.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:29.15pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  layout-grid-mode:char'><span style='mso-bidi-font-size:12.0pt;font-family:
  "微軟正黑體",sans-serif;mso-bidi-font-family:新細明體'>分機：<?php echo $t_phone;?><span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:1.0cm'>
  <td width=253 colspan=2 style='width:151.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  layout-grid-mode:char'><span style='mso-bidi-font-size:12.0pt;font-family:
  "微軟正黑體",sans-serif;mso-bidi-font-family:新細明體'>職稱：<?php echo $t_posi;?></span><span lang=EN-US
  style='font-size:1.0pt;font-family:"微軟正黑體",sans-serif;color:black'><o:p></o:p></span></p>
  </td>
  <td width=496 colspan=5 style='width:297.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:1.0cm'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  layout-grid-mode:char'><span lang=EN-US style='mso-bidi-font-size:12.0pt;
  font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:新細明體'>Email</span><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:
  新細明體'>：<?php echo $t_email;?></span><span lang=EN-US style='font-size:1.0pt;font-family:"微軟正黑體",sans-serif;
  color:black'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:31.15pt'>
  <td width=139 rowspan=2 style='width:83.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:31.15pt'>
  <p class=MsoNormal align=center style='text-align:center;layout-grid-mode:
  char'><b style='mso-bidi-font-weight:normal'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>活動連<span class=GramE>繫</span>人<span
  lang=EN-US><o:p></o:p></span></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;layout-grid-mode:
  char'><span lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:Webdings;
  mso-ascii-font-family:微軟正黑體;mso-fareast-font-family:微軟正黑體;mso-hansi-font-family:
  微軟正黑體;mso-bidi-font-family:新細明體;mso-char-type:symbol;mso-symbol-font-family:
  Webdings'><span style='mso-char-type:symbol;mso-symbol-font-family:Webdings'></span></span><span
  lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
  mso-bidi-font-family:新細明體'> </span><b
  style='mso-bidi-font-weight:normal'><span lang=EN-US style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'><o:p></o:p></span></b></p>
  </td>
  <td width=253 colspan=2 style='width:151.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:31.15pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  line-height:16.0pt;mso-line-height-rule:exactly;layout-grid-mode:char'><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:
  新細明體'>姓名：<?php echo $c_name;?><span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=496 colspan=5 style='width:297.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:31.15pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  line-height:16.0pt;mso-line-height-rule:exactly;layout-grid-mode:char'><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:
  新細明體'>分機 <span lang=EN-US>/ </span>手機：<?php echo $c_phone;?><span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:31.15pt'>
  <td width=253 colspan=2 style='width:151.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:31.15pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  line-height:150%;layout-grid-mode:char'><span style='mso-bidi-font-size:12.0pt;
  line-height:150%;font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:新細明體'>職稱
  <span lang=EN-US>/ </span>系級：<?php echo $c_posi;?></span><span lang=EN-US style='font-size:1.0pt;
  line-height:150%;font-family:"微軟正黑體",sans-serif;color:black'><o:p></o:p></span></p>
  </td>
  <td width=496 colspan=5 style='width:297.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:31.15pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  line-height:150%;layout-grid-mode:char'><span lang=EN-US style='mso-bidi-font-size:
  12.0pt;line-height:150%;font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:
  新細明體'>Email</span><span style='mso-bidi-font-size:12.0pt;line-height:150%;
  font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:新細明體'>：<?php echo $c_email;?></span><span
  lang=EN-US style='font-size:1.0pt;line-height:150%;font-family:"微軟正黑體",sans-serif;
  color:black'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:16.75pt'>
  <td width=139 rowspan=3 style='width:83.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal align=center style='text-align:center;layout-grid-mode:
  char'><b style='mso-bidi-font-weight:normal'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>預估<span lang=EN-US><o:p></o:p></span></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;layout-grid-mode:
  char'><b style='mso-bidi-font-weight:normal'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>參加對象<span lang=EN-US><o:p></o:p></span></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;layout-grid-mode:
  char'><b style='mso-bidi-font-weight:normal'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>及人數<span lang=EN-US><o:p></o:p></span></span></b></p>
  </td>
  <td width=83 valign=top style='width:49.6pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>大學部<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=170 valign=top style='width:102.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>一年級：<span lang=EN-US><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span><span
  style='mso-spacerun:yes'>&nbsp;</span></span><?php echo $Grade_01;?>人<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=165 colspan=2 valign=top style='width:99.25pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>二年級：<span lang=EN-US><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span><?php echo $Grade_02;?>人<span
  lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=165 colspan=2 valign=top style='width:99.1pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span class=GramE><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>三</span></span><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>年級：<span
  lang=EN-US><span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span><?php echo $Grade_03;?>人<span
  lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=166 valign=top style='width:99.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>四年級：<span lang=EN-US><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span><?php echo $Grade_04;?>人<span
  lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:16.75pt'>
  <td width=83 rowspan=2 style='width:49.6pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>研究生<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=170 valign=top style='width:102.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='mso-line-height-alt:0pt;layout-grid-mode:char'><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>碩士新生：<span
  lang=EN-US><span style='mso-spacerun:yes'>&nbsp;&nbsp; </span></span><?php echo $Grade_n_master;?>人<span
  lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=165 colspan=2 valign=top style='width:99.25pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='mso-line-height-alt:0pt;layout-grid-mode:char'><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>博士新生：<span
  lang=EN-US><span style='mso-spacerun:yes'>&nbsp;&nbsp; </span></span><?php echo $Grade_n_doctor;?>人<span
  lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=331 colspan=3 rowspan=2 style='width:198.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>總計：<?php echo $prediction_person;?><span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:16.75pt'>
  <td width=170 valign=top style='width:102.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>碩士班：<span lang=EN-US><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span><?php echo $Grade_master;?>人<span
  lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=165 colspan=2 valign=top style='width:99.25pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:16.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;color:black'>博士班：<span lang=EN-US><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span><?php echo $Grade_doctor;?>人<span
  lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:43.2pt'>
  <td width=139 style='width:83.4pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:43.2pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
  0pt;layout-grid-mode:char'><b style='mso-bidi-font-weight:normal'><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif'>活動類型<span
  lang=EN-US><o:p></o:p></span></span></b></p>
  </td>
  <td width=749 colspan=7 valign=top style='width:449.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:43.2pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:新細明體'><?php echo $Type;?></span><span lang=EN-US style='mso-bidi-font-size:12.0pt;
  font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:新細明體;mso-font-kerning:
  0pt'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:21.75pt'>
  <td width=139 rowspan=4 style='width:83.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:21.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
  0pt;layout-grid-mode:char'><b style='mso-bidi-font-weight:normal'><span
  style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif'>合作內容</span></b><span
  lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif'><o:p></o:p></span></p>
  </td>
  <td width=749 colspan=7 style='width:449.45pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:新細明體;mso-font-kerning:
  0pt'>活動或講座名稱：<?php echo $Title;?><span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:21.75pt'>
  <td width=425 colspan=5 style='width:255.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:新細明體;mso-font-kerning:
  0pt'>地點：<?php echo $Location;?><span lang=EN-US><o:p></o:p></span></span></p>
  </td>
  <td width=324 colspan=2 style='width:194.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.75pt'>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:新細明體;mso-font-kerning:
  0pt'>時段：<span lang=EN-US><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:109.55pt'>
  <td width=749 colspan=7 valign=top style='width:449.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:109.55pt'>
  <p class=MsoNormal style='margin-bottom:12.0pt;text-align:justify;text-justify:
  inter-ideograph;line-height:16.0pt;mso-line-height-rule:exactly'><span
  style='font-family:"微軟正黑體",sans-serif'>一、合作或執行</span><span style='mso-bidi-font-size:
  12.0pt;font-family:"微軟正黑體",sans-serif'>方式</span><span style='font-family:
  "微軟正黑體",sans-serif'>簡述</span><span lang=EN-US style='mso-bidi-font-size:12.0pt;
  font-family:"微軟正黑體",sans-serif'>(</span><span style='mso-bidi-font-size:12.0pt;
  font-family:"微軟正黑體",sans-serif'>如</span><span style='mso-bidi-font-size:12.0pt;
  font-family:"微軟正黑體",sans-serif;mso-bidi-font-family:新細明體'>邀請貴賓、進行方式、需職<span
  class=GramE>涯</span>中心協助之處及</span><span style='font-family:"微軟正黑體",sans-serif'>預期成效</span><span
  lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
  mso-bidi-font-family:新細明體'>)</span><span lang=EN-US style='font-family:"微軟正黑體",sans-serif'><o:p></o:p></span></p>
  <p class=MsoNormal style='text-align:justify;text-justify:inter-ideograph;
  mso-line-height-alt:0pt;layout-grid-mode:char'><span lang=EN-US style='word-break:break-all;mso-bidi-font-size:12.0pt;font-family:"新細明體",serif'>
  <o:p><pre><?php echo nl2br($description);?><pre>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13;mso-yfti-lastrow:yes;height:162.0pt'>
  <td width=749 colspan=7 valign=top style='width:449.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:162.0pt'>
  <p class=MsoNormal style='margin-bottom:12.0pt;text-align:justify;text-justify:
  inter-ideograph;line-height:16.0pt;mso-line-height-rule:exactly'><span
  style='font-family:"微軟正黑體",sans-serif'>二、經費預估<span lang=EN-US>(</span>表格如不敷使用，請自行延伸<span
  lang=EN-US>)<span style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
  style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;</span></span>金額以新台幣<span
  lang=EN-US>(</span>元<span lang=EN-US>)</span>計<span lang=EN-US><o:p></o:p></span></span></p>
  <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=721
   style='border-collapse:collapse;mso-table-layout-alt:fixed;border:none;
   mso-border-alt:solid windowtext 1.5pt;mso-padding-alt:0cm 1.4pt 0cm 1.4pt;
   mso-border-insideh:.75pt solid windowtext;mso-border-insidev:.75pt solid windowtext'>
   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;page-break-inside:avoid;
    height:9.5pt'>
    <td width=95 rowspan=2 style='width:56.9pt;border-top:3.0pt;border-left:
    3.0pt;border-bottom:1.0pt;border-right:1.0pt;border-color:windowtext;
    border-style:solid;mso-border-top-alt:3.0pt;mso-border-left-alt:3.0pt;
    mso-border-bottom-alt:.75pt;mso-border-right-alt:.75pt;mso-border-color-alt:
    windowtext;mso-border-style-alt:solid;padding:0cm 1.4pt 0cm 1.4pt;
    height:9.5pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>費用名稱<span lang=EN-US><o:p></o:p></span></span></p>
    </td>
    <td width=236 rowspan=2 style='width:5.0cm;border-top:solid windowtext 3.0pt;
    border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-left-alt:solid windowtext .75pt;mso-border-alt:solid windowtext .75pt;
    mso-border-top-alt:solid windowtext 3.0pt;padding:0cm 1.4pt 0cm 1.4pt;
    height:9.5pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>用途說明<span lang=EN-US><o:p></o:p></span></span></p>
    </td>
    <td width=71 rowspan=2 style='width:42.5pt;border-top:solid windowtext 3.0pt;
    border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-left-alt:solid windowtext .75pt;mso-border-alt:solid windowtext .75pt;
    mso-border-top-alt:solid windowtext 3.0pt;padding:0cm 1.4pt 0cm 1.4pt;
    height:9.5pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>單價<span lang=EN-US><o:p></o:p></span></span></p>
    </td>
    <td width=71 rowspan=2 style='width:42.55pt;border-top:solid windowtext 3.0pt;
    border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-left-alt:solid windowtext .75pt;mso-border-alt:solid windowtext .75pt;
    mso-border-top-alt:solid windowtext 3.0pt;padding:0cm 1.4pt 0cm 1.4pt;
    height:9.5pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>數量<span lang=EN-US><o:p></o:p></span></span></p>
    </td>
    <td width=106 rowspan=2 style='width:63.8pt;border-top:solid windowtext 3.0pt;
    border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-left-alt:solid windowtext .75pt;mso-border-alt:solid windowtext .75pt;
    mso-border-top-alt:solid windowtext 3.0pt;padding:0cm 1.4pt 0cm 1.4pt;
    height:9.5pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>小計<span lang=EN-US><o:p></o:p></span></span></p>
    </td>
    <td width=142 colspan=2 style='width:3.0cm;border-top:solid windowtext 3.0pt;
    border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 3.0pt;
    mso-border-left-alt:solid windowtext .75pt;padding:0cm 1.4pt 0cm 1.4pt;
    height:9.5pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>分攤金額<span lang=EN-US><o:p></o:p></span></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:1;page-break-inside:avoid;height:9.5pt'>
    <td width=71 style='width:42.5pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 3.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .75pt;
    padding:0cm 1.4pt 0cm 1.4pt;height:9.5pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>院系所<span lang=EN-US><o:p></o:p></span></span></p>
    </td>
    <td width=71 style='width:42.55pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 3.0pt;border-right:solid windowtext 3.0pt;
    mso-border-top-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;
    padding:0cm 1.4pt 0cm 1.4pt;height:9.5pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>職<span class=GramE>涯</span><span
    lang=EN-US><o:p></o:p></span></span></p>
    </td>
   </tr>
   <?php for($i=0;$i<count($item);$i++){?>
   <tr style='mso-yfti-irow:2;page-break-inside:avoid;height:20.65pt'>
    <td width=95 style='width:56.9pt;border-top:none;border-left:solid windowtext 3.0pt;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext 3.0pt;mso-border-top-alt:3.0pt;
    mso-border-left-alt:3.0pt;mso-border-bottom-alt:.75pt;mso-border-right-alt:
    .75pt;mso-border-color-alt:windowtext;mso-border-style-alt:solid;
    padding:0cm 1.4pt 0cm 1.4pt;height:20.65pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'><o:p><?php echo $item[$i];?>&nbsp;</o:p></span></p>
    </td>
    <td width=236 style='width:5.0cm;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext 3.0pt;mso-border-left-alt:solid windowtext .75pt;
    mso-border-alt:solid windowtext .75pt;mso-border-top-alt:solid windowtext 3.0pt;
    padding:0cm 1.4pt 0cm 1.4pt;height:20.65pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'><o:p><?php echo $purpose[$i];?>&nbsp;</o:p></span></p>
    </td>
    <td width=71 style='width:42.5pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext 3.0pt;mso-border-left-alt:solid windowtext .75pt;
    mso-border-alt:solid windowtext .75pt;mso-border-top-alt:solid windowtext 3.0pt;
    padding:0cm 1.4pt 0cm 1.4pt;height:20.65pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'><o:p><?php echo $sin_price[$i];?>&nbsp;</o:p></span></p>
    </td>
    <td width=71 style='width:42.55pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext 3.0pt;mso-border-left-alt:solid windowtext .75pt;
    mso-border-alt:solid windowtext .75pt;mso-border-top-alt:solid windowtext 3.0pt;
    padding:0cm 1.4pt 0cm 1.4pt;height:20.65pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'><o:p><?php echo $quan[$i];?>&nbsp;</o:p></span></p>
    </td>
    <td width=106 style='width:63.8pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext 3.0pt;mso-border-left-alt:solid windowtext .75pt;
    mso-border-alt:solid windowtext .75pt;mso-border-top-alt:solid windowtext 3.0pt;
    padding:0cm 1.4pt 0cm 1.4pt;height:20.65pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'><o:p><?php echo $tol_price[$i];?>&nbsp;</o:p></span></p>
    </td>
    <td width=71 style='width:42.5pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext 3.0pt;mso-border-left-alt:solid windowtext .75pt;
    mso-border-top-alt:3.0pt;mso-border-left-alt:.75pt;mso-border-bottom-alt:
    .75pt;mso-border-right-alt:1.0pt;mso-border-color-alt:windowtext;
    mso-border-style-alt:solid;padding:0cm 1.4pt 0cm 1.4pt;height:20.65pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'><o:p><?php echo $p_depart[$i];?>&nbsp;</o:p></span></p>
    </td>
    <td width=71 style='width:42.55pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 3.0pt;
    mso-border-top-alt:solid windowtext 3.0pt;mso-border-left-alt:solid windowtext 1.0pt;
    mso-border-top-alt:3.0pt;mso-border-left-alt:1.0pt;mso-border-bottom-alt:
    .75pt;mso-border-right-alt:3.0pt;mso-border-color-alt:windowtext;
    mso-border-style-alt:solid;padding:0cm 1.4pt 0cm 1.4pt;height:20.65pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span lang=EN-US style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'><o:p><?php echo $p_career[$i];?>&nbsp;</o:p></span></p>
    </td>
   </tr>
   <?php }?>
   
   <tr style='mso-yfti-irow:6;height:19.95pt'>
    <td width=473 colspan=4 rowspan=2 style='width:283.7pt;border-top:none;
    border-left:solid windowtext 3.0pt;border-bottom:solid windowtext 3.0pt;
    border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .75pt;
    mso-border-top-alt:.75pt;mso-border-left-alt:3.0pt;mso-border-bottom-alt:
    3.0pt;mso-border-right-alt:.5pt;mso-border-color-alt:windowtext;mso-border-style-alt:
    solid;padding:0cm 1.4pt 0cm 1.4pt;height:19.95pt'>
    <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span
    style='mso-bidi-font-size:12.0pt;line-height:150%;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>合計<span lang=EN-US><o:p></o:p></span></span></p>
    </td>
    <td width=106 rowspan=2 style='width:63.8pt;border-top:none;border-left:
    none;border-bottom:solid windowtext 3.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .75pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-top-alt:.75pt;mso-border-left-alt:.5pt;mso-border-bottom-alt:
    3.0pt;mso-border-right-alt:.5pt;mso-border-color-alt:windowtext;mso-border-style-alt:
    solid;padding:0cm 1.4pt 0cm 1.4pt;height:19.95pt'>
    <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span
    lang=EN-US style='mso-bidi-font-size:12.0pt;line-height:150%;font-family:
    "微軟正黑體",sans-serif;mso-bidi-font-family:"Arial Unicode MS"'><o:p><?php echo $total_cost;?>&nbsp;</o:p></span></p>
    </td>
    <td width=71 style='width:42.5pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .75pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .75pt;
    padding:0cm 1.4pt 0cm 1.4pt;height:19.95pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>院系所<span lang=EN-US><o:p></o:p></span></span></p>
    </td>
    <td width=71 style='width:42.55pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 3.0pt;
    mso-border-top-alt:solid windowtext .75pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-top-alt:.75pt;mso-border-left-alt:.5pt;mso-border-bottom-alt:
    .5pt;mso-border-right-alt:3.0pt;mso-border-color-alt:windowtext;mso-border-style-alt:
    solid;padding:0cm 1.4pt 0cm 1.4pt;height:19.95pt'>
    <p class=MsoNormal align=center style='text-align:center;mso-line-height-alt:
    0pt'><span style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif;
    mso-bidi-font-family:"Arial Unicode MS"'>職<span class=GramE>涯</span><span
    lang=EN-US><o:p></o:p></span></span></p>
    </td>
   </tr>
   <tr style='mso-yfti-irow:7;mso-yfti-lastrow:yes;height:20.55pt'>
    <td width=71 style='width:42.5pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 3.0pt;border-right:solid windowtext 1.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    mso-border-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext 3.0pt;
    padding:0cm 1.4pt 0cm 1.4pt;height:20.55pt'>
    <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span
    lang=EN-US style='mso-bidi-font-size:12.0pt;line-height:150%;font-family:
    "微軟正黑體",sans-serif;mso-bidi-font-family:"Arial Unicode MS"'><?php echo $depart_cost;?><o:p>&nbsp;</o:p></span></p>
    </td>
    <td width=71 style='width:42.55pt;border-top:none;border-left:none;
    border-bottom:solid windowtext 3.0pt;border-right:solid windowtext 3.0pt;
    mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
    padding:0cm 1.4pt 0cm 1.4pt;height:20.55pt'>
    <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span
    lang=EN-US style='mso-bidi-font-size:12.0pt;line-height:150%;font-family:
    "微軟正黑體",sans-serif;mso-bidi-font-family:"Arial Unicode MS"'><o:p><?php echo $career_cost;?>&nbsp;</o:p></span></p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal style='margin-bottom:12.0pt;text-align:justify;text-justify:
  inter-ideograph;line-height:16.0pt;mso-line-height-rule:exactly'><span
  lang=EN-US style='mso-fareast-font-family:標楷體'><o:p></o:p></span></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=1665 style='border:none'></td>
  <td width=992 style='border:none'></td>
  <td width=2043 style='border:none'></td>
  <td width=1499 style='border:none'></td>
  <td width=486 style='border:none'></td>
  <td width=81 style='border:none'></td>
  <td width=1901 style='border:none'></td>
  <td width=1990 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal style='line-height:20.0pt;mso-line-height-rule:exactly'>
<!--[if gte vml 1]><v:shapetype
 id="_x0000_t202" coordsize="21600,21600" o:spt="202" path="m,l,21600r21600,l21600,xe">
 <v:stroke joinstyle="miter"/>
 <v:path gradientshapeok="t" o:connecttype="rect"/>
</v:shapetype><v:shape id="_x0000_s1039" type="#_x0000_t202" style='position:absolute;
 margin-left:352.8pt;margin-top:-781.8pt;width:157.5pt;height:14.5pt;z-index:251657728;
 mso-position-horizontal-relative:text;mso-position-vertical-relative:text'
 stroked="f">
 <v:textbox inset="0,0,0,0"/>
</v:shape>
<![endif]-->
<![if !vml]>
<span style='mso-ignore:vglayout;position:
relative;z-index:251657728'><span style='position:absolute;left:594px;
top:-1063px;width:267px;height:28px'>

<table cellpadding=0 cellspacing=0>
 <tr>
  <td width=267 height=28 bgcolor=white style='vertical-align:top;background:
  white'><![endif]><![if !mso]><span style='position:absolute;mso-ignore:vglayout;
  z-index:251657728'>
  <table cellpadding=0 cellspacing=0 width="100%">
   <tr>
    <td><![endif]>
    
    <![if !mso]></td>
   </tr>
  </table>
  </span><![endif]><![if !mso & !vml]>&nbsp;<![endif]><![if !vml]></td>
 </tr>
</table>

</span></span><![endif]><b style='mso-bidi-font-weight:normal'><span
style='mso-bidi-font-size:12.0pt;font-family:"微軟正黑體",sans-serif'>系所承辦人員：<span
lang=EN-US><span
style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span
style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
style='mso-spacerun:yes'>&nbsp;</span><span
style='mso-spacerun:yes'>&nbsp;&nbsp;</span></span>系所主管：<span lang=EN-US><o:p></o:p></span></span></b></p>

<p class=MsoNormal style='line-height:20.0pt;mso-line-height-rule:exactly'><b
style='mso-bidi-font-weight:normal'><span style='mso-bidi-font-size:12.0pt;
font-family:"微軟正黑體",sans-serif'><!--各院職涯導師或--><span
lang=EN-US><o:p></o:p></span></span></b></p>

<p class=MsoNormal style='line-height:20.0pt;mso-line-height-rule:exactly'><b
style='mso-bidi-font-weight:normal'><span style='mso-bidi-font-size:12.0pt;
font-family:"微軟正黑體",sans-serif'>職涯發展中心承辦人:<span lang=EN-US><span
style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span
style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>職<span
class=GramE>涯</span>發展中心主管：</span></b><span lang=EN-US style='font-family:"微軟正黑體",sans-serif;
color:black;text-transform:uppercase'><span style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='mso-bidi-font-size:
12.0pt;font-family:標楷體'><o:p></o:p></span></b></p>

</div>

</body>
<script type="text/javascript">
function printpage()
  {
  window.print();
  window.location="./index.php";
  alert("請務必列印此表單，並將紙本送至職涯發展中心！");
  
  
  }
</script>
</html>

