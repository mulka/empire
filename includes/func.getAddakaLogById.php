<?php

require_once "includes/db.php";

function getAddakaLogById($logId){
        global $db;

        $result =& $db->getRow("SELECT * FROM logaddaka WHERE logId = ?", array($logId));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	
	return $result;
}
