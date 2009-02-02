<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLogInfo.php";
require_once "includes/func.convertBoundsToMinMax.php";

$logId = $_GET['logId'];

$log = getLogInfo('editmap', $logId);

        if($log){
                $before = array('bounds' => $log['before']);
                $after = array('bounds' => $log['after']);

                convertBoundsToMinMax($before);
                convertBoundsToMinMax($after);

                $log['before'] = $before;
                $log['after'] = $after;
        }

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($log['locId']));
$smarty->assign('bounds', $log['before']);
$smarty->assign('boundsAfter', $log['after']);
$smarty->display('map-diff.tpl.html');


