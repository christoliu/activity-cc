<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
function url_params_set($name, $value, $queue)
{
	$params = $_GET;
	$params[$name] = $value;
	if($queue)
	  $params["queue"] = $_GET["queue"] == "ASC" ? "DESC" : "ASC";
		
	return http_build_query($params);
}
?>