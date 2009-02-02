<?php

require_once "includes/db.php";

function getParentLogById($logId){
        global $db;

        $result =& $db->getRow("SELECT * FROM logparent WHERE logId = ?", array($logId));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	
	return $result;
}
