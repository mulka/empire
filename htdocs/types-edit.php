<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLocationType.php";
require_once "includes/func.listTypes.php";

//display options:
//tree view (optionally only those under a certain parent)
//alphabetical

//tree view - displays a tree of all locations using in relationships

//all location names are links to location-view.php

$locId = $_GET['locId'];

$possibleTypes = listTypes();
array_unshift($possibleTypes, '');

$location = getLocationById($locId);
$location['type'] = getLocationType($locId);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', $location);
$smarty->assign('possibleTypes', $possibleTypes);
$smarty->display('types-edit.tpl.html');
