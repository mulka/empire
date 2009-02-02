<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLogInfo.php";

$logId = $_GET['logId'];

$log = getLogInfo('addexternal', $logId);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($log['locId']));
$smarty->assign('key', $log['key']);
$smarty->assign('source', $log['source']);
$smarty->display('addexternal-diff.tpl.html');


