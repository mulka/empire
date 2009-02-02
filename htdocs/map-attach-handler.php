<?php


require_once "includes/func.getMapByDir.php";
require_once "includes/func.importMap.php";
require_once "includes/func.getDefaultMap.php";
require_once "includes/func.copyBounds.php";
require_once "includes/func.attachMap.php";

$dir = $_POST['dir'];
$locId = $_POST['locId'];
$copyBounds = $_POST['copyBounds'];

if($locId != "" && !is_numeric($locId)){
	die("locId not numeric");
}

$map = getMapByDir($dir);
$mapId = $map['mapId'];

if(!$mapId){
	$mapId = importMap('gmapuploader', $dir);
}

if($copyBounds){
	$oldMap = getDefaultMap($locId);
	$oldMapId = $oldMap['mapId'];
	if($oldMapId){	
		copyBounds($oldMapId, $mapId);
	}
}

attachMap($locId, $mapId);

header("Location: location-view.php?locId=$locId&map=custom");

