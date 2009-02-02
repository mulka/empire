<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLogInfo.php";

$logId = $_GET['logId'];

$log = getLogInfo('duplicate', $logId);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($log['locId']));
$smarty->assign('dupLocation', getLocationById($log['dupLocId']));
$smarty->display('duplicate-diff.tpl.html');


