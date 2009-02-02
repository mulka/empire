<?php

require_once "includes/db.php";
require_once "includes/func.listOrphanLocations.php";
require_once "includes/func.getChildrenLocations.php";
require_once "includes/func.getAncestors.php";
require_once "includes/func.getFirstParentLocation.php";

function printAncestorsTable(){
global $db;
$result = $db->getAll("SELECT * FROM ancestors");
print "<pre>";
foreach($result as $row){
        foreach($row as $value){
                print $value." ";
        }
        print "\n";
}
die();
}

function updateAncestorsTable($locId){
	global $db;

	//get ancestors before parent switch
	//assumes that getAncestors works off of the old ancestors table which this function updates
	$before = getAncestors($locId);

	//get ancestors after parent switch
	//assumes that getFirstParentLocation is not outdated (doesn't use the ancestors table)
	$newParent = getFirstParentLocation($locId);
	$after = getAncestors($newParent['locId']);
	if($newParent) array_push($after, $newParent);

//print "<pre>";
//var_dump($before);
//var_dump($after);
//exit();

	//determine how many ancestors need to be added or removed from each list
	$afterCount = count($after);
	$beforeCount = count($before);
	$difference = $afterCount - $beforeCount;

//print $difference;

		$result = $db->getCol("SELECT DISTINCT a1.locId FROM ancestors AS a1 WHERE a1.ancestorLocId = ? OR a1.locId = ?", 0, array($locId, $locId));
                if (PEAR::isError($result)) {
			print 1;
                        die($result->getMessage());
                }
		$affectedLocIds = $result;

//var_dump($affectedLocIds);
//exit();
	
	//remove unneeded ancestors
	$deleteCount = abs($difference);
	foreach($affectedLocIds as $affectedLocId){
		$result = $db->query("DELETE FROM ancestors WHERE locId = ? AND level < $beforeCount", array($affectedLocId));
		if (PEAR::isError($result)) {
			print 2;
			var_dump($result);
			die($result->getMessage());
		}
	}

	//add or remove to level number to make up for lost levels or make room for new levels
	foreach($affectedLocIds as $affectedLocId){
		$result = $db->query("UPDATE ancestors SET level = level + $difference WHERE locId = ? AND level >= $beforeCount", array($affectedLocId));
		if (PEAR::isError($result)) {
			print 3;
			die($result->getMessage());
		}
	}

	//determine how many locations the ancestor lists before and after have in common
	$commonAncestors = 0;
	for($i = 0; $i < min($beforeCount, $afterCount); $i++){
		if($before[$i]['locId'] == $after[$i]['locId']){
			$commonAncestors++;
		}else{
			break;
		}
	}

	foreach($after as $key => $afterLocation){
        	$result = $db->query("INSERT INTO ancestors SET locId = ?, level = ?, ancestorLocId = ? ON DUPLICATE KEY UPDATE ancestorLocId = ?", array($locId, $key, $afterLocation['locId'], $afterLocation['locId']));
        	if (PEAR::isError($result)) {
			print 4;
        	        die($result->getMessage());
		}
	}

//printAncestorsTable();

	//insert new ancestors in table
        $result = $db->query("INSERT INTO ancestors (locId, level, ancestorLocId) SELECT a1.locId, a2.level, a2.ancestorLocId FROM (SELECT DISTINCT locId FROM ancestors WHERE ancestorLocId = ?) AS a1 JOIN ancestors AS a2 WHERE a2.locId = ? AND level < $afterCount", array($locId, $locId));
        if (PEAR::isError($result)) {
		print 5;
                die($result->getMessage());
        }
		
}
