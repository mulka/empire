<?php

require_once "includes/func.getLocationTreeUrlsById.php";


if(isset($_GET['locId'])){
	$locId =  $_GET['locId'];
}else{
	header("Location: location-tree-url.php?locId=41");
}

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}


$urls = getLocationTreeUrlsById($locId);

print "<pre>";
var_dump($urls);
exit();

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->display('location-tree.tpl.html');
