<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getExternalLocIds.php";

$key = $_GET['key'];
$source = $_GET['source'];

$locIds = array(getExternalLocIds($source, $key));
$externalLocationList = array();
foreach($locIds as $locId){
	array_push($externalLocationList, getLocationById($locId));
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('source', $source);
$smarty->assign('key', $key);
$smarty->assign('externalLocationList', $externalKeyList);
$smarty->display('location-external.tpl.html');

