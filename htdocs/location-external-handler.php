<?php

require_once "includes/func.addExternalKey.php";
require_once "includes/func.deleteExternalKey.php";
require_once "includes/func.empireLog.php";

$source = $_POST['source'];
$key = $_POST['key'];
$locId = $_POST['locId'];
$add = $_POST['add'];
$delete = $_POST['delete'];


if($add){
	empireLog('addexternal', array('locId' => $locId, 'source' => $source, 'key' => $key));
	addExternalKey($source, $key, $locId);
}else if($delete){
	empireLog('deleteexternal');
	deleteExternalKey($source, $key, $locId);
}

header("Location: ".$_SERVER["HTTP_REFERER"]);
