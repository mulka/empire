<?php

require_once "includes/func.listLocationTypes.php";
require_once "includes/func.listTypes.php";

//display options:
//tree view (optionally only those under a certain parent)
//alphabetical

//tree view - displays a tree of all locations using in relationships

//all location names are links to location-view.php

$possibleTypes = listTypes();
array_unshift($possibleTypes, '');

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', listLocationTypes());
$smarty->assign('possibleTypes', $possibleTypes);
$smarty->display('types-list.tpl.html');
