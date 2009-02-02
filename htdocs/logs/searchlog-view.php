<?php

require_once "includes/func.getSearchLog.php";

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('log', getSearchLog());
$smarty->display('searchlog-view.tpl.html');
