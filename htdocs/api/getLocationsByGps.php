<?php

require_once "includes/func.getLocationsByGps.php";

$x = $_GET['x'];
$y = $_GET['y'];

if(!(is_numeric($x) && is_numeric($y))){
	die("x and/or y not numeric");
}

$locations = getLocationsByGps($x, $y);

header("Content-Type: text/xml");

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->display('api/locations.tpl.html');
