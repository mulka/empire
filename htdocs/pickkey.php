<?php

require_once "includes/func.pickKey.php";
require_once "includes/func.getExternalLocIds.php";
require_once "includes/db.php";

$source = $_GET['source'];

$result = $db->getAll("SELECT `key` FROM externallinkspossible WHERE source = ?", array($source));
if(PEAR::isError($result)){
        die($result->getMessage());
}

foreach($result as $index => $key){
	$key = $key['key'];
	$result[$index]['before'] = $key;
	$key = pickKey($source, $key);
	$result[$index]['after'] = $key;
	$result[$index]['locIds'] = getExternalLocIds($source, $key);
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('keys', $result);
$smarty->display('pickkey.tpl.html');
