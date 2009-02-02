<?php

require_once "includes/db.php";

function getCreateLogById($logId){
        global $db;

        $result =& $db->getRow("SELECT * FROM logcreate WHERE logId = ?", array($logId));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	
	return $result;
}
