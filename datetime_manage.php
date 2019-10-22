<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<!--日曆選擇器-->
<link rel="stylesheet" href="ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script src="jquery.js"></script>
<script src="ui.datepicker_manage.js" type="text/javascript" charset="utf-8"></script>  
<script type="text/javascript" charset="utf-8">
jQuery(function($){
  $('.calendar').datepicker({dateFormat: 'yy-mm-dd', showOn: 'both', buttonImageOnly: true, buttonImage: 'img/calendar.gif'});
});
</script>
<?
function datetime($name, $value, $calendar, $hour, $minute, $second)
{
	if($calendar)
	{
?>
    <input type="text" class="calendar" name="<?= $name ?>" size="10" value="<?= substr($value, 0, 10) ?>">
<?
  }
	if($hour)
	{
?>
    <select name="<?= $name ?>_Hour">
    <? for($i = 0; $i <= 23; $i++){ ?>
    <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <? if(substr($value, 11, 2) == $i){ echo 'selected="selected"'; } ?>><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
    <? } ?>
    </select>
<?
  }
	if($minute)
	{
?>
    :<select name="<?= $name ?>_Minute">
    <? for($i = 0; $i <= 59; $i++){ ?>
    <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <? if(substr($value, 14, 2) == $i){ echo 'selected="selected"'; } ?>><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
    <? } ?>
    </select>
<?
  }
	if($second)
	{
?>
    :<select name="<?= $name ?>_Second">
    <? for($i = 0; $i <= 59; $i++){ ?>
    <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <? if(substr($value, 17, 2) == $i){ echo 'selected="selected"'; } ?>><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
    <? } ?>
    </select>
<?
	}
}
?>