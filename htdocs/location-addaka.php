<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getNames.php";

$locId = $_GET['locId'];

if(isset($locId) && !is_numeric($locId)){
	die("locId is not numeric");
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($locId));
$smarty->assign('aka', getNames($locId));
$smarty->display('location-addaka.tpl.html');
