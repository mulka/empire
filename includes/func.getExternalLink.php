<?php

require_once "includes/func.getExternalKey.php";
require_once "includes/func.getExternalLinkByKey.php";


function getExternalLink($source, $locId){
	$key = getExternalKey($source, $locId);
	
	if($key){
		return getExternalLinkByKey($source, $key);
	}
}