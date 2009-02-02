<?php


require_once "includes/func.createLocation.php";
require_once "includes/func.getLocationById.php";

$name = $_POST['name'];
$connector = $_POST['connector'];
$parentLocId = $_POST['parentLocId'];

if(!preg_match("/^[a-z0-9 ',\-\.]+$/i", $name)){
	die("name failed regex");
}

if(!preg_match("/^[a-z]*$/", $connector)){
	die("connector failed regex");
}

if($parentLocId != "" && !is_numeric($parentLocId)){
	die("parentLocId not numeric");
}

$locId = createLocation($name, $connector, $parentLocId);
$location = getLocationById($locId);

header("Content-Type: text/xml");

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', $location);
$smarty->display('api/location.tpl.html');