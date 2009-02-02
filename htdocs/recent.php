<?php

require_once "includes/func.getLog.php";
require_once "includes/func.getLogInfo.php";

$ip = $_GET['ip'];
$action = $_GET['action'];
$output = $_GET['output'];

$filters = array('ip' => $ip, 'action' => $action);

$log = getLog($filters);

foreach($log as $key => $row){
	$log[$key]['info'] = getLogInfo($row['action'], $row['logId']);
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('filters', $filters);
$smarty->assign('log', $log);
if($output == 'rss'){
	header("Content-Type: application/rss+xml");
	$smarty->display('log-view-rss.tpl.html');
}else{
	$smarty->display('log-view.tpl.html');
}
