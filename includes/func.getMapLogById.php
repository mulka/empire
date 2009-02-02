<?php

require_once "includes/func.convertBoundsToMinMax.php";
require_once "includes/db.php";

function getMapLogById($logId){
        global $db;

        $result =& $db->getRow("SELECT * FROM logmap WHERE logId = ?", array($logId));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	
	if($result){
		$before = array('bounds' => $result['before']);
		$after = array('bounds' => $result['after']);

		convertBoundsToMinMax($before);
		convertBoundsToMinMax($after);

		$result['before'] = $before;
		$result['after'] = $after;
	}
	return $result;
}
