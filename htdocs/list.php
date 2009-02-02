<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLocationBoundsOnMap.php";

$locIds = explode(",", $_GET['locIds']);

$locations = array();
foreach($locIds as $locId){
        $location = getLocationById($locId);
        if($location){
                $location['bounds'] = getLocationBoundsOnMap($locId);
                array_push($locations, $location);
        }
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign("locations", $locations);
$smarty->display('list.tpl.html');

