<?php

require_once "includes/db.php";

function searchLog($query){
        global $db;

	$ip = $_SERVER['REMOTE_ADDR'];

        $result =& $db->query("INSERT INTO logsearch (ip, query) VALUES (?, ?)", array($ip, $query));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
}
