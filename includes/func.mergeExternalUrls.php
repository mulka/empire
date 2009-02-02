<?php

require_once "includes/func.mergeHelper.php";

function mergeExternalUrls($locId1, $locId2){
	mergeHelper($locId1, $locId2, 'externalurls');
}
