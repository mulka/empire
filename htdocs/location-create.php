<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.listLocationsUniquely.php";

$name = $_GET['name'];
$parentLocId = $_GET['parentLocId'];

if(isset($parentLocId) && !is_numeric($parentLocId)){
	die("parentLocId is not numeric");
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('parent', getLocationById($parentLocId));
$smarty->assign('possibleList', listLocationsUniquely());
$smarty->assign('name', $name);
$smarty->display('location-create.tpl.html');
