<?php

require_once "includes/db.php";

function empireViewLog($locId){
        global $db;

	$ip = $_SERVER['REMOTE_ADDR'];
	$referer = $_SERVER['HTTP_REFERER'];

        $result =& $db->query("INSERT INTO logview (ip, locId, referer) VALUES (?, ?, ?)", array($ip, $locId, $referer));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
}
