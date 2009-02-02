<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getDefaultMap.php";

$locId = $_GET['locId'];
$mapId = $_GET['mapId'];

$map = getDefaultMap($locId);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('map', $map);
$smarty->assign('newMapId', $mapId);
$smarty->assign('location', getLocationById($locId));
$smarty->display('map-attach.tpl.html');
