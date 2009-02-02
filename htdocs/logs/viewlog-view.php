<?php

require_once "includes/func.getViewLog.php";

$ip = $_GET['ip'];
$referer = $_GET['referer'];

$possibleReferers = array('external', 'internal', 'google', 'googleumich', 'iframe', 'all');

$hostname = @gethostbyaddr($ip);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('log', getViewLog($ip, $referer));
$smarty->assign('ip', $ip);
$smarty->assign('hostname', $hostname);
$smarty->assign('referer', $referer);
$smarty->assign('possibleReferers', $possibleReferers);
$smarty->display('viewlog-view.tpl.html');
