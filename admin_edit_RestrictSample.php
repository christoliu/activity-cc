<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
require("check_login.php");
require('sql_link.php');
?>

<? require("template_head.php"); ?>
<?
$result = mysql_query("select * from activity where OID='".$_GET['OID']."'");
$row = mysql_fetch_object($result);
?>
<h1>活動管理 系所限制使用說明</h1>
<table width="100%">
  <tr>
    <th align="center" colspan="2"><font color="#FF0000">任何系所單位皆可參加 (禁止:無設定)</font></th>
  </tr>
  <tr>
    <th align="center">系所限制</th>
    <td align="left">
    <select name="Restrict">
      <option value="0" selected="selected">禁止</option>
      <option value="1">允許</option>
    </select>: <br />
    <select name="Restrict_academic" multiple="multiple" size="15">
      <option value="文學院">文學院</option>
      <option value="理學院">理學院</option>
      <option value="工學院">工學院</option>
      <option value="管理學院">管理學院</option>
      <option value="資電學院">資電學院</option>
      <option value="地科學院">地科學院</option>
      <option value="客家學院">客家學院</option>
      <option value="其他單位">其他單位</option>
      <option value="行政單位">行政單位</option>
      <option value="研究單位">研究單位</option>
      <option value="總教學中心">總教學中心</option>
    </select> - 
    <select name="Restrict_dept" multiple="multiple" size="15">
      <option value="中國文學系">中國文學系</option>
      <option value="英美語文學系">英美語文學系</option>
      <option value="法國語文學系">法國語文學系</option>
      <option value="物理學系">物理學系</option>
      <option value="數學系">數學系</option>
      <option value="化學學系">化學學系</option>
      <option value="生命科學系">生命科學系</option>
      <option value="光電科學與工程學系">光電科學與工程學系</option>
      <option value="化學工程與材料工程學系">化學工程與材料工程學系</option>
      <option value="土木工程學系">土木工程學系</option>
      <option value="機械工程學系">機械工程學系</option>
      <option value="企業管理學系">企業管理學系</option>
      <option value="資訊管理學系">資訊管理學系</option>
      <option value="財務金融學系">財務金融學系</option>
      <option value="經濟學系">經濟學系</option>
      <option value="電機工程學系">電機工程學系</option>
      <option value="資訊工程學系">資訊工程學系</option>
      <option value="通訊工程學系">通訊工程學系</option>
      <option value="地球科學學系">地球科學學系</option>
      <option value="大氣科學學系">大氣科學學系</option>
      <option value="哲學研究所">哲學研究所</option>
      <option value="藝術學研究所">藝術學研究所</option>
      <option value="歷史研究所">歷史研究所</option>
      <option value="學習與教學研究所">學習與教學研究所</option>
      <option value="生物物理研究所">生物物理研究所</option>
      <option value="照明與顯示科技研究所">照明與顯示科技研究所</option>
      <option value="統計研究所">統計研究所</option>
      <option value="天文研究所">天文研究所</option>
      <option value="認知與神經科學研究所">認知與神經科學研究所</option>
      <option value="生物資訊與系統生物研究所">生物資訊與系統生物研究所</option>
      <option value="光機電工程研究所">光機電工程研究所</option>
      <option value="能源工程研究所">能源工程研究所</option>
      <option value="環境工程研究所">環境工程研究所</option>
      <option value="營建管理研究所">營建管理研究所</option>
      <option value="材料科學與工程研究所">材料科學與工程研究所</option>
      <option value="生物醫學工程研究所">生物醫學工程研究所</option>
      <option value="會計學研究所">會計學研究所</option>
      <option value="產業經濟研究所">產業經濟研究所</option>
      <option value="人力資源管理研究所">人力資源管理研究所</option>
      <option value="工業管理研究所">工業管理研究所</option>
      <option value="軟體工程研究所">軟體工程研究所</option>
      <option value="網路學習科技研究所">網路學習科技研究所</option>
      <option value="地球物理研究所">地球物理研究所</option>
      <option value="大氣物理研究所">大氣物理研究所</option>
      <option value="太空科學研究所">太空科學研究所</option>
      <option value="應用地質研究所">應用地質研究所</option>
      <option value="水文與海洋科學研究所">水文與海洋科學研究所</option>
      <option value="客家社會文化研究所">客家社會文化研究所</option>
      <option value="客家語文研究所">客家語文研究所</option>
      <option value="客家政治經濟研究所">客家政治經濟研究所</option>
      <option value="法律與政府研究所">法律與政府研究所</option>
      <option value="公共事務與族群研究博士學位學程">公共事務與族群研究博士學位學程</option>
      <option value="理學院學士班">理學院學士班</option>
      <option value="校長室">校長室</option>
      <option value="副校長室">副校長室</option>
      <option value="秘書室">秘書室</option>
      <option value="研發處">研發處</option>
      <option value="總務處">總務處</option>
      <option value="教務處">教務處</option>
      <option value="學務處">學務處</option>
      <option value="人事室">人事室</option>
      <option value="會計室">會計室</option>
      <option value="國際處">國際處</option>
      <option value="圖書館">圖書館</option>
      <option value="電算中心">電算中心</option>
      <option value="環安中心">環安中心</option>
      <option value="遙測中心">遙測中心</option>
      <option value="光電研究中心">光電研究中心</option>
      <option value="環境研究中心">環境研究中心</option>
      <option value="通訊研究中心">通訊研究中心</option>
      <option value="台經研究中心">台經研究中心</option>
      <option value="人文研究中心">人文研究中心</option>
      <option value="數據分析研究中心">數據分析研究中心</option>
      <option value="前瞻科技中心">前瞻科技中心</option>
      <option value="聯合研究中心">聯合研究中心</option>
      <option value="文學院研究單位">文學院研究單位</option>
      <option value="理學院研究單位">理學院研究單位</option>
      <option value="工學院研究單位">工學院研究單位</option>
      <option value="管理學院研究單位">管理學院研究單位</option>
      <option value="地科學院研究單位">地科學院研究單位</option>
      <option value="通識中心">通識中心</option>
      <option value="科教中心">科教中心</option>
      <option value="師培中心">師培中心</option>
      <option value="出版中心">出版中心</option>
      <option value="語言中心">語言中心</option>
      <option value="藝文中心">藝文中心</option>
      <option value="體育室">體育室</option>
    </select>
    </td>
  </tr>
  <tr>
    <th align="center" colspan="2"><font color="#FF0000">僅允許工學院、管理學院、土木系、機械系、資管系參加</font></th>
  </tr>
  <tr>
    <th align="center">系所限制</th>
    <td align="left">
    <select name="Restrict">
      <option value="1" selected="selected">允許</option>
      <option value="0">禁止</option>
    </select>: <br />
    <select name="Restrict_academic" multiple="multiple" size="15">
      <option value="文學院">文學院</option>
      <option value="理學院">理學院</option>
      <option value="工學院" selected="selected">工學院</option>
      <option value="管理學院" selected="selected">管理學院</option>
      <option value="資電學院">資電學院</option>
      <option value="地科學院">地科學院</option>
      <option value="客家學院">客家學院</option>
      <option value="其他單位">其他單位</option>
      <option value="行政單位">行政單位</option>
      <option value="研究單位">研究單位</option>
      <option value="總教學中心">總教學中心</option>
    </select> - 
    <select name="Restrict_dept" multiple="multiple" size="15">
      <option value="中國文學系">中國文學系</option>
      <option value="英美語文學系">英美語文學系</option>
      <option value="法國語文學系">法國語文學系</option>
      <option value="物理學系">物理學系</option>
      <option value="數學系">數學系</option>
      <option value="化學學系">化學學系</option>
      <option value="生命科學系">生命科學系</option>
      <option value="光電科學與工程學系">光電科學與工程學系</option>
      <option value="化學工程與材料工程學系">化學工程與材料工程學系</option>
      <option value="土木工程學系" selected="selected">土木工程學系</option>
      <option value="機械工程學系" selected="selected">機械工程學系</option>
      <option value="企業管理學系">企業管理學系</option>
      <option value="資訊管理學系" selected="selected">資訊管理學系</option>
      <option value="財務金融學系">財務金融學系</option>
      <option value="經濟學系">經濟學系</option>
      <option value="電機工程學系">電機工程學系</option>
      <option value="資訊工程學系">資訊工程學系</option>
      <option value="通訊工程學系">通訊工程學系</option>
      <option value="地球科學學系">地球科學學系</option>
      <option value="大氣科學學系">大氣科學學系</option>
      <option value="哲學研究所">哲學研究所</option>
      <option value="藝術學研究所">藝術學研究所</option>
      <option value="歷史研究所">歷史研究所</option>
      <option value="學習與教學研究所">學習與教學研究所</option>
      <option value="生物物理研究所">生物物理研究所</option>
      <option value="照明與顯示科技研究所">照明與顯示科技研究所</option>
      <option value="統計研究所">統計研究所</option>
      <option value="天文研究所">天文研究所</option>
      <option value="認知與神經科學研究所">認知與神經科學研究所</option>
      <option value="生物資訊與系統生物研究所">生物資訊與系統生物研究所</option>
      <option value="光機電工程研究所">光機電工程研究所</option>
      <option value="能源工程研究所">能源工程研究所</option>
      <option value="環境工程研究所">環境工程研究所</option>
      <option value="營建管理研究所">營建管理研究所</option>
      <option value="材料科學與工程研究所">材料科學與工程研究所</option>
      <option value="生物醫學工程研究所">生物醫學工程研究所</option>
      <option value="會計學研究所">會計學研究所</option>
      <option value="產業經濟研究所">產業經濟研究所</option>
      <option value="人力資源管理研究所">人力資源管理研究所</option>
      <option value="工業管理研究所">工業管理研究所</option>
      <option value="軟體工程研究所">軟體工程研究所</option>
      <option value="網路學習科技研究所">網路學習科技研究所</option>
      <option value="地球物理研究所">地球物理研究所</option>
      <option value="大氣物理研究所">大氣物理研究所</option>
      <option value="太空科學研究所">太空科學研究所</option>
      <option value="應用地質研究所">應用地質研究所</option>
      <option value="水文與海洋科學研究所">水文與海洋科學研究所</option>
      <option value="客家社會文化研究所">客家社會文化研究所</option>
      <option value="客家語文研究所">客家語文研究所</option>
      <option value="客家政治經濟研究所">客家政治經濟研究所</option>
      <option value="法律與政府研究所">法律與政府研究所</option>
      <option value="公共事務與族群研究博士學位學程">公共事務與族群研究博士學位學程</option>
      <option value="理學院學士班">理學院學士班</option>
      <option value="校長室">校長室</option>
      <option value="副校長室">副校長室</option>
      <option value="秘書室">秘書室</option>
      <option value="研發處">研發處</option>
      <option value="總務處">總務處</option>
      <option value="教務處">教務處</option>
      <option value="學務處">學務處</option>
      <option value="人事室">人事室</option>
      <option value="會計室">會計室</option>
      <option value="國際處">國際處</option>
      <option value="圖書館">圖書館</option>
      <option value="電算中心">電算中心</option>
      <option value="環安中心">環安中心</option>
      <option value="遙測中心">遙測中心</option>
      <option value="光電研究中心">光電研究中心</option>
      <option value="環境研究中心">環境研究中心</option>
      <option value="通訊研究中心">通訊研究中心</option>
      <option value="台經研究中心">台經研究中心</option>
      <option value="人文研究中心">人文研究中心</option>
      <option value="數據分析研究中心">數據分析研究中心</option>
      <option value="前瞻科技中心">前瞻科技中心</option>
      <option value="聯合研究中心">聯合研究中心</option>
      <option value="文學院研究單位">文學院研究單位</option>
      <option value="理學院研究單位">理學院研究單位</option>
      <option value="工學院研究單位">工學院研究單位</option>
      <option value="管理學院研究單位">管理學院研究單位</option>
      <option value="地科學院研究單位">地科學院研究單位</option>
      <option value="通識中心">通識中心</option>
      <option value="科教中心">科教中心</option>
      <option value="師培中心">師培中心</option>
      <option value="出版中心">出版中心</option>
      <option value="語言中心">語言中心</option>
      <option value="藝文中心">藝文中心</option>
      <option value="體育室">體育室</option>
    </select>
    </td>
  </tr>
  <tr>
    <th align="center" colspan="2"><font color="#FF0000">限制資電學院、光電系、資工系、電機系、通訊系參加</font></th>
  </tr>
  <tr>
    <th align="center">系所限制</th>
    <td align="left">
    <select name="Restrict">
      <option value="0">禁止</option>
      <option value="1">允許</option>
    </select>: <br />
    <select name="Restrict_academic" multiple="multiple" size="15">
      <option value="文學院">文學院</option>
      <option value="理學院">理學院</option>
      <option value="工學院">工學院</option>
      <option value="管理學院">管理學院</option>
      <option value="資電學院" selected="selected">資電學院</option>
      <option value="地科學院">地科學院</option>
      <option value="客家學院">客家學院</option>
      <option value="其他單位">其他單位</option>
      <option value="行政單位">行政單位</option>
      <option value="研究單位">研究單位</option>
      <option value="總教學中心">總教學中心</option>
    </select> - 
    <select name="Restrict_dept" multiple="multiple" size="15">
      <option value="中國文學系">中國文學系</option>
      <option value="英美語文學系">英美語文學系</option>
      <option value="法國語文學系">法國語文學系</option>
      <option value="物理學系">物理學系</option>
      <option value="數學系">數學系</option>
      <option value="化學學系">化學學系</option>
      <option value="生命科學系">生命科學系</option>
      <option value="光電科學與工程學系" selected="selected">光電科學與工程學系</option>
      <option value="化學工程與材料工程學系">化學工程與材料工程學系</option>
      <option value="土木工程學系">土木工程學系</option>
      <option value="機械工程學系">機械工程學系</option>
      <option value="企業管理學系">企業管理學系</option>
      <option value="資訊管理學系">資訊管理學系</option>
      <option value="財務金融學系">財務金融學系</option>
      <option value="經濟學系">經濟學系</option>
      <option value="電機工程學系" selected="selected">電機工程學系</option>
      <option value="資訊工程學系" selected="selected">資訊工程學系</option>
      <option value="通訊工程學系" selected="selected">通訊工程學系</option>
      <option value="地球科學學系">地球科學學系</option>
      <option value="大氣科學學系">大氣科學學系</option>
      <option value="哲學研究所">哲學研究所</option>
      <option value="藝術學研究所">藝術學研究所</option>
      <option value="歷史研究所">歷史研究所</option>
      <option value="學習與教學研究所">學習與教學研究所</option>
      <option value="生物物理研究所">生物物理研究所</option>
      <option value="照明與顯示科技研究所">照明與顯示科技研究所</option>
      <option value="統計研究所">統計研究所</option>
      <option value="天文研究所">天文研究所</option>
      <option value="認知與神經科學研究所">認知與神經科學研究所</option>
      <option value="生物資訊與系統生物研究所">生物資訊與系統生物研究所</option>
      <option value="光機電工程研究所">光機電工程研究所</option>
      <option value="能源工程研究所">能源工程研究所</option>
      <option value="環境工程研究所">環境工程研究所</option>
      <option value="營建管理研究所">營建管理研究所</option>
      <option value="材料科學與工程研究所">材料科學與工程研究所</option>
      <option value="生物醫學工程研究所">生物醫學工程研究所</option>
      <option value="會計學研究所">會計學研究所</option>
      <option value="產業經濟研究所">產業經濟研究所</option>
      <option value="人力資源管理研究所">人力資源管理研究所</option>
      <option value="工業管理研究所">工業管理研究所</option>
      <option value="軟體工程研究所">軟體工程研究所</option>
      <option value="網路學習科技研究所">網路學習科技研究所</option>
      <option value="地球物理研究所">地球物理研究所</option>
      <option value="大氣物理研究所">大氣物理研究所</option>
      <option value="太空科學研究所">太空科學研究所</option>
      <option value="應用地質研究所">應用地質研究所</option>
      <option value="水文與海洋科學研究所">水文與海洋科學研究所</option>
      <option value="客家社會文化研究所">客家社會文化研究所</option>
      <option value="客家語文研究所">客家語文研究所</option>
      <option value="客家政治經濟研究所">客家政治經濟研究所</option>
      <option value="法律與政府研究所">法律與政府研究所</option>
      <option value="公共事務與族群研究博士學位學程">公共事務與族群研究博士學位學程</option>
      <option value="理學院學士班">理學院學士班</option>
      <option value="校長室">校長室</option>
      <option value="副校長室">副校長室</option>
      <option value="秘書室">秘書室</option>
      <option value="研發處">研發處</option>
      <option value="總務處">總務處</option>
      <option value="教務處">教務處</option>
      <option value="學務處">學務處</option>
      <option value="人事室">人事室</option>
      <option value="會計室">會計室</option>
      <option value="國際處">國際處</option>
      <option value="圖書館">圖書館</option>
      <option value="電算中心">電算中心</option>
      <option value="環安中心">環安中心</option>
      <option value="遙測中心">遙測中心</option>
      <option value="光電研究中心">光電研究中心</option>
      <option value="環境研究中心">環境研究中心</option>
      <option value="通訊研究中心">通訊研究中心</option>
      <option value="台經研究中心">台經研究中心</option>
      <option value="人文研究中心">人文研究中心</option>
      <option value="數據分析研究中心">數據分析研究中心</option>
      <option value="前瞻科技中心">前瞻科技中心</option>
      <option value="聯合研究中心">聯合研究中心</option>
      <option value="文學院研究單位">文學院研究單位</option>
      <option value="理學院研究單位">理學院研究單位</option>
      <option value="工學院研究單位">工學院研究單位</option>
      <option value="管理學院研究單位">管理學院研究單位</option>
      <option value="地科學院研究單位">地科學院研究單位</option>
      <option value="通識中心">通識中心</option>
      <option value="科教中心">科教中心</option>
      <option value="師培中心">師培中心</option>
      <option value="出版中心">出版中心</option>
      <option value="語言中心">語言中心</option>
      <option value="藝文中心">藝文中心</option>
      <option value="體育室">體育室</option>
    </select>
    </td>
  </tr>
</table>
<? require("template_bottom.php"); ?>