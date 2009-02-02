<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.addName.php";
require_once "includes/func.mergeHelper.php";

function mergeNames($locId1, $locId2){
	$location = getLocationById($locId1);
	addName($locId2, $location['name']);
	mergeHelper($locId1, $locId2, 'aka');
}
