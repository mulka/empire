<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLogInfo.php";

$logId = $_GET['logId'];

$log = getLogInfo('create', $logId);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('log', $log);
$smarty->display('location-create-diff.tpl.html');


