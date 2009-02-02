<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.addAkaLocation.php";
require_once "includes/func.mergeHelper.php";

function mergeAka($locId1, $locId2){
	$location = getLocationById($locId1);
	addAkaLocation($locId2, $location['name']);
	mergeHelper($locId1, $locId2, 'aka');
}
