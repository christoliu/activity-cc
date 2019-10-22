<!-- Copyright © 2012 職涯發展中心 NCU Career. All Rights Reserved. -->
<?
list($width_orig, $height_orig) = getimagesize(mb_convert_encoding($_GET["title"], "BIG5", "UTF-8"));
if($width_orig < $_GET["width"] && $height_orig < $_GET["height"]){
  $width = $width_orig;
  $height = $height_orig;
}
else
{
  $width = $_GET["width"];
  $height = $_GET["height"];
  $ratio_orig = $width_orig/$height_orig;
  if ($width/$height > $ratio_orig)
    $width = $height*$ratio_orig;
  else
    $height = $width/$ratio_orig;
}
  
$type = explode(".", $_GET["title"]);
switch(strtoupper(end($type))){
case "JPG":
  header ("Content-type: image/jpeg");
  // Load
  $image_p = imagecreatetruecolor($width, $height);
  $image = imagecreatefromjpeg(mb_convert_encoding($_GET["title"], "BIG5", "UTF-8"));
  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
  
  // Output
  imagejpeg($image_p, null, 100);
case "PNG":
  header ("Content-type: image/png");
  // Load
  $image_p = imagecreatetruecolor($width, $height);
  $image = imagecreatefrompng(mb_convert_encoding($_GET["title"], "BIG5", "UTF-8"));
  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
  
  // Output
  imagepng($image_p);
case "GIF":
  header ("Content-type: image/gif");
  // Load
  $image_p = imagecreatetruecolor($width, $height);
  $image = imagecreatefromgif(mb_convert_encoding($_GET["title"], "BIG5", "UTF-8"));
  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
  
  // Output
  imagegif($image_p, null, 100);
}
?>