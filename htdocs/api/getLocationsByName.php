<?php

require_once "includes/func.getLocationsByName.php";

$name = $_GET['name'];

$locations = getLocationsByName($name);

header("Content-Type: text/xml");

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->display('api/locations.tpl.html');
