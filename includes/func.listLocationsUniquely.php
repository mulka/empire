<?php

require_once "includes/func.listLocations.php";
require_once "includes/func.getFirstParentLocation.php";

function locationListCompare($a, $b){
	for($counter = 0; true; $counter++){
		if(count($a) == $counter && count($b) == $counter){
			return 0;
		}else if(count($a) <= $counter){
			return -1;
		}else if(count($b) <= $counter){
			return 1;
		}
		$cmp = strcmp($a[$counter]['name'], $b[$counter]['name']);
		if($cmp != 0){
			return $cmp;
		}
	}
}

function intcmp($a, $b){
	$a = intval($a);
	$b = intval($b);

	if($a == $b){
		return 0;
	}else if( $a < $b){
		return -1;
	}else if($a > $b){
		return 1;
	}
}

function locationListCompareByLastLocId($a, $b){
	return intcmp($a[count($a) - 1]['locId'], $b[count($b) - 1]['locId']); 
}

function listLocationsUniquely($initialLocationList = NULL){

	if(is_null($initialLocationList)){
		$initialLocationList = listLocations();
	}

	$locationList = array();
	foreach($initialLocationList as $location){
		array_push($locationList, array($location));
	}

	$finalLocationList = array();
	//the 10 here is just an arbitrary number
	for($counter = 0; $counter < 10; $counter++){
		usort($locationList, "locationListCompare");
		$currentName = NULL;
		$duplicate = false;
		$locationListCount = count($locationList);

		if($locationListCount == 0){
			break;
		}

		//remove location names which only have one occurance
		foreach($locationList as $key => $locations){
			$tailLocation = $locations[count($locations) - 1];
			if($duplicate && strcasecmp($tailLocation['name'], $currentName) == 0){
				next;
			}else{
				if($tailLocation['name'] != $currentName){
					if(!$duplicate && $key > 0){
						array_push($finalLocationList, $locationList[$key - 1]);
						unset($locationList[$key - 1]);
					}
					$currentName = $tailLocation['name'];
					$duplicate = false;
				}else{
					$duplicate = true;
				}
			}
		}
		if(!$duplicate){
			array_push($finalLocationList, $locationList[$locationListCount - 1]);
			unset($locationList[$locationListCount - 1]);
		}
	
		usort($locationList, "locationListCompareByLastLocId");
		$currentLocId = NULL;
		$dupLocIds = array();
		//remove locations which have converged to the same parent
		foreach($locationList as $key => $locations){
			$tailLocation = $locations[count($locations) - 1];
			if($tailLocation['locId'] == $currentLocId){
				array_push($dupLocIds, $currentLocId);
			}
			$currentLocId = $tailLocation['locId'];
		}

		$dupLocIds = array_unique($dupLocIds);
		sort($dupLocIds);

		foreach($locationList as $key => $locations){
			$tailLocation = $locations[count($locations) - 1];
			if(in_array($tailLocation['locId'], $dupLocIds)){
				array_push($finalLocationList, $locationList[$key]);
				unset($locationList[$key]);
			}
		}

		foreach($locationList as $key => $locations){
			$parent = getFirstParentLocation($locations[count($locations) - 1]['locId']);
			if($parent){
				array_push($locationList[$key], $parent);
			}else{
				array_push($locationList[$key], array('locId' => 0));
			}
		}
	}
	usort($finalLocationList, "locationListCompare");

	return $finalLocationList;
}

