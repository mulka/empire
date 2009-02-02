<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLogInfo.php";

$logId = $_GET['logId'];

$log = getLogInfo('addaka', $logId);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('log', $log);
$smarty->display('addaka-diff.tpl.html');


