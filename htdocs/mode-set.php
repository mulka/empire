<?php

$edit = $_POST['edit'];
if($edit == "edit mode"){
	setcookie('edit', 1);
}else{
	setcookie('edit', 0);
}
header("Location: /loc/{$_POST['locId']}");
