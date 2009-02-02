<?php

require_once "includes/db.php";
require_once "includes/func.getLocationById.php";
require_once "includes/func.getLocationBoundsOnMap.php";
require_once "includes/func.getFirstBoundsOfParents.php";
require_once "includes/func.getDefaultMap.php";
require_once "includes/func.getMapById.php";
require_once "includes/func.getLocationBoundsOnMap.php";

$defaultBounds = array('miny' => -80, 'minx' => -170, 'maxy' => 80, 'maxx' => 170);

$locId = $_GET['locId'];
$map = $_GET['map'];
$x = $_GET['x'];
$y = $_GET['y'];
$z = $_GET['z'];
$mapType = $_GET['mapType'];


if($map != 'gps'){
        //for a custom map:
        $mapInfo = getDefaultMap($locId);

        if($mapInfo){
                $locBounds = getLocationBoundsOnMap($locId, $mapInfo['mapId']);
        }
}

if(!$mapInfo){
	$locBounds = getLocationBoundsOnMap($locId);
}


if($locBounds){
	$mapBounds = $locBounds;
}

if(!$mapBounds){
//TODO: put more validation here
//x and y in range, z in range, mapType valid
if(isset($x) && isset($y) && isset($z) && isset($mapType)){
switch($mapType){
	case 'map':
		$mapType = 'G_NORMAL_MAP';
		break;
	case 'satellite':
		$mapType = 'G_SATELLITE_MAP';
		break;
	case 'hybrid':
		$mapType = 'G_HYBRID_MAP';
		break;
}
	$mapSetting = array('x' => $x, 'y' => $y, 'z' => $z, 'mapType' => $mapType);
}
}

if(!$mapBounds){
	$mapBounds = getFirstBoundsOfParents($locId, $mapInfo['mapId']);
	$parentShowing = true;
}

if(!$mapBounds){
	//neither mapBounds or locBounds is defined, so use some default mapBounds
	$mapBounds = $defaultBounds;
}


require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($locId));
$smarty->assign('parentShowing', $parentShowing);
$smarty->assign('mapBounds', $mapBounds);
$smarty->assign('mapSetting', $mapSetting);
$smarty->assign('locBounds', $locBounds);
$smarty->assign('map', array('type' => $mapType, 'info' => $mapInfo, 'locations' => $locations, 'bounds' => $locBounds, 'showBounds' => $showBounds)); //for location-view-map
$smarty->display('map-edit.tpl.html');
