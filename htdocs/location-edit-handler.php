<?php

require_once "includes/func.editLocation.php";
require_once "includes/func.empireLog.php";

$locId = $_POST['locId'];
$name = $_POST['name'];

empireLog('edit');

if($locId != "" && !is_numeric($locId)){
	die("locId not numeric");
}

if(!preg_match("/^[a-z0-9 ',\-\.]+$/i", $name)){
	die("name failed regex");
}

editLocation($locId, $name);

header("Location: location-view.php?locId=$locId");

?>
