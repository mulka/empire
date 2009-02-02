<?php

require_once "includes/func.getLocationBoundsOnMap.php";
require_once "includes/func.listBoundsOnMap.php";

$locId = $_GET['locId'] ? $_GET['locId'] : 108;

$locations = listBoundsOnMap();
$bounds = getLocationBoundsOnMap($locId);

if(!$bounds){ die("No map available.");}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->assign('bounds', $bounds);
$smarty->display('gps.tpl.html');



