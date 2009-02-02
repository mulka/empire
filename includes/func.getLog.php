<?php

require_once "includes/db.php";

function getLog($filters = array()){
        global $db;
	$whereClause = "1";
	$data = array();
	foreach(array('ip', 'action') as $field){
		if(isset($filters[$field])){
			$whereClause .= " AND $field = ?";
			array_push($data, $filters[$field]);
		}
	}

        $result =& $db->getAll("SELECT * FROM log WHERE $whereClause ORDER BY timestamp DESC LIMIT 100", $data);

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	return $result;
}
