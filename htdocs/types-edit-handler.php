<?php

require_once "includes/func.editType.php";

//inputs:
//locId of location
//type

//redirects to types-list.php by default

$locId = $_POST['locId'];
$type = $_POST['type'];
$next = isset($_POST['next']) ? $_POST['next'] : "types-list.php";

if($locId != "" && !is_numeric($locId)){
	die("locId not numeric");
}

if(!preg_match("/^[a-z ]*$/", $type)){
	die("type failed regex");
}

editType($locId, $type);

header("Location: $next");

?>