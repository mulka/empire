<?php

require_once "includes/func.mergeHelper.php";

function mergeExternalKeys($locId1, $locId2){
	mergeHelper($locId1, $locId2, 'externallinks');
}
