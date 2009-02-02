<?php

require_once "includes/func.createLocation.php";
require_once "includes/func.empireLog.php";

$name = $_POST['name'];
$names = $_POST['names'];
$connector = $_POST['connector'];
$parentLocId = $_POST['parentLocId'];

if(!isset($names) && !preg_match("/^[a-z0-9 ',\-\.]+$/i", $name)){
	die("name failed regex");
}

if(!preg_match("/^[a-z]*$/", $connector)){
	die("connector failed regex");
}

if($parentLocId != "" && !is_numeric($parentLocId)){
	die("parentLocId not numeric");
}

if(!isset($names)){
	$locId = createLocation($name, $connector, $parentLocId);
	header("Location: map-edit.php?locId=$locId");
}else{
	$validatedNames = array();
	foreach($names as $name){
		if(preg_match("/^[a-z0-9 ',\-\.]+$/i", $name)){
			array_push($validatedNames, $name);
		}
	}
	createLocation($validatedNames, $connector, $parentLocId);
	header("Location: location-view.php?locId=$parentLocId");
}
