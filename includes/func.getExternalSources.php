<?php

require_once "includes/db.php";

function getExternalSources(){
	global $db;
        
	$result =& $db->getAll("SELECT * FROM externalsources ORDER BY name");

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }

        return $result;
}
