<?php

require_once "includes/func.getLogTable.php";
require_once "includes/func.getLogFields.php";
require_once "includes/db.php";

function empireLog($action, $info = array()){
        global $db;

	$ip = $_SERVER['REMOTE_ADDR'];
	$data = var_export($_POST, true);

        $result =& $db->query("INSERT INTO log (action, ip, data) VALUES (?, ?, ?)", array($action, $ip, $data));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }

	$logId = mysql_insert_id($db->connection);

	$table = getLogTable($action);
	$fields = getLogFields($action);

	$values = array();
	foreach($fields as $field){
		array_push($values, $info[$field]);
	}
	
	array_unshift($fields, 'logId');
	array_unshift($values, $logId);

	$placeholders = array_fill(0, count($values), '?');

	if($table){
		$result =& $db->query("INSERT INTO $table (`".implode('`, `', $fields)."`) VALUES (".implode(', ', $placeholders).")", $values);

        	if (PEAR::isError($result)) {
			var_dump($result);
                	die($result->getMessage());
        	}
	}

}
