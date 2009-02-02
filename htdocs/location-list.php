<?php

require_once "includes/func.listLocationsUniquely.php";

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locationList', listLocationsUniquely());
$smarty->display('location-list2.tpl.html');
