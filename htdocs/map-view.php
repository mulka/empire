<?php

require_once "includes/func.getMapById.php";
require_once "includes/func.getDefaultLocationsForMap.php";

$mapId = $_GET['mapId'];

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign("map", getMapById($mapId));
$smarty->assign("defaultLocations", getDefaultLocationsForMap($mapId));
$smarty->display('map-view.tpl.html');