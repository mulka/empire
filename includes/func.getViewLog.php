<?php

require_once "includes/db.php";

function getViewLog($ip = "", $referer = ""){
        global $db;
	$whereClause = "1";

	if($ip != ""){
		$whereClause .= " AND ip = '$ip'";
	}

	switch($referer){
		case 'google':
			$whereClause .= " AND referer LIKE 'http://www.google.com%'";
			break;
		case 'googleumich':
			$whereClause .= " AND referer LIKE 'http://www.googlesyndicatedsearch.com/u/umich%'";
			break;
		case 'iframe':
			$whereClause .= " AND referer LIKE '%/iframe.php%'";
			break;
		case 'internal':
                        $whereClause .= " AND (referer LIKE 'http://grocs.dmc.dc.umich.edu/~liveugli/empire%' OR referer LIKE 'http://cartiki.com/%')";
                        break;
		case 'external':
                        $whereClause .= " AND referer NOT LIKE 'http://grocs.dmc.dc.umich.edu/~liveugli/empire%' AND referer NOT LIKE 'http://www.google.com/%' AND referer NOT LIKE 'http://cartiki.com/%'";
			break;
		case 'all':
		default;
			$whereClause .= " AND referer IS NOT NULL";
			break;
	}

        $result =& $db->getAll("SELECT * FROM logview NATURAL JOIN locations WHERE $whereClause ORDER BY timestamp DESC LIMIT 100");

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	
	foreach($result as $key => $row){

		$result[$key]['refererShort'] = preg_replace("/^".preg_quote("http://grocs.dmc.dc.umich.edu/~liveugli/empire", '/')."/", "", $row['referer']);
		$result[$key]['refererShort'] = preg_replace("/^".preg_quote("http://cartiki.com", '/')."/", "", $row['referer']);
	}
	return $result;
}
