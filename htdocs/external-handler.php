<?php

require_once "includes/func.editExternalKey.php";

$source = $_POST['source'];

if(!preg_match("/^[a-z]+$/", $source)){
	die("source failed regex");
}

if($locId != "" && !is_numeric($locId)){
	die("locId not numeric");
}


foreach($_POST as $key => $value){
	if(preg_match("/^key_(\d+)$/", $key, $matches)){
		assert(is_numeric($matches[1]));
		editExternalKey($source, $matches[1], $value);
	}
}

header("Location: external.php?source=$source");

