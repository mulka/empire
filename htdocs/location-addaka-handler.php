<?php

require_once "includes/func.createLocation.php";
require_once "includes/func.addName.php";
require_once "includes/func.empireLog.php";
require_once "includes/func.editLocation.php";

$name = $_POST['name'];
$locId = $_POST['locId'];
$default = $_POST['default'];

empireLog('addaka', array('name' => $name, 'locId' => $locId));

if(!preg_match("/^[a-z0-9 ',\-\.]+$/i", $name)){
	die("name failed regex");
}

if($locId != "" && !is_numeric($locId)){
	die("locId not numeric");
}

addName($locId, $name);

if($default){
	editLocation($locId, $name);
}

header("Location: location-view.php?locId=$locId");

?>
