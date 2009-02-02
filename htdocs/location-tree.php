<?php

require_once "includes/func.getLocationTreeById.php";


if(isset($_GET['locId'])){
	$locId =  $_GET['locId'];
}else{
	header("Location: location-tree.php?locId=41");
}

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}

$locations = getLocationTreeById($locId);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->display('location-tree.tpl.html');
