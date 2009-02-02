<?php

require_once "includes/func.empireLog.php";
require_once "includes/db.php";

require_once "XML/Unserializer.php";

function importMap($source, $key){
	global $db;
	if($connector == null) $connector = '';

	$xml = file_get_contents("http://gmapuploader.com/api/getMapById.php?mapId=".$key);

	$u = new XML_Unserializer();
	$u->unserialize($xml);
	$data = $u->getUnserializedData();
	if(PEAR::isError($data)){
	        die($data->getMessage());
	}

	
	$result =& $db->query("INSERT INTO maps (dir, format, levels, width, height, base) VALUES (?, ?, ?, ?, ?, ?)", array($data['mapId'], $data['format'], $data['levels'], $data['width'], $data['height'], $data['base'] ));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	$mapId = mysql_insert_id($db->connection);

	
	return $mapId;

}
