<?php

require_once "includes/db.php";

function getSearchLog(){
        global $db;

        $result =& $db->getAll("SELECT * FROM logsearch ORDER BY timestamp DESC LIMIT 100");

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	return $result;
}
