<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getChildrenLocations.php";

function getLocationTreeUrlsById($locId){
	$location = getLocationById($locId);
	$urls = array($location['name'] => array('locIds' => array($locId)));
	getLocationTreeUrls($locId, $urls[$location['name']]);
	return $urls;
}

function getLocationTreeUrls($locId, &$urls){
	$locations = getChildrenLocations($locId);
	if(count($locations)){
		foreach($locations as $key => $location){
			if(!is_array($urls[$location['name']])){
				$urls[$location['name']] = array();
				$urls[$location['name']]['locIds'] = array();
			}
			array_push($urls[$location['name']]['locIds'], $location['locId']);
		}
		foreach($urls as $key => $value){
			if($key != 'locIds')
				$urls[$key]['locIds'] = array_unique($value['locIds']);
		}
		foreach($urls as $key => $value){
			if($key != 'locIds')
				foreach($value['locIds'] as $locId){
					getLocationTreeUrls($locId, $urls[$key]);
				}
		}
	}
}

