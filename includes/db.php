<?php

require_once "DB.php";
switch($_SERVER['HTTP_HOST']){
	default:
		$dsn = "mysql://root:@localhost/empire";
		break;
}

$db =& DB::connect($dsn);
if(PEAR::isError($db)){
	die($db->getMessage());
}
$db->setFetchMode(DB_FETCHMODE_ASSOC);
