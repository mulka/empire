<?php

require_once "includes/func.listOrphanLocations.php";

//lists orphan locations

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', listOrphanLocations());
$smarty->display('location-list.tpl.html');