<?php

require_once "includes/func.getLocationById.php";

$parentLocId = $_GET['parentLocId'];

if(isset($parentLocId) && !is_numeric($parentLocId)){
	die("parentLocId is not numeric");
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('parent', getLocationById($parentLocId));
$smarty->display('location-create-multi.tpl.html');
