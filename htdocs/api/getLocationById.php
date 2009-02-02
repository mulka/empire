<?php

require_once "includes/func.getLocationById.php";

$locId = $_GET['locId'];

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}

$location = getLocationById($locId);

if(!$location['name']){
	die("location name empty");
}

header("Content-Type: text/xml");

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', $location);
$smarty->display('api/location.tpl.html');
