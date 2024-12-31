<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');
function dd($var){
	echo "<pre>";
	var_dump($var);
	die;
}
function getUrl($path = ""){
	$currentUrlpath = $GLOBALS['url'];
	$absoluteUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	if($currentUrlpath != "/"){
		$absoluteUrl = str_replace("$currentUrlpath", "", $absoluteUrl);
	}
	$absoluteUrl = substr($absoluteUrl, 0, strrpos($absoluteUrl ,'/'));
	return $absoluteUrl.'/'.$path;
}
function convertTime($str){
$date = new \DateTime($str);
return $date->format('d F Y');
}
function description($desc, $length)
{
	$desc = strip_tags ($desc) ;
	if (strlen($desc)>$length) {
	  $desc = substr($desc, 0, $length);
	}
	echo $desc;
	}
 ?>

