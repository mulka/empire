<?php

require_once "includes/db.php";

function getAddexternalLogById($logId){
        global $db;

        $result =& $db->getRow("SELECT * FROM logaddexternal WHERE logId = ?", array($logId));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	
	return $result;
}
