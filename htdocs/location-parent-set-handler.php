<?php

require_once "includes/func.setParentLocation.php";
require_once "includes/func.empireLog.php";

//sets the parent location of an existing location


$locId = $_POST['locId'];
$locIds = $_POST['locIds'];
$parentLocId = $_POST['parentLocId'];
$next = isset($_POST['next']) ? $_POST['next'] : "location-view.php?locId=$locId";


if(!isset($locIds) && !is_numeric($locId)){
	die("locId not numeric");
}

if(!is_numeric($parentLocId)){
//	die("parentLocId not numeric");
}

if(!isset($locIds)){
	setParentLocation($locId, $parentLocId);
}else{
	foreach($locIds as $locId){
		if(is_numeric($locId)){
			setParentLocation($locId, $parentLocId);
		}
	}
}

header("Location: $next");

