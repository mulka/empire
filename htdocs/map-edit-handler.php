<?php

require_once "includes/db.php";
require_once "includes/func.convertMinMaxToBounds.php";
require_once "includes/func.setLocationBoundsOnMap.php";
require_once "includes/func.empireLog.php";

$locId = $_POST['locId'];
$mapId = $_POST['mapId'];
$bounds['miny'] = $_POST['marker1y'];
$bounds['minx'] = $_POST['marker1x'];
$bounds['maxy'] = $_POST['marker2y'];
$bounds['maxx'] = $_POST['marker2x'];

if(!(is_numeric($bounds['miny']) && is_numeric($bounds['minx']) && is_numeric($bounds['maxy']) && is_numeric($bounds['maxx']))){
	die('bounds not valid, please try again');
}

function swap(&$a, &$b){
	$temp = $a;
	$a = $b;
	$b = $temp;
}

if($bounds['maxy'] < $bounds['miny']) swap($bounds['maxy'], $bounds['miny']);
if($bounds['maxx'] < $bounds['minx']) swap($bounds['maxx'], $bounds['minx']);

convertMinMaxToBounds($bounds);

setLocationBoundsOnMap($locId, $bounds, $mapId);
	
if(is_numeric($mapId)){
	$map = 'custom';
}else{
	$map = 'gps';
}
header("Location: location-view.php?locId=$locId&map=$map");
