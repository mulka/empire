<?php

require_once "includes/func.listExternalKeys.php";
require_once "includes/func.listLocationsUniquely.php";

$source = $_GET['source'];

if(!preg_match("/^[a-z]+$/", $source)){
	die("source failed regex");
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('source', $source);
$smarty->assign('locations', listExternalKeys($source));
$smarty->assign('possibleList', listLocationsUniquely());
$smarty->display('external.tpl.html');
