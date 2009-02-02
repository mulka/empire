<?php

require_once "includes/func.getLocationTree.php";
require_once "includes/func.getLocationById.php";

function getLocationTreeById($locId){
	$tree = array();
	getLocationTree(getLocationById($locId), array(), $tree);
	return $tree;
}

