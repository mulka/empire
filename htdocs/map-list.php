<?php

require_once "includes/func.listMaps.php";
require_once "includes/func.getDefaultLocationsForMap.php";

$maps = listMaps();

foreach($maps as $key => $map){
	$maps[$key]['defaultLocations'] = getDefaultLocationsForMap($map['mapId']);
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign("maps", $maps);
$smarty->display('map-list.tpl.html');